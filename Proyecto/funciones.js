function validarComponente() {


    var nombre = document.getElementById('nom_nuevo').value;
    var apellidos = document.getElementById('ape_nuevo').value;
    var email = document.getElementById('ema_nuevo').value;
    var contraseña1 = document.getElementById('pas_nuevo1').value;
    var contraseña2 = document.getElementById('pas_nuevo2').value;
    var direccion = document.getElementById('dir_nuevo').value;
    var telefono = document.getElementById('tel_nuevo').value;
    var tipo = document.getElementById('tip_nuevo').value;
    var estado = document.getElementById('est_nuevo').value;

    var errores = "Errores: ";
    var resultado = true;

    /*
		Comprobar nombre
	*/
    var regEx = /^[A-Za-zÁ-Úá-ú -]+$/;
    if(nombre == ''){
    	errores = errores.concat("\nDebe introducir un nombre ");
    	resultado = false;
    }else if(!nombre.match(regEx)){
    	errores = errores.concat("\nDebe introducir un nombre válido");
    	resultado = false;
    }

    /*
		Comprobar apellidos
	*/
    var regEx = /^[A-Za-zÁ-Úá-ú -]+$/;
    if(apellidos == ''){
    	errores = errores.concat("\nDebe introducir los apellidos ");
    	resultado = false;
    }else if(!apellidos.match(regEx)){
    	errores = errores.concat("\nDebe introducir unos apellidos válidos");
    	resultado = false;
    }

    /*
		Comprobar email
	*/
    var regEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(email == ''){
    	errores = errores.concat("\nDebe introducir un email ");
    	resultado = false;
    }else if(!email.match(regEx)){
    	errores = errores.concat("\nDebe introducir un email válido");
    	resultado = false;
    }

    /*
		Comprobar contraseña 1
	*/
    var regEx = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    if(contraseña1 == ''){
    	errores = errores.concat("\nDebe introducir una contraseña ");
    	resultado = false;
    }else if(!contraseña1.match(regEx)){
    	errores = errores.concat("\nDebe introducir una contraseña válida, debe contener entre 8 y 16 caracteres y al menos un número y una letra mayúscula");
    	resultado = false;
    }

    /*
		Comprobar contraseña 2
	*/
    var regEx = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    if(contraseña2 == ''){
    	errores = errores.concat("\nDebe introducir una contraseña ");
    	resultado = false;
    }else if(!contraseña2.match(regEx)){
    	errores = errores.concat("\nDebe introducir una contraseña válida");
    	resultado = false;
    }else if(contraseña2 !== contraseña1){
    	errores = errores.concat("\nLas contraseñas deben coincidir");
    	resultado = false;
    }

    /*
		Comprobar direccion
	*/
	regEx = /^[A-Za-zÁ-Úá-ú -.,]+$/;
	if(direccion ==''){
    	errores = errores.concat("\nDebe introducir una direccion ");
    	resultado = false;
    }else if(!direccion.match(regEx)){
    	errores = errores.concat("\nDebe introducir una direccion válida");
    	resultado = false;
    }

    /*
		Comprobar telefono
	*/
    var regEx = /^([0-9])*$/;
    if(telefono == ''){
    	errores = errores.concat("\nDebe introducir un telefono ");
    	resultado = false;
    }else if(!telefono.match(regEx)){
    	errores = errores.concat("\nDebe introducir un telefono válido");
    	resultado = false;
    }

    /*
		Comprobar tipo
	*/
    var regEx = /^[A-Za-zÁ-Úá-ú -]+$/;
    if(tipo == ''){
    	errores = errores.concat("\nDebe introducir el tipo ");
    	resultado = false;
    }else if(!tipo.match(regEx)){
    	errores = errores.concat("\nDebe introducir un tipo válido");
    	resultado = false;
    }

    /*
		Comprobar estado
	*/
    var regEx = /^[A-Za-zÁ-Úá-ú -]+$/;
    if(estado == ''){
    	errores = errores.concat("\nDebe introducir el estado ");
    	resultado = false;
    }else if(!estado.match(regEx)){
    	errores = errores.concat("\nDebe introducir un estado válido");
    	resultado = false;
    }

    if(resultado==false)
	     alert(errores);

    return resultado;
}
