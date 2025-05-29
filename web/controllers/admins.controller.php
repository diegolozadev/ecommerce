<?php

class AdminsController{
    /*=========================
    LOGIN ADMINISTRADORES
    ============================*/

    public function login(){
        
        if(isset($_POST["loginAdminEmail"])){

            if(preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',$_POST["loginAdminEmail"])){

                $url = "admins?login=true&suffix=admin";
                $method = "POST";
                $fields = array(

                    "email_admin" => $_POST["loginAdminEmail"],
                    "password_admin" => $_POST["loginAdminPass"]
                );

                $login = CurlController::request($url,$method,$fields);
                
                if($login->status == 200){

                    $_SESSION["admin"] = $login->results[0];

                    echo '<script>

                        location.reload();
                    
                    </script>';
                }else{

                    $error = null;

                    if($login->results == "Wrong email"){

                        $error = "Correo mal escrito";

                    }else{

                        $error = "Contraseña mal escrita";
                    }

                    echo '<div class="alert alert-danger mt-3">Error al Ingresar: '.$error.'</div> 
                    
                        <script>
                            //fncNotie("error", "Error al Ingresar: '.$error.'");
                            fncSweetAlert("error","Error al Ingresar: '.$error.'","");
                            fncFormatInputs();
                        </script>
                    ';
                }
            }else{

                    echo '<div class="alert alert-danger mt-3">Error de sintaxis en los campos</div> 
    
                        <script>
                            //fncNotie("error", "Error de sintaxis en los campos");
                            fncSweetAlert("error","Error de sintaxis en los campos","");
                            fncFormatInputs();
                        </script>
                    ';
            }

        }
    }

    /*=========================
    RECUPERAR CONTRASEÑA
    ============================*/

    public function resetPassword(){
        
        if(isset($_POST["resetPassword"])){

            if(preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',$_POST["resetPassword"])){


                /*=========================
                PREGUNTAMOS PRIMERO SI EL USUARIO ESTA REGISTRADOS EN LA BASE DE DATOS
                ============================*/

                $url = "admins?linkTo=email_admin&equalTo=".$_POST["resetPassword"]."&select=id_admin";
                $method = "GET";
                $fields = array();

                $admin = CurlController::request($url,$method,$fields);
                
                if($admin->status == 200){
                    
                    function genPassword($length){

                        $password = "";
                        $chain = "0123456789abcdefghijklmnopqrstuvwxyz";

                        $password = substr(str_shuffle($chain),0,$length);

                        return $password;
                    }

                    $newPassword = genPassword(11);
                    $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');

                    /*=========================
                    ACTUALIZAR CONTRASEÑA EN BASE DE DATOS
                    ============================*/
                    
                    $url = "admins?id=".$admin->results[0]->id_admin."&nameId=id_admin&token=no&except=password_admin";
                    $method = "PUT";
                    $fields = "password_admin=".$crypt;

                    $updatePassword = CurlController::request($url,$method,$fields);

                    if($updatePassword->status == 200){

                        echo '<pre>'; print_r($newPassword); echo '</pre>';
                        echo '<pre>'; print_r($crypt); echo '</pre>';
                    }


                }else{

                    echo '<script>
                    
                        fncFormatInputs();
                        fncNotie("error", "El correo no existe en la base de datos");

                    
                    </script>';
                }
            }
        }

    }
}


?>