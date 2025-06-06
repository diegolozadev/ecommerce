<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TemplateController{

    //Vista principal de la Plantilla
    public function index(){
        require_once 'views/template.php';
    }

    /*==================================
    Ruta principal
    ====================================*/
    static public function path(){

        if(!empty($_SERVER["HTTPS"]) && ("on" == $_SERVER["HTTPS"])){
        
            return "https://".$_SERVER["SERVER_NAME"]."/";  
        }else{
            return "http://".$_SERVER["SERVER_NAME"]."/";
        }
    }

    /*==================================
    Función para enviar correos electrónicos
    ====================================*/
    static public function sendEmail($subject, $email, $title, $message, $link){

        date_default_timezone_set("America/Bogota");

        $mail = new PHPMailer;

        $mail->CharSet = 'utf-8';
        //$mail->Encoding = 'base64'; //Habilitar al subir el sistema a un Hosting

        $mail->isMail();

        $mail->UseSendmailOptions = 0;

        $mail->setFrom("noreply@ecommerce.com", "Ecommerce");

        $mail->Subject = $subject;

        $mail->addAddress($email);

        $mail->msgHTML('<div style="width: 100%; background: #eee; position: relative; font-family: sans-serif; padding-top: 40px;
    padding-bottom: 40px;">

        <div style="position: relative; margin:auto; width: 600px; background:white; padding: 20px;">

            <center>
                <img src="'.TemplateController::path().'views/assets/img/template/1/logo.png" style="padding: 20ox; width: 30%;">

                <h3 style="font-weight: 100; color: #999;">'.$title.'</h3>

                <hr style="border: 1px solid #ccc; width: 80%">

                '.$message.'

                <a href="'.$link.'" target="_blank" style="text-decoration: none;">

                    <div style="line-height: 25px; background: #000; width: 60%; padding: 10px; color: white; border-radius: 5px;">Haz clic aquí</div>
                </a>

                <br>

                <hr style="border: 1px solid #ccc; width: 80%">

                <h5 style="font-weight: 100; color: #999;">Si no solicitó el envio de este correo, comuniquese con nosotros de inmediato</h5>

            </center>

        </div>


    </div>');

        $send = $mail->Send();

        if(!$send){

            return $mail->ErrorInfo;

        }else{

            return 'Ok';
        }

    }

    /*======================================
     * FUNCIÓN PARA LIMPIAR HTML
     *========================================*/
    static public function htmlClean($code){

        $search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');

		$replace = array('>','<','\\1');

		$code = preg_replace($search, $replace, $code);

		$code = str_replace("> <", "><", $code);

		return $code;
    }

    /*=============================================
    Función para mayúscula inicial
    =============================================*/

    static public function capitalize($value){

        $value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
        return $value;

	}

}