<?php 

  $urlQ = str_replace('event=', '', $_SERVER['QUERY_STRING']);

  echo $urlQ;

?>