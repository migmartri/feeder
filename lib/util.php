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
  if(strlen($field) == 0){
    array_push($GLOBALS["errors"], $msg);
  }
}
//Unica existencia
function validatesUniquenessOf($table, $conditions, $msg){
  if(!isset($msg)){$msg = "ya existe, elije otro";}
  $exist = $GLOBALS["conn"]->selectFromDB($table, array("*"), $conditions);

  if(count($exist) > 0) {
    array_push($GLOBALS["errors"], $msg);
  }
}
//Confirmación
function validatesConfirmationOff($field1, $field2, $msg){
  if(!isset($msg)){$msg = "$field1 no coincide con $field2";}

  if($field1 != $field2) {
    array_push($GLOBALS["errors"], $msg);
  }
}

function validatesEmailFormatOf($email, $msg){
  if(!isset($msg)){$msg = "Formato de email incorrecto";}

  if(!is_valid_email_address($email)) {
    array_push($GLOBALS["errors"], $msg);
  }
}

function is_valid_email_address($email){
        $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
        $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
        $atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
            '\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
        $quoted_pair = '\\x5c[\\x00-\\x7f]';
        $domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";
        $quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";
        $domain_ref = $atom;
        $sub_domain = "($domain_ref|$domain_literal)";
        $word = "($atom|$quoted_string)";
        $domain = "$sub_domain(\\x2e$sub_domain)*";
        $local_part = "$word(\\x2e$word)*";
        $addr_spec = "$local_part\\x40$domain";
        return preg_match("!^$addr_spec$!", $email) ? 1 : 0;
    }
//Filtro de acceso, requiere que el usuario esté logueado
function loginRequired(){
  if(!isset($_SESSION['user'])) {
    $_SESSION['flash_error'] = "Acceso denegado";
    header("Location: ../index.php");
  }
}
?>
