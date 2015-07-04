<?php
  $cmd = "xvfb-run -a wkhtmltopdf 1info.html 1info.pdf";
  $res=exec($cmd,$out,$status);
  echo "<pre>";
  echo "out=";
  print_r($out);
  echo "res=".$res.PHP_EOL;
  echo "status=".$status.PHP_EOL;
  echo "</pre>";
?>