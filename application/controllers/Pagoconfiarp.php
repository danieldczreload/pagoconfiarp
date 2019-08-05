<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/pagadito/config.php');
require_once(APPPATH.'libraries/pagadito/Pagadito.php');

class Pagoconfiarp extends CI_Controller
{

    public function index(){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model("Pago_model");
        $this->load->database();

        $this->config->set_item('language', 'spanish');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email');
        $this->form_validation->set_rules('edad', 'Edad', 'required|greater_than[0]');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required');
        $this->form_validation->set_rules('paises', 'País de procedencia', 'required');
        $this->form_validation->set_rules('trabajo', 'Lugar de trabajo o estudio', 'required');
        $this->form_validation->set_rules('profesion', 'Profesión', 'required');
        $this->form_validation->set_rules('nestudiantes', '', 'callback_cantidad');
        $ban = false;

        if ($this->input->server('REQUEST_METHOD') == 'POST'){
            if ($this->form_validation->run())
            {
                $solicitud = array(
                    "nombre"=> $this->input->post("nombre"),
                    "apellido"=> $this->input->post("apellido"),
                    "email"=> $this->input->post("email"),
                    "edad"=> $this->input->post("edad"),
                    "sexo"=> $this->input->post("sexo"),
                    "pais_id"=> $this->input->post("paises"),
                    "profesion"=> $this->input->post("profesion"),
                    "lugar_trabajo_estudio"=> $this->input->post("trabajo"),
                    "status"=>1
                );


                try{
                    $solicitudId = $this->Pago_model->setSolicitud($solicitud);

                    if(!empty($this->input->post("nestudiantes"))){
                        $detalle = array('solicitud_id'=>$solicitudId,
                            'tipo_detalle'=>1,
                            'punitario'=>60,
                            'cantidad'=>$this->input->post("nestudiantes")
                        );
                        $this->Pago_model->setDetalleSolicitud($detalle);
                    }

                    if(!empty($this->input->post("nprofesionales"))){
                        $detalle = array('solicitud_id'=>$solicitudId,
                            'tipo_detalle'=>2,
                            'punitario'=>200,
                            'cantidad'=>$this->input->post("nprofesionales")
                        );
                        $this->Pago_model->setDetalleSolicitud($detalle);
                    }

                    if(!empty($this->input->post("nconfiarp"))){
                        $detalle = array('solicitud_id'=>$solicitudId,
                            'tipo_detalle'=>3,
                            'punitario'=>150,
                            'cantidad'=>$this->input->post("nconfiarp")
                        );
                        $this->Pago_model->setDetalleSolicitud($detalle);
                    }

                    $Pagadito = new Pagadito(UID, WSK);

                    if (SANDBOX) {
                        $Pagadito->mode_sandbox_on();
                    }

                    if ($Pagadito->connect()){

                        if(!empty($this->input->post("nestudiantes"))){
                            $Pagadito->add_detail($this->input->post("nestudiantes"), 'Ticket Entrada Estudiante Confiarp', 60, 'http://confiarpelsalvador.com');

                        }

                        if(!empty($this->input->post("nprofesionales"))){
                            $Pagadito->add_detail($this->input->post("nprofesionales"), 'Ticket Entrada Profesional Confiarp', 200, 'http://confiarpelsalvador.com');
                        }

                        if(!empty($this->input->post("nconfiarp"))){
                            $Pagadito->add_detail($this->input->post("nconfiarp"), 'Ticket Entrada Miembros Confiarp', 150, 'http://confiarpelsalvador.com');
                        }
                        $Pagadito->enable_pending_payments();

                        $ern = $solicitudId;

                        if (!$Pagadito->exec_trans($ern)) {
                            /*
                             * En caso de fallar la transacción, verificamos el error devuelto.
                             * Debido a que la API nos puede devolver diversos mensajes de
                             * respuesta, validamos el tipo de mensaje que nos devuelve.
                             */
                            $error = $Pagadito->get_rs_code()." ".$Pagadito->get_rs_message();
                            throw new Exception($error);
                        }
                    }else{
                        $msg= "";
                        switch($Pagadito->get_rs_code())
                        {
                            case "PG2001":
                                $msg= "No se puede conectar a la pasarela de pago, intente mas tarde. PG2001 Data incompleta";
                                break;
                                /*Incomplete data*/
                            case "PG3001":
                                /*Problem connection*/
                                $msg= "No se puede conectar a la pasarela de pago, intente mas tarde. PG3001 Problemas de conexion";
                                break;
                            case "PG3002":
                                /*Error*/
                                $msg= "No se puede conectar a la pasarela de pago, intente mas tarde. PG3002 Error";
                                break;
                            case "PG3003":
                                /*Unregistered transaction*/
                                $msg= "No se puede conectar a la pasarela de pago, intente mas tarde. PG3003 Transaccion no registrada";
                                break;
                            case "PG3005":
                                /*Disabled connection*/
                                $msg= "No se puede conectar a la pasarela de pago, intente mas tarde. PG3005 Conexion deshabilitada";
                                break;
                            case "PG3006":
                                /*Exceeded*/
                                $msg= "No se puede conectar a la pasarela de pago, intente mas tarde. PG3006 Exceeded";
                                break;
                            default:
                                $msg= "No se puede conectar a la pasarela de pago, intente mas tarde. {$Pagadito->get_rs_code()} {$Pagadito->get_rs_message()}";

                        }
                        throw new Exception($msg);
                    }

                }catch(Exception $e){
                    $this->db->set("status",3);
                    $this->db->set("pagadito_info",$e->getMessage());
                    $this->db->where("id",$solicitudId);
                    $this->db->update("solicitudes");
                    $ban = true;
                }
            }
        }


        if($ban){
            $this->load->view('layout/header');
            $this->load->view('error',array("error"=>$e->getMessage()));
            $this->load->view('layout/footer');
        }else{
            $paises = $this->Pago_model->getPaises();

            $this->load->view('layout/header');
            $this->load->view('pagoform',array("paises"=>$paises));
            $this->load->view('layout/footer');
        }
    }

    public function payback($token,$ern){
        $this->load->helper(array('url'));
        $this->load->model("Pago_model");
        $this->load->database();
        if($token){
            $Pagadito = new Pagadito(UID, WSK);
            if (SANDBOX) {
                $Pagadito->mode_sandbox_on();
            }

            if ($Pagadito->connect()){
                if ($Pagadito->get_status($token)){
                    switch($Pagadito->get_rs_status())
                    {
                        case "COMPLETED":
                            /*
                             * Tratamiento para una transacción exitosa.
                             */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                            $msgPrincipal = "Su compra fue exitosa";
                            $msgSecundario = '
                    NAP(N&uacute;mero de Aprobaci&oacute;n Pagadito): <label class="respuesta">' . $Pagadito->get_rs_reference() . '</label><br />
                    Numero de Identificacion de Solicitud: <label class="respuesta">'.$ern.'</label><br />
                    Fecha Respuesta: <label class="respuesta">' . $Pagadito->get_rs_date_trans() . '</label><br /><br />
                    <div style="width:100%; text-align: center"><a style="text-decoration: none;" class="btn btn-success" href="/pagoconfiarp/pagoconfiarp/printvoucher/'.$token.'" target="_blank">Imprimir comprobante</a></div>
                    ';

                            $data = array('pagadito_info'=>$Pagadito->get_rs_reference(),
                                          'token'=> $token,
                                          'status' =>4);
                            $this->Pago_model->updateSolicitud($data,$ern);
                            $this->sendEmail($token);
                            break;

                        case "REGISTERED":

                            /*
                             * Tratamiento para una transacción aún en
                             * proceso.
                             */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                            $msgPrincipal = "Atenci&oacute;n";
                            $msgSecundario = "La transacci&oacute;n fue cancelada.<br /><br />";
                            $data = array('pagadito_info'=>$Pagadito->get_rs_reference(),
                                'token'=> $token,
                                'status' =>3);
                            $this->Pago_model->updateSolicitud($data,$ern);
                            break;

                        case "VERIFYING":

                            /*
                             * La transacción ha sido procesada en Pagadito, pero ha quedado en verificación.
                             * En este punto el cobro xha quedado en validación administrativa.
                             * Posteriormente, la transacción puede marcarse como válida o denegada;
                             * por lo que se debe monitorear mediante esta función hasta que su estado cambie a COMPLETED o REVOKED.
                             */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                            $msgPrincipal = "Atenci&oacute;n";
                            $msgSecundario = '
                    Su pago est&aacute; en validaci&oacute;n.<br />
                    NAP(N&uacute;mero de Aprobaci&oacute;n Pagadito): <label class="respuesta">' . $Pagadito->get_rs_reference() . '</label><br />
                    Fecha Respuesta: <label class="respuesta">' . $Pagadito->get_rs_date_trans() . '</label><br /><br />';
                            $data = array('pagadito_info'=>$Pagadito->get_rs_reference(),
                                'token'=> $token);
                            $this->Pago_model->updateSolicitud($data,$ern);
                            break;

                        case "REVOKED":

                            /*
                             * La transacción en estado VERIFYING ha sido denegada por Pagadito.
                             * En este punto el cobro ya ha sido cancelado.
                             */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                            $msgPrincipal = "Atenci&oacute;n";
                            $msgSecundario = "La transacci&oacute;n fue denegada.<br /><br />";
                            $data = array('pagadito_info'=>$Pagadito->get_rs_reference(),
                                'token'=> $token,
                                'status' =>3);
                            $this->Pago_model->updateSolicitud($data,$ern);
                            break;

                        case "FAILED":
                            /*
                             * Tratamiento para una transacción fallida.
                             */
                            $data = array('pagadito_info'=>$Pagadito->get_rs_reference(),
                                'token'=> $token,
                                'status' =>3);
                            $this->Pago_model->updateSolicitud($data,$ern);
                        default:

                            /*
                             * Por ser un ejemplo, se muestra un mensaje
                             * de error fijo.
                             */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                            $msgPrincipal = "Atenci&oacute;n";
                            $msgSecundario = "La transacci&oacute;n no fue realizada.<br /><br />";
                            $data = array('pagadito_info'=>$Pagadito->get_rs_reference(),
                                'token'=> $token,
                                'status' =>3);
                            $this->Pago_model->updateSolicitud($data,$ern);
                            break;
                    }
                }else{
                    $msgPrincipal = "Error en la transacci&oacute;n";
                    $msgSecundario = "La transacci&oacute;n no fue completada.<br /><br />";
                }
            }else{
                $msgPrincipal = "Respuesta de Pagadito API";
                $msgSecundario = "
                        COD: " . $Pagadito->get_rs_code() . "<br />
                        MSG: " . $Pagadito->get_rs_message() . "<br /><br />";
            }
        }else{
            $msgPrincipal = "Atenci&oacute;n";
            $msgSecundario = "No se recibieron los datos correctamente.<br /> La transacci&oacute;n no fue completada.<br /><br />";
        }
        $this->load->view('layout/header');
        $this->load->view('success',array("header"=>$msgPrincipal,"msg"=>$msgSecundario));
        $this->load->view('layout/footer');
        

    }

    public function cantidad($str){
        if(!empty($this->input->post("nestudiantes")) ||
            !empty($this->input->post("nprofesionales")) ||
            !empty($this->input->post("nconfiarp"))){
            return true;
        }else{
            $this->form_validation->set_message('cantidad', 'Debe escoger por lo menos un tipo de ticket y una cantidad mayor a 0 para proceder con la compra');
            return false;
        }
    }

    public function printVoucher($token){
        try{
            $this->load->helper(array('url'));
            $this->load->model("Pago_model");
            $this->load->database();
            $solicitud = $this->Pago_model->getSolicitud($token);
            $solicitud = reset($solicitud);

            if($solicitud["status"]=="4"){
                //I'm just using rand() function for data example
                $barcode = $this->getCodigoBarrasBase64($solicitud["pagadito_info"]);
                $pais = $this->Pago_model->getNombrePais($solicitud["pais_id"]);
                $detalleSolicitud = $this->Pago_model->getDetalleSolicitud($solicitud["id"]);
                $this->load->view("voucher",array("barcode"=>$barcode,
                                                  "solicitud"=>$solicitud,
                                                  "pais"=>$pais,
                                                  "detalleSolicitud"=>$detalleSolicitud
                                                 )
                                 );
            }else{
                throw new Exception("Solicitud no valida");
            }

        }catch(Exception $e){
            //var_dump($e->getMessage());
            header("HTTP/1.0 404 Not Found");
            die();
        }
    }

   /* public function set_barcode($code)
    {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode

        ob_start();
        Barcode::render('code128', 'image', array('text'=>$code), array());
        $contents = base64_encode(ob_get_contents());
        ob_end_clean();
        return $contents;

    }*/

    private function getCodigoBarrasBase64($code)
    {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        ob_start();
        $text = $code;
        //$options = array('text' => (string) $text, 'imageType' => 'jpeg', 'drawText' => false);
        $barcodeOBj = Barcode::factory('code128', 'image', array('text'=>$code), array());
        $imageResource = $barcodeOBj->draw();
        imagejpeg($imageResource);
        $contents = ob_get_contents();
        ob_end_clean();
        return base64_encode($contents);
    }

    public function sendEmail($token){
        $this->load->helper(array('url'));
        $this->load->library('email');

        $this->load->model("Pago_model");
        $this->load->database();
        $solicitud = $this->Pago_model->getSolicitud($token);
        $solicitud = reset($solicitud);
        $email = $solicitud["email"];
        $pais = $this->Pago_model->getNombrePais($solicitud["pais_id"]);
        $detalleSolicitud = $this->Pago_model->getDetalleSolicitud($solicitud["id"]);

        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.danieldelcid.com',
            'smtp_port' => 587,
            'smtp_user' => 'pagoconfiarp@danieldelcid.com',
            'smtp_pass' => '?7Y&F@^ks$$(',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

//Email content
        $htmlContent = $this->load->view('emailBody',array("solicitud"=>$solicitud,
                                                           "pais"=>$pais,
                                                           "detalleSolicitud"=>$detalleSolicitud,
                                                           "token"=>$token
                                                          ),TRUE);


        $this->email->to($email);
        $this->email->from('pagoconfiarp@danieldelcid.com','Confiarp El Salvador 2019');
        $this->email->subject('Recibo de entradas al congreso Confiarp El Salvador 2019');
        $this->email->message($htmlContent);
        $i=0;
        $it = false;
        while(!$it && $i<=3){
            $it=$this->email->send();    
            $i++;
        }
    
    }
}