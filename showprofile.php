	<?php
  
  $f= array("naranja", "naranja", "pera", "verde", "platano", "amarillo");
  
  $tam = count($f);
  $res = array();
        print $tam."<br/>";
        if ($tam != 0) {
            for ($i = 0; $i< $tam; $i++) {
                if ($i == $tam-2) {
                  print $f[$i]." = '".$f[$i+1]."'";
                } else {
                  print "Tam = ".$tam." i = ".$i."<br/>";
                  print $f[$i]." = '".$f[$i+1]."',";
                }
               /*array_push($res, $aux);*/
               $i++;
            }
          }
  
  print_r ($res);
  ?>
  
		
    
