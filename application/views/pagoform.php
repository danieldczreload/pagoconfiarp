<div class="row">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <img src="<?=base_url()?>assets/images/confiarp.png" class="img-responsive animated fadeInDown slower" alt="Confiarp El Salvador" style="margin: 0 auto">
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-custom animated fadeIn slower" style="border-top: none">
                <div class="box-header">
                    <h3 class="box-title">Compra de Entradas Confiarp El Salvador 2019</h3>
                </div>
                <div class="box-body">
                    <?php
                    $errors = validation_errors();
                    if(!empty($errors)){
                        echo "<div class='alert alert-danger alert-dismissible'>
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                                    {$errors}
                                  </div>";
                    }
                    ?>

                    <?php
                    if($_SERVER['REQUEST_METHOD']=="GET"){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Pago Confiarp!</h4>
                        Usted ha sido dirigido aquí desde <a href="http://confiarpelsalvador.com">http://confiarpelsalvador.com</a>
                        para poder realizar el pago de sus entradas al evento de forma segura con certificado SSL el cual encriptará toda su información, garantizando total privacidad de los datos que nos brinde.
                        <br />
                    </div>
                    <?php
                    }
                    ?>

                    <div style="background-color: #eee;border: 1px #969393 solid;border-radius: 5px;padding: 20px;">
                        <h4>Por favor tome en cuenta lo siguiente:</h4>
                        <p>Si usted compra tickets para estudiantes (nivel de grado) o para miembros de la CONFIARP, el día del evento deberá presentar su carnet que lo identifique como tal, de lo contrario usted deberá pagar lo restante para un ticket profesional $200.00.</p>
                        <p>Una vez haya efectuado el pago de su compra de tickets, usted verá reflejado en su estado de cuenta de tarjeta de crédito o débito, un pago a nombre de <b>Sinérgica, la sociedad comercial mediante la cual está inscrito este sistema de pago para CONFIARP El Salvador 2019.</b></p>
                    </div>
                    <div class="col-md-10 col-md-offset-1">



                        <?php
                            $attributes = array('class' => 'form-horizontal');
                            echo form_open('/', $attributes);
                        ?>
                            <div class="box-body">
                                <div class="form-group <?=form_error("nombre")!=""?"has-error":""?>">
                                    <label for="nombre" class="col-sm-2 control-label">Nombre</label>

                                    <div class="col-sm-10">
                                        <!--<input type="text" class="form-control" id="nombre_cliente" placeholder="Nombre">-->
                                        <?=form_input(array("type"=>"text","class"=>"form-control","name"=>"nombre","placeholder"=>"Nombre"),set_value("nombre"))?>
                                    </div>
                                </div>
                                <div class="form-group <?=form_error("apellido")!=""?"has-error":""?>">
                                    <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                                    <div class="col-sm-10">
                                        <!--<input type="text" class="form-control" id="apellido_cliente" placeholder="Apellido">-->
                                        <?=form_input(array("type"=>"text","class"=>"form-control","name"=>"apellido","placeholder"=>"Apellido"),set_value("apellido"))?>
                                    </div>
                                </div>
                                <div class="form-group <?=form_error("email")!=""?"has-error":""?>">
                                    <label for="email" class="col-sm-2 control-label">Correo Electrónico</label>
                                    <div class="col-sm-10">
                                        <!--<input type="email" class="form-control" id="nombre_cliente" placeholder="Correo Electrónico">-->
                                        <?=form_input(array("type"=>"email","class"=>"form-control","name"=>"email","placeholder"=>"Email"),set_value("email"))?>
                                    </div>
                                </div>

                                <div class="form-group <?=form_error("edad")!=""?"has-error":""?>">
                                    <label for="edad" class="col-sm-2 control-label">Edad</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $data = array("type"=>"text",
                                                      "class"=>"slider form-control",
                                                      "data-slider-min"=>"0",
                                                      "data-slider-max"=>"100",
                                                      "data-slider-value"=>"0",
                                                      "data-slider-orientation"=>"horizontal",
                                                      "data-slider-tooltip"=>"show",
                                                      "data-slider-id"=>"blue",
                                                      "name"=>"edad",
                                                      "id"=>"edad",
                                                      "onchange"=>"rangevalue.value=edad.value",
                                                      "style"=>"width:88%;"


                                        );

                                        echo form_input($data,set_value("edad"));
                                        ?>
                                        <input id="rangevalue" readonly disabled value="<?=set_value("edad")?>"
                                               style="background-color: #00c0ef !important;
                                                        border: none;
                                                        height: 30px;
                                                        text-align: center;
                                                        color: white;
                                                        font-weight: bold;
                                                        width: 10%" />
                                    </div>
                                </div>

                                <div class="form-group <?=form_error("sexo")!=""?"has-error":""?>">
                                    <label for="sexo" class="col-sm-2 control-label">Sexo</label>
                                    <div class="col-sm-10">
                                        <label style="padding-right: 20px;">
                                            <input type="radio" name="sexo" class="minimal" value = 1 <?=set_value("sexo")==1?"checked":""?> />
                                            Femenino
                                        </label>
                                        <label style="padding-right: 20px;">
                                            <input type="radio" name="sexo" class="minimal" value = 2 <?=set_value("sexo")==2?"checked":""?> />
                                            Masculino
                                        </label>
                                        <label>
                                            <input type="radio" name="sexo" class="minimal" value = 3 <?=set_value("sexo")==3?"checked":""?> />
                                            Otros
                                        </label>
                                    </div>
                                </div>



                                <div class="form-group <?=form_error("paises")!=""?"has-error":""?>">
                                    <label for="paises" class="col-sm-2 control-label">País de procedencia</label>
                                    <div class="col-sm-10">
                                        <?= /** @var array $paises */
                                        form_dropdown("paises",$paises,array(),array("class"=>"select2 form-control",
                                                                                           "style"=>"width:100%",
                                                                                           "placeholder"=>"Seleccione uno"))?>
                                    </div>
                                </div>
                                <div class="form-group <?=form_error("profesion")!=""?"has-error":""?>">
                                    <label for="profesion" class="col-sm-2 control-label">Profesión</label>
                                    <div class="col-sm-10">
                                        <!--<input type="email" class="form-control" id="nombre_cliente" placeholder="Correo Electrónico">-->
                                        <?=form_input(array("type"=>"text","class"=>"form-control","name"=>"profesion","placeholder"=>"Profesión"),set_value("profesion"))?>
                                    </div>
                                </div>

                                <div class="form-group <?=form_error("trabajo")!=""?"has-error":""?>">
                                    <label for="trabajo" class="col-sm-2 control-label">Lugar de trabajo o estudio</label>
                                    <div class="col-sm-10">
                                        <!--<input type="email" class="form-control" id="nombre_cliente" placeholder="Correo Electrónico">-->
                                        <?=form_input(array("type"=>"text","class"=>"form-control","name"=>"trabajo","placeholder"=>"Lugar de trabajo o estudio"),set_value("trabajo"))?>
                                    </div>
                                </div>

                                <!--<label class="col-md-12" style="text-align: center;">Tickets</label>-->
                                <div style="clear: both"></div>
                                <br />
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box" style="border-top-color: #6ac9a8;">
                                            <div class="box-header with-border">
                                                <h6 class="box-title" style="color:#6ac9a8;">Estudiantes</h6>
                                                <div class="box-tools pull-right">
                                                    <input type="checkbox" name="cnestudiantes" id="cnestudiantes" value="1" <?=set_value("cnestudiantes")=="1"?"checked":""?> />
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body disabled box-estudiantes">
                                                <div style="width: 100%; text-align: center">
                                                    <h2 style="color:#6ac9a8;">$60</h2>
                                                </div>
                                                <div style="width: 100%;">
                                                    <label for="">Cantidad:</label>
                                                    <?=form_input(array("type"=>"number","name"=>"nestudiantes","id"=>"nestudiantes"),set_value("nestudiantes"))?>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box" style="border-top-color: #7046a0;">
                                            <div class="box-header with-border">
                                                <h6 class="box-title" style="color:#7046a0;">Profesionales</h6>
                                                <div class="box-tools pull-right">
                                                    <input type="checkbox" name="cnprofesionales" id="cnprofesionales" value="1" <?=set_value("cnprofesionales")=="1"?"checked":""?>/>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body disabled box-profesionales">
                                                <div style="width: 100%; text-align: center">
                                                    <h2 style="color:#7046a0;">$200</h2>
                                                </div>
                                                <div style="width: 100%;">
                                                    <label for="">Cantidad:</label>
                                                    <?=form_input(array("type"=>"number","name"=>"nprofesionales","id"=>"nprofesionales"),set_value("nprofesionales"))?>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box" style="border-top-color: #f27f6f;">
                                            <div class="box-header with-border">
                                                <h6 class="box-title" style="color:#f27f6f; font-size: 18px !important;">Miembro Confiarp</h6>
                                                <div class="box-tools pull-right">
                                                    <input type="checkbox" name="cnconfiarp" id="cnconfiarp" value="1" <?=set_value("cnconfiarp")=="1"?"checked":""?> />
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body disabled box-confiarp">
                                                <div style="width: 100%; text-align: center">
                                                    <h2 style="color:#f27f6f;">$150</h2>
                                                </div>
                                                <div style="width: 100%;">
                                                    <label for="">Cantidad:</label>
                                                    <?=form_input(array("type"=>"number","name"=>"nconfiarp","id"=>"nconfiarp"),set_value("nconfiarp"))?>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer" style="text-align: center">
                                <button type="submit" class="btn btn-info">Realizar pago</button>
                            </div>
                            <!-- /.box-footer -->
                        <?php
                            echo form_close();
                        ?>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
     </section>
</div>

<script>
    $(document).ready(function(){
       $('.select2').select2({
           placeholder: "Seleccione uno",
           allowClear: true
       });
        $('.slider').slider();

        $(".slider-horizontal").css("display","inline-block");


        $('#edad').slider('setValue', parseInt(<?=set_value("edad")?set_value("edad"):0?>));
        rangevalue.value=<?=set_value("edad")?set_value("edad"):0?>;
        edad.value= <?=set_value("edad")?set_value("edad"):0?>;

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        });

        $("input[type='number']").inputSpinner();


        $("#cnestudiantes").click(function(){
            if($(this).is(":checked")){
                $(".box-estudiantes").removeClass("disabled");
            }else{
                $(".box-estudiantes").addClass("disabled");
            }
        });

        if($("#cnestudiantes").is(":checked")){
            $(".box-estudiantes").removeClass("disabled");
        }else{
            $(".box-estudiantes").addClass("disabled");
        }

        $("#cnprofesionales").click(function(){
            if($(this).is(":checked")){
                $(".box-profesionales").removeClass("disabled");
            }else{
                $(".box-profesionales").addClass("disabled");
            }
        });

        if($("#cnprofesionales").is(":checked")){
            $(".box-profesionales").removeClass("disabled");
        }else{
            $(".box-profesionales").addClass("disabled");
        }

        $("#cnconfiarp").click(function(){
            if($(this).is(":checked")){
                $(".box-confiarp").removeClass("disabled");
            }else{
                $(".box-confiarp").addClass("disabled");
            }
        });

        if($("#cnconfiarp").is(":checked")){
            $(".box-confiarp").removeClass("disabled");
        }else{
            $(".box-confiarp").addClass("disabled");
        }

      $("#btn-cerrar").click(function(){
          window.close();
      });


    });

    function close_window() {
        if (confirm("Desea cancelar solicitud?")) {
            close();
        }
    }
</script>
<style>
    .input-group-addon{
        padding: 0px;
        border-radius: 0px;
        border: none;
    }
</style>