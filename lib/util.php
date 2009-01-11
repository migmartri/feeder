<?php
/*
 *  Clase Utilities
 *  Implementación de las utilidades básicas y repetitivas
 *  de la aplicación.
 *  
 */
class Utilities {
  
  /* Devolverá la contraseña codificada 
   * @pass Contraseña 
   */
  function codificaPasswd($pass) {
    return sha1($pass);
  }
  
  /* Verificar si un campo es vacio
   * @field Campo a verificar
   * deprecated?
   */ 
  function isEmpty($field) {
    return count($field);
  }
  
  /* Validaciones */
  /* Campo obligatorio
   * @field Campo a verificar que tiene contenido
   * @msg Mensaje de error a devolver
   */ 
  function validatesPresenceOf($field, $msg){
    if(!isset($msg)){$msg = "No se puede dejar vacío";}
    if(strlen($field) == 0){
      array_push($GLOBALS["errors"], $msg);
    }
  }
  /* Unica existencia
   * No puede dejamos introducir valores repetidos en tablas como "users"
   * @table Tabla de la BD a verificar que no existe
   * @conditions Condiciones de consulta sql
   * @msg mensaje de error
   */
  function validatesUniquenessOf($table, $conditions, $msg){
    if(!isset($msg)){$msg = "ya existe, elije otro";}
    $exist = $GLOBALS["conn"]->selectFromDB("first", $table, array("*"), $conditions);
  
    if($exist != false) {
      array_push($GLOBALS["errors"], $msg);
    }
  }
  /* Confirmación
   * Verificar contraseñas iguales en login
   * @field1 Contraseña 1
   * @field2 Contraseña 2
   * @msg Mensaje de error
   */
  function validatesConfirmationOff($field1, $field2, $msg){
    if(!isset($msg)){$msg = "$field1 no coincide con $field2";}
  
    if($field1 != $field2) {
      array_push($GLOBALS["errors"], $msg);
    }
  }
  
  /* Formato de email
   * Verificamos mediante expresión regular que el email introducido
   * tiene un formato correcto.
   * @email Cadena de email
   * @msg Mensaje de error
   */
  function validatesEmailFormatOf($email, $msg){
    if(!isset($msg)){$msg = "Formato de email incorrecto";}
  
    if(!self::is_valid_email_address($email)) {
      array_push($GLOBALS["errors"], $msg);
    }
  }
  
  /*Formato de url
   * Verificamos mediante expresión regular que la url introducida
   * tiene un formato correcto. 
   * @url Cadena de url
   * @msg Mensaje de error
   */
  function validatesUrlFormatOf($url, $msg) {
    if(!isset($msg)){$msg = "La url no tiene un formato correcto";}
  
    if((!preg_match('/^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/' ,$url)) && (strlen($url) > 0)) {
      array_push($GLOBALS["errors"], $msg);
    }
  }

  /* Validamos si el feed es válido, válido para nuestra librería.
   * @feed_url Dirección del xml.
   * @msg Mensaje de error.
   */
  function validatesFeed($feed_url, $msg){
    if(!isset($msg)){$msg = "Feed no válido";}
    try{
  		$rawFeed = file_get_contents($feed_url);
      $xml = @simplexml_load_string($rawFeed);
      if (!is_object($xml))
        throw new Exception('Error en la lectura del XML',1001);
      //Devolvemos el título
      return $xml->channel->title;
    }catch(Exception $e){
      array_push($GLOBALS["errors"], $msg);
    }
  }
  
  /* Expresión regular para verificar el email
   * Función de apoyo.
   * @email Cadena que contiene el email.
   */ 
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
  
  /* Filtro de acceso, requiere que el usuario esté logueado.
   */
  function loginRequired(){
    if(!isset($_SESSION['user'])) {
      $_SESSION['flash_error'] = "Acceso denegado";
      header("Location: ../index.php");
    }
  }

  /* Devuelve el usuario actual.
   */
  function currentUser(){
    $conn = new Sgbd();
    if(isset($_SESSION['user']) && !isset($_SESSION['current_user'])) {
      $user = $conn->selectFromDB("first", "users", array("*"), array("id" => $_SESSION['user']));
      $_SESSION['current_user'] = $user; 
    }  
    return $_SESSION['current_user'];
  }
  
  /* Valor devuelto de los formularios.
   * En caso de error se vuelve a completar los formularios.
   */
  function formValue($field){
    $values = $_SESSION['form_values'];
    if($values != '') {
      $res = $values[$field];
      if(isset($res)){
        return $res;
      }
    }
    return '';
  }
  
  /* Comprobamos que es un número de teléfono.
   * Comprobamos que es numérico y mayor que cero.
   * @field campo a comprobar.
   */
  function validatesNumericalityOf($field, $msg) {
    if(!isset($msg)){$msg = "El teléfono no es válido";}
    if (!(is_numeric($field)) && (strlen($field) > 0))
      array_push($GLOBALS["errors"], $msg);
   }
  
  /* Comprobamos la longitud
   * @field Campo a medir.
   * @length Tamaño requerido.
   * @msg Mensaje de error.
   */
  function validatesLengthOf($field, $length, $msg) {
    if(!isset($msg)){$msg = "Debe ser de longitud $length";}
    
    if(strlen($field) != $length && strlen($field) > 0){
      array_push($GLOBALS["errors"], $msg);
    }
  }
  
	/* Original PHP code by Chirp Internet: www.chirp.com.au
   * Please acknowledge use of this code by including this header.
   */
  function truncate($string, $limit, $break=" ", $pad="...")
  {
    // return with no change if string is shorter than $limit

    if(strlen($string) <= $limit) return $string;

    $string = substr($string, 0, $limit);
    if(false !== ($breakpoint = strrpos($string, $break))) {
      $string = substr($string, 0, $breakpoint);
    }

    return $string . $pad;
  }

}
?>
