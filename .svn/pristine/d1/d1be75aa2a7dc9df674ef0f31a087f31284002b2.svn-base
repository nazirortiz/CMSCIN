<?php
    include_once("../../Config/Config.php");
    include_once(PATH_TPT . "Header.php");
    include_once(PATH_TPT . "LeftPanelAdmin.php");
?>
 <!-- Begin content -->
<div id="content">
    <div class="inner">
       <!-- Begin left column window -->
        <div class="onecolumn">
                <div class="header">
                    <span>Modificar Investigador</span>
                </div>
                <br class="clear"/>
                <div class="content">
                    <?php
                        include_once(PATH_BL . "InvestigadorDataProvider.php");
                        include_once(PATH_DL . "Investigador.php");
                        include_once(PATH_DL . "Usuario.php");
                        include_once(PATH_LIB . "Messages.php");

                        $investigador = new Investigador();

                        // TODO: Validar que envie un entero
                        if (isset($_REQUEST['id'])){
                            $idInvestigador = $_REQUEST['id'];
                            $investigador = InvestigadorDataProvider::ObtenerInvestigador($idInvestigador);
                        }

                        if(isset($_REQUEST["btnSubmit"])){

                            $datos_correctos = true;

                            // Realizamos las validaciones
                            if (empty($_REQUEST['txtNombres'])){
                                Messages::Error("Ingresa el nombre del investigador.");
                                $datos_correctos = false;
                            }
                            if(empty($_REQUEST["txtApellidoPaterno"])){
                                Messages::Error("Ingresa el apellido paterno del investigador.");
                                $datos_correctos = false;
                            }
                             if(empty($_REQUEST["txtApellidoMaterno"])){
                                Messages::Error("Ingresa el apellido materno del investigador.");
                                $datos_correctos = false;
                            }
                            if(empty($_REQUEST["txtPassword"])){
                                Messages::Error("Ingresa el password del investigador.");
                                $datos_correctos = false;
                            }
                            if(!empty($_REQUEST["txtPassword"]) && ($_REQUEST["txtPassword"] != $_REQUEST['txtPasswordRepeticion'])){
                                Messages::Error("Los password no coinciden.");
                                $datos_correctos = false;
                            }

                            if ($datos_correctos){
                                $investigador->Nombres =  $_REQUEST["txtNombres"];
                                $investigador->ApellidoPaterno = $_REQUEST["txtApellidoPaterno"];
                                $investigador->ApellidoMaterno = $_REQUEST["txtApellidoMaterno"];

                                $investigador->Usuario->Password = $_REQUEST["txtPassword"];

                                InvestigadorDataProvider::ActualizarInvestigador($investigador);

                                $mensaje = "<script type=\"text/javascript\">";
                                $mensaje .= "alert(\"Investigador modificado correctamente.\");";
                                $mensaje .= "window.location = 'index.php';";
                                $mensaje .= "</script>";
                                echo $mensaje;
                            }
                        }
                    ?>
                    <form method="post" id="form_login" name="form_login">
                        <br class="clear">
                        <p>
                            <label>Nombre(s):</label>
                            <br>
                            <input type="text" name="txtNombres" value="<?php echo $investigador->Nombres; ?>" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label>Apellido Paterno:</label>
                            <br>
                            <input type="text" name="txtApellidoPaterno" value="<?php echo $investigador->ApellidoPaterno; ?>" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label>Apellido Materno:</label>
                            <br>
                            <input type="text" name="txtApellidoMaterno" value="<?php echo $investigador->ApellidoMaterno; ?>" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label>Nombre de usuario:</label>
                            <br>
                            <input type="text" name="txtNombreUsuario" readonly value="<?php echo $investigador->Usuario->Nombre; ?>" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label>Nuevo password:</label>
                            <br>
                            <input type="password" name="txtPassword" value="<?php echo $investigador->Usuario->Password; ?>" style="width:300px" title="******" maxlength="45">
                        </p>
                        <br/>
                        <p>
                            <label>Repite el Password:</label>
                            <br>
                            <input type="password" name="txtPasswordRepeticion" value="<?php echo $investigador->Usuario->Password; ?>" style="width:300px" title="******" maxlength="45">
                        </p>
                        <br/>
                        <p>
                            <input name="btnSubmit" type="submit" value="Guardar"/>&nbsp;&nbsp;&nbsp;
                             <a href="index.php">
                                <input type="button" value="Cancelar">
                            </a>
                        </p>
                    </form>
                </div>
        </div>
        <!-- End two column window -->
    </div>
<?php
    include_once(PATH_TPT . "Footer.php");
?>