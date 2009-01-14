/*Validaciones de los distintos formularios
 * haremos uso de validations.js como apoyo*/

var errors;
//register.php
function validatesRegister(){
  errors = [];
  validatesPresenceOf("login", "El nombre de usuario no se puede dejar vacío");
  validatesPresenceOf("password", "La contraseña no se puede dejar vacía");
  validatesPresenceOf("email", "La email no se puede dejar vacío");
  validatesEmailFormatOf("email");
  validatesConfirmationOf("password", "repassword");
  return showErrors();
}

//login.php
function validatesLogin(){
  errors = [];
  validatesPresenceOf("login", "El nombre de usuario no se puede dejar vacío");
  validatesPresenceOf("password", "La contraseña no se puede dejar vacía");
  return showErrors();
}

//editProfile.php
function validatesProfile(){
  errors = [];
  validatesLengthOf("phone", 9, "El telefono debe tener 9 dígitos");
  validatesNumericalityOf("phone", "El telefono debe ser un número"); 
  validatesUrlFormatOf("twitter", "Formato de la url de la cuenta de twitter incorrecto");
  validatesUrlFormatOf("web", "Formato de la url de la web personal incorrecto");
  validatesUrlFormatOf("flickr", "Formato de la url de la cuenta de flickr incorrecto");
  return showErrors();
}
//newPlanet.php
function validatesPlanet(){
  errors = [];
  validatesPresenceOf("name", "El planeta debe tener un nombre");
  validatesPresenceOf("description", "Debes poner una descripción");
  return showErrors();
}

//newSubscription.php
function validatesSubscription(){
  errors = [];
  validatesPresenceOf("url", "Debe existir la url");
  validatesUrlFormatOf("url", "Formato de la url incorrecto");
  return showErrors();

}
