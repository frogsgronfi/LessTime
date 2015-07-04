/*******************************************************************************

                          A TIMETABLING PROBLEM
                          =====================

               Moreno Marzolla <moreno.marzolla (at) unibo.it>
                         Version 0.9 -- 2014/12/17

This script solves a timetabling problem using Mixed Integer Linear
Programming (MILP).

Execute with

glpsol --math timetable-0.9.mod --data timetable-0.9-2sem.dat [--cuts] [--pcost] [--minisat]

If the above does not converge, proceed in two steps:

1) export the model in free mps format:

glpsol --math timetable-0.9.mod --data timetable-0.9-2sem.dat --wfreemps timetable.mps

2) Solve the model with CBC (https://projects.coin-or.org/Cbc)

cbc -import timetable.mps -threads 8 -solve -solution solution.txt

******************************************************************************/

##############################################################################
##
## MODEL PARAMETERS
##
##############################################################################

#Spesso è utile poter lavorare con insiemi pluridimensionali, vale a dire insiemi
#i cui elementi sono n-uple (si tratta sempre di n-uple ordinate). Questo viene effettuato con 
#la parola chiave dimen

set Data dimen 3; /* Course, Professor, Year */

#Le parole chiave setof e in consentono di definire un insieme
#monodimensionale come la proiezione su un indice di un insieme pluridimensionale.

set Courses := setof {(c,p,y) in Data} c;
/* Set of Courses. Each course is taught by exactly one professor; furthermore, each course
is held on a specific academic year. */

set Professors := setof {(c,p,y) in Data} p;
/* set of Professors. Each professor teaches one or more courses. */

set Years := setof {(c,p,y) in Data} y;
/* Academic years. The academic year is used to automatically identify static conflicts: courses from the same academic year must not overlap. */

set Rooms;
/* set of available rooms */

set Days := {1 .. 5};
/* Days of the week (1=mon, 5=fri) */

/*con la parola param indichiamo i dati che inseriremo all interno del nostro programma in questo caso definiamo
il massimo numero di slot che ci possono essere in un giorno*/
param slots_per_day integer, > 0, default 9;

set Slots := {1 .. slots_per_day};	
/* Teaching slots within a day. A teaching slot corresponds to one hour of lecture; slot 1 corresponds to 9:30-10:30, slot 9 corresponds to 17:30-18:30 */

param maxb integer, > 0, default 3;
/* Maximum number of blocks which can be requested by a professor. A block is defined as a set of consecutive teaching slots. For example, if a specific course requires a total of 6 slots per week, then the professor may request two blocks of {3, 3} hours, or three blocks of {2, 2, 2} hours, and so on. */

param max_slots_per_day integer, > 0, default 3;
/* Each professor will not be assigned more than max_slots_per_day teaching slots per day. */

param ns{c in Courses, 1..maxb}, integer, >= 0, <= max_slots_per_day, default 0; 
/* ns[c,b] is the number of consecutive slots requested by the b-th block of course c. For example, if course c requires a weekly workload of 6 slots divided in two blocks of {3, 3} slots each, then ns[c] = {3, 3, 0} (trailing zeros are ignored). */

param nb{c in Courses} integer := card( {b in 1..maxb: ns[c,b] > 0} ); 
/* nb[c] is the total number of blocks requested by course c. */

set BlockIdx{c in Courses} := {1 .. nb[c]};
/* The size (number of slots) of blocks requested by course c are ns[j] for each j in BlockIdx[c] */

param room_course{Rooms, Courses} binary, default 1; 
/* room_course[r,c] = 1 iff room r can be used for course c */

param room_available{Rooms, Days, Slots} binary, default 1; 
/* room_available[r,d,s] := 1 iff room r is available on slot s of day d. */

set Teaches within (Professors cross Courses) := setof {(c,p,y) in Data} (p,c); 
/* (p,c) belongs to this set if professor p teaches course c.  */

set CoursesTaught{p in Professors} within Courses := {c in Courses: (p,c) in Teaches}; 
/* CoursesTaught[p] is the set of courses taught by professor p */

param nslots{c in Courses} > 0, integer := sum{l in 1..maxb} ns[c,l]; 
/* nslots[c] is the total number of teaching slots required by course c each week. calcolato come somma degli slot 
consecutivi richiesti*/

set year within (Courses cross Years) := setof {(c,p,y) in Data} (c,y); 
/* year(c,y) belongs to this set iff course c is held during academic year y. FIXME: should this be a parameter rather than a set?? */

set BasicConflicts within (Courses cross Courses) := (setof {(c1,y) in year, (c2,y) in year: c1 != c2} (c1,c2)) union (setof {(p,c1) in Teaches, (p,c2) in Teaches: c1 != c2} (c1,c2));
/* BasicConflicts is the set of pairs of courses which must not be scheduled at the same time. This set is initialized with a basic set of conflicts that includes: (i) courses that belongs to the same academic year, and (ii) courses that are taught by the same professor */

set ExtraConflicts within (Courses cross Courses);
/* Additional conficts, user defined */

set Conflicts within (Courses cross Courses) := setof {(c1, c2) in Courses cross Courses: (c1,c2) in BasicConflicts union ExtraConflicts or (c2, c1) in BasicConflicts union ExtraConflicts} (c1, c2);
/* all conflicts: ensure that if (c1,c2) conflict, also (c2,c1) do */

var schedule{Courses, Rooms, Days, Slots} binary; 
/* schedule[c,r,d,s] is true if course c is assigned slot s on day d, and lecture will be held in room r */

/*block_schedule è la variabile per lo scehduling dei blocchi*/

var block_schedule{c in Courses, Rooms, Days, l in BlockIdx[c]} binary; 
/* block_schedule[c,r,d,l] is true iff course c is assigned ns[c,l] consecutive slots in room r on day d. Note that at most one block for each course can be scheduled each day */

set pre_schedule dimen 5;
/* (course, room, day, l, s): the l-th block of course c is scheduled to start on slot s at the given day and room */

param weights{p in Professors, d in Days, s in Slots} default 1.0;

param prof_available{p in Professors, d in Days, s in Slots} binary := if (weights[p,d,s] != 0 ) then 1 else 0; 
/* prof_available[p,s,d] is true iff professor p is available on slot s of day d. */

##############################################################################
##
## CONSISTENCY CHECKS
##
##############################################################################
/*Un modo più raffinato di eseguire controlli di coerenza sui dati richiede l'uso
della parola chiave check , seguita dal simbolo : e da un'espressione logica*/


check sum{c in Courses, r in Rooms, d in Days, s in Slots} room_course[r,c] * room_available[r,d,s] >= sum{c in Courses} nslots[c];
/* The total number of slots for all courses must be less than or equal to the maximum number of slots available for that courses in all rooms */

check {p in Professors}: sum{d in Days, s in Slots} prof_available[p,d,s] >= sum{c in CoursesTaught[p]} nslots[c];
/* Each professor must guarantee enough availability to satisfy all his teaching duties */

check {p in Professors}: card(Days)*max_slots_per_day >= sum{c in CoursesTaught[p]} nslots[c];
/* max_slots_per_day must be set so that each professor can satisfy his teaching requirements */

check {c in Courses}: card({(p,c) in Teaches}) = 1;
/* Each course must be taught by exactly one professor */

check {(c1,c2) in Conflicts} : (c2,c1) in Conflicts;
/* Conflicts matrix must be symmetric */

check {c in Courses} : (c,c) not in Conflicts;
/* A course must not confict with itself */

check {c in Courses, j in BlockIdx[c]} : ns[c,j] > 0;
/* The first nb[c] elements of the cth row of ns[] must be nonzero... */

check {c in Courses, j in nb[c]+1..maxb} : ns[c,j] = 0;
/* ...and the rest must be zero */

##############################################################################
##
## OBJECTIVE FUNCTION
##
##############################################################################

maximize obj:
  sum{c in Courses, d in Days, s in Slots, r in Rooms, p in Professors} schedule[c,r,d,s] * weights[p,d,s]; 

##############################################################################
##
## CONSTRAINTS
##
##############################################################################


## Each course should be scheduled at most once per slot
s.t. schedule_at_most_once 'schedule at most once per block'
{c in Courses, d in Days, s in Slots}:
	sum{r in Rooms} schedule[c,r,d,s] <= 1;


## The number of slots allocated for course c on day d and room r must be equal to the total blocks for the same course and day
s.t. blocks_eq_schedule 'block_schedule and schedule must match'
{c in Courses, d in Days, r in Rooms}:
	sum{s in Slots} schedule[c,r,d,s] = sum{l in BlockIdx[c]} ns[c,l] * block_schedule[c,r,d,l];


## A block of each course must be scheduled at most once per day
s.t. max_once_per_day 'Each course must be scheduled at most once per day'
{c in Courses, d in Days}: 
	sum{r in Rooms, l in BlockIdx[c]} block_schedule[c,r,d,l] <= 1;


## Each block must be instantiated exactly once per week
s.t. each_block_instantiated 'Each block must be instantiated exactly once per week'
{c in Courses, l in BlockIdx[c]}:
        sum{r in Rooms, d in Days} block_schedule[c,r,d,l] = 1;


## Each room must be used by at most one course
s.t. at_most_one_course_per_room 'Each room must be used by at most one course at a time'
{r in Rooms, d in Days, s in Slots}:
	sum{c in Courses} schedule[c,r,d,s] <= room_available[r,d,s];

## Conflicting courses must not overlap; note the predicate 'c1 < c2' that is used only to reduce the size of this constraint
s.t. courses_dont_overlap 'Conflicting courses must not overlap'
{d in Days, s in Slots, (c1,c2) in Conflicts: c1 < c2}: 
	sum{r in Rooms} schedule[c1,r,d,s] + sum{r in Rooms} schedule[c2,r,d,s] <= 1;

## Professors must be available in their assigned slots
s.t. prof_av 'Professors must be available in their assigned slots'
{(p,c) in Teaches, d in Days, s in Slots}: 
       	sum{r in Rooms} schedule[c,r,d,s] <= prof_available[p,d,s];

s.t. prof_av_2 'Professors must be available in their assigned slots'
{(p,c) in Teaches, d in Days, s in Slots, r in Rooms}:
       	schedule[c,r,d,s] <= prof_available[p,d,s];

## Constraint per l'ora di pausa tra la 4 e la 5
 s.t. lunchhour 'ora di pranzo'
 {d in Days ,y in Years}:
  sum{r in Rooms, (c,y) in year} schedule[c,r,d,4] + sum{r in Rooms, (c,y) in year} schedule[c,r,d,5] <= 1;

## Rooms must be available 
 s.t. room_av 'Rooms must be available'
 {r in Rooms, d in Days, s in Slots, c in Courses}: 
	schedule[c,r,d,s] <= room_course[r,c] * room_available[r,d,s];

## Allocated blocks must be consecutive
# s.t. fill_blocks1 'Allocated blocks must be consecutive 1'
# {r in Rooms, d in Days, c in Courses, l in 1..nb[c], t in 2..ns[c,l]: room_available[r,d,t] and room_course[r,c]}:
# 	schedule[c,r,d,1] - schedule[c,r,d,t] <= 1 - block_schedule[c,r,d,l];

# s.t. fill_blocks2 'Allocated blocks must be consecutive 2'
# {r in Rooms, d in Days, c in Courses, s in Slots, l in 1..nb[c], t in 2..ns[c,l]: s+ns[c,l] in Slots and room_available[r,d,s] and room_course[r,c]}:
# 	-schedule[c,r,d,s] + schedule[c,r,d,s+1] - schedule[c,r,d,s+t] <= 1 - block_schedule[c,r,d,l];

s.t. fill_blocks 'Allocated blocks must be consecutive'
{r in Rooms, d in Days, c in Courses, s1 in Slots, s2 in Slots, s3 in Slots: s1<s2 and s2<s3}:
	schedule[c,r,d,s1] - schedule[c,r,d,s2] + schedule[c,r,d,s3] <= 1;

## Each professor should not teach more than max_slots_per_day
s.t. max_hours_per_professor 'Each professor should not teach more than max_slots_per_day slots per day'
{p in Professors, d in Days}:
	sum{r in Rooms, c in CoursesTaught[p], l in BlockIdx[c]} ns[c,l]*block_schedule[c,r,d,l] <= max_slots_per_day;

## mark preallocated slots
s.t. preschedule_slots1 'mark preallocated blocks'
{(c, r, d, l, s) in pre_schedule}:
	block_schedule[c,r,d,l] = 1;

s.t. preschedule_slots2 'mark preallocated slots'
{(c, r, d, l, s) in pre_schedule, t in Slots: t>=s and t<s+ns[c,l]}:
	schedule[c,r,d,t] = 1;


##############################################################################
##
## SOLVE MODEL
##
##############################################################################

solve;

##############################################################################
##
## DISPLAY SOLUTION
##
##############################################################################
printf "<html><div id='tablerlink'><h3>Anno di Corso</h3><table>";
for {y in Years}{
  printf "<tr><td><a href=javascript:view('%s');>%s</a></td></tr>",y,y;
}
printf"</table></div>";
for {y in Years} {
  printf "--- Timetable year %s ---", y;
  printf "<div id=%s><table id='tabellarisultato' border='1' style='table-layout:fixed;text-align:center'>",y,y;
  ## print table header
  printf "<th></th><th>%10s</th><th>%10s</th><th>%10s</th><th>%10s</th><th>%10s</th>", "mon", "tue", "wed", "thu", "fri";
  for {s in Slots} {
    printf "<tr><td style='height:70px;width:100px'>%2d : 30</td>", s+7;
    ## print course
    for {d in Days} {   
      for {(c,y) in year, (p,c) in Teaches, r in Rooms: schedule[c,r,d,s]=1} {
        printf "<td style='height:70px;width:100px'>%10s</br>%10s</br>%10s", c,r,p;
      } 
      ##for {(c,y) in year, r in Rooms: schedule[c,r,d,s]=1} {
      ##  printf "<td style='height:70px;width:100px'>%10s-%10s</td>", c,r;
      ##}
      for {0..0: sum{(c,y) in year, r in Rooms} schedule[c,r,d,s] = 0} {
        printf "<td style='height:70px;width:100px'></td>";
      }
    }
    printf "</tr>";
}
printf "</table></div>";
}
printf "</div></html>";
printf "\n";
end;

