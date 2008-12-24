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
?>
