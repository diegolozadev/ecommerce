/*============================================
FORMATEAR ENVIO DE FORMULARIO LADO DEL SERVIDOR
==============================================*/

function fncFormatInputs(){

    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
    }
}

/*============================================
Alerta Notie
==============================================*/

function fncNotie(type, text){

    notie.alert({

        type:type,
        text:text,
        time:10
    })
}

/*============================================
Alerta SweerAlert
==============================================*/

function fncSweetAlert(type, text, url){

    switch (type){

        case "error":

        if(url == ""){
        
            Swal.fire({

                icon:"error",
                title: "Error",
                text: text
            })
        }else{

            Swal.fire({

                icon:"error",
                title: "Error",
                text: text
            }).then((result)=>{
                window.open(url, "top");
            })

        }

        break;

        case "success":

        if(url == ""){
        
            Swal.fire({

                icon:"success",
                title: "Correcto",
                text: text
            })
        }else{

            Swal.fire({

                icon:"success",
                title: "Correcto",
                text: text
            }).then((result)=>{
                window.open(url, "top");
            })

        }

        break;

    }
}