<?php
  $file = fopen("/opt/lampp/htdocs/log.txt", "a+");        
  fwrite($file, $log_txt);
  fclose($file);
?>