<?php

class Utilities {
  
  function codificaPasswd($pass) {
    return sha1($pass);
  }
  
  function isEmpty($field) {
    return count($field);
  }
  
  function isURL($url) {
    return preg_match('/^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/' ,$url);
  }
}
//Validaciones
//Presencia
function validatesPresenceOf($field, $msg){
  if(!isset($msg)){$msg = "No se puede dejar vacío";}
  if(strlen($field) > 0){
    array_push($GLOBALS["errors"], $msg);
  }
}
//Unica existencia
function validatesUniquenessOf($table, $values, $msg){
  if(!isset($msg)){$msg = "ya existe, elije otro";}
  $exist = $GLOBALS["conn"]->selectFromDB($table, "*", $values);

  if(count($exist) > 0) {
    array_push($GLOBALS["errors"], $msg);
  }
}
?>
