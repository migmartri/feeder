//Valida presencia
function validatePresenceOf(field){
  if(document.getElementById(field).value == ''){
    document.getElementById("error").innerHTML = field + ": No se puede dejar vacío";
    return false
  }
}

//Valida dos campos iguales
function validateConfirmationOff(field1, field2){
	var p1 = document.getElementById(field1).value;
	var p2 = document.getElementById(field2).value;
	
	if (p1 != p2) {
		document.getElementById("error").innerHTML.innerHTML = "Las contraseñas no coinciden";
		return false;
	}
}

//Valida formato email
function validatesEmailFormatOf(field){
	var regex = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;

	var email = document.getElementById(field).value;
	if (regex.test(email) == false) {
		var error = document.getElementById("error");
		error.innerHTML = "Formato de email incorrecto";
		return false;
	} 
}
