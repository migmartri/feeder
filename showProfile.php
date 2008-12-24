	<?php
  include_once("lib/util.php");
  
  $f= "nordri.blogsome.com";
  
  $validator = new Utilities();
  
  $res = $validator->isURL($f);
  print_r ($res);
  ?>
  
		
    
