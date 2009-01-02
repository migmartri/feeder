/*Librería de apoyo donde tendremos métodos standard de validaciones*/

//Valida presencia
//Ejemplo: validatesPresenceOf("login", "El nombre de usuario no se debe dejar vacío");
function validatesPresenceOf(field, msg){
  if(msg == undefined){msg = field + ": No se puede dejar vacío";}
  if(document.getElementById(field).value == ''){
    addError(msg);
  }
}

//Valida dos campos iguales
function validatesConfirmationOff(field1, field2, msg){
  if(msg == undefined){msg = "Las contraseñas no coinciden";}
	var p1 = document.getElementById(field1).value;
	var p2 = document.getElementById(field2).value;
	
	if (p1 != p2) {
		addError(msg);
	}
}

//Valida formato email
function validatesEmailFormatOf(field, msg){
  if(msg == undefined){msg = "Formato de email incorrecto";}
	var regex = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;

	var email = document.getElementById(field).value;
	if (regex.test(email) == false) {
    addError(msg);
	} 
}

function validatesUrlFormatOf(field, msg) {
  if(msg == undefined){msg = field + "con formato incorrecto";}
	var url = document.getElementById(field).value;
   var regexp = /^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
   if(!regexp.test(url) && url.length > 0){
     addError(msg);
   }
}

//Validar logitud
function validatesLengthOf(field, length, msg){
  if(msg == undefined){msg = field + "debe tener tamaño" + length;}
	var p = document.getElementById(field).value;
   if(p.length != length && p.length > 0){
     addError(msg);
   }
}

//Validar que es un número
function validatesNumericalityOf(field, msg){
  if(msg == undefined){msg = field + "debe ser un número"};
	var p = document.getElementById(field).value;
  var regexp = /(^([0-9]{1,})|^)$/
  if(!regexp.test(p)){
    addError(msg);
  }
}

//Añadimos el error al array de errores.
function addError(msg){
  errors.push(msg);
}

//Mostramos una lista con los errores y cancelamos el envío del formulario
function showErrors(){
  if(errors.length > 0){
    var html = "<div id='flash' class='error'><ul>";
    for(var i=0; i< errors.length; i++){
      html += '<li>' + errors[i] + '</li>';
    }
    html += "</ul></div>"
    document.getElementById('errors').innerHTML= html;
    return false
  }else{
    return true
  }
}
