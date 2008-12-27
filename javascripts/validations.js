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
  validatesConfirmationOff("password", "repassword");
  return showErrors();
}

//login.php
function validatesLogin(){

}


