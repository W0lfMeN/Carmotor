/* Aqui añadiré mis propias funciones y metodos */

/* Funcion que se carga junto con la pagina */
function listeners(){
    document.getElementById("btnTop").addEventListener('click',topFunction);
}

function listenersAdmin(){
    //Cambiar imagen
    document.getElementById("imagen").addEventListener('change', cambiarImagen);
    document.getElementById("imagen1").addEventListener('change', cambiarImagen);
    document.getElementById("imagen2").addEventListener('change', cambiarImagen);

    document.getElementById("btnImg1").addEventListener('click', activarCampo);
    document.getElementById("btnImg2").addEventListener('click', activarCampo);
}

// Funcion que es ejecutada cuando el usuario pulsa en el boton del footer
function topFunction() {
  document.body.scrollTop = 0; // Solo funciona con Safari
  document.documentElement.scrollTop = 0; // Funciona con Chrome, Firefox, IE y Opera
}

/* Funcion que usa el sweet alert para preguntar si desea de verdad borrar el usuario o no */
function confirmar(formulario, mensaje){
    event.preventDefault();

    Swal.fire({
        title: '¿Seguro que desea borrar este '+mensaje+" ?",
        text: "Esta acción no se puede deshacer",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Borrar '+mensaje,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            formulario.submit(); /* Si se pulsa "si", se enviará el formulario que se le haya pasado, borrando el usuario seleccionado */
        }
    })
}

function error(mensaje){
    Swal.fire(
        'Error',
        mensaje,
        'error'
    )
}

function cambiarImagen(event){
    /* Averiguamos que boton se ha pulsado */

    var boton=event.target.getAttribute('id'); //Esto obtiene el id del boton que se ha pulsado
    var id;
    switch(boton){
        case "imagen1":
            id="previewImg1";
            break;
        case "imagen2":
            id="previewImg2";
            break;

        default:
            id="img";
            break;
    }
    /* console.log(mensaje+" => "+boton); */

    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload=(event)=>{
        document.getElementById(id).setAttribute('src', event.target.result)
    };
    reader.readAsDataURL(file);
}

function activarCampo(event){
    var boton=event.target.getAttribute('id'); //Esto obtiene el id del boton que se ha pulsado

    switch(boton){
        case "btnImg1":
            if(document.getElementsByName('imagen')[0].files[0]){
                document.getElementById('divImg1').hidden=true;
                document.getElementById('img1').hidden=false;
            }else
                error("Debe de subir una imagen en la primera casilla");

            break;

        case "btnImg2":
            if(document.getElementsByName('imagen1')[0].files[0]){
                document.getElementById('divImg2').hidden=true;
                document.getElementById('img2').hidden=false;
            }else
                error("Debe de subir una imagen en las dos anteriores casillas");

            break;
    }
}
