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
                    <span>Nuevo Investigador</span>
                </div>
                <br class="clear"/>
                <div class="content">
                    <?php
                        include_once(PATH_BL . "InvestigadorDataProvider.php");
                        include_once(PATH_DL . "Investigador.php");
                        include_once(PATH_DL . "Usuario.php");
                        include_once(PATH_LIB . "Messages.php");

                        if(isset($_REQUEST["btnSubmit"])){
                            $datos_correctos = true;

                            // Realizamos las validaciones
                            if (empty($_REQUEST['txtNombres'])){
                                Messages::Error("Ingresa el nombre del investigador.");
                                $datos_correctos = false;
                            }
                            if(empty($_REQUEST["txtApellidoPaterno"])){
                                Messages::Error("Ingresa el Apellido Paterno del investigador.");
                                $datos_correctos = false;
                            }
                            if(empty($_REQUEST["txtNombreUsuario"])){
                                Messages::Error("Ingresa el nombre de usuario del investigador.");
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

                                $investigador = new Investigador();
                                $usuario = new Usuario();

                                $usuario->Nombre = $_REQUEST["txtNombreUsuario"];
                                $usuario->Password = $_REQUEST["txtPassword"];

                                $investigador->Nombres =  $_REQUEST["txtNombres"];
                                $investigador->ApellidoPaterno = $_REQUEST["txtApellidoPaterno"];
                                $investigador->ApellidoMaterno = $_REQUEST["txtApellidoMaterno"];

                                InvestigadorDataProvider::RegistrarInvestigador($investigador, $usuario);

                                $mensaje = "<script type=\"text/javascript\">";
                                $mensaje .= "alert(\"Investigador registrado correctamente.\");";
                                $mensaje .= "window.location = 'index.php';";
                                $mensaje .= "</script>";
                                echo $mensaje;
                            }
                        }
                    ?>
                    <form action="NuevoInvestigador.php" method="post" id="form_login" name="form_login">
                        <br class="clear">
                        <p>
                            <label class="required">Nombre(s):</label>
                            <br>
                            <input type="text" name="txtNombres" id="txtNombres" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label class="required">Apellido Paterno:</label>
                            <br>
                            <input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label>Apellido Materno:</label>
                            <br>
                            <input type="text" name="txtApellidoMaterno" id="txtApellidoMaterno" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label class="required">Nombre de usuario:</label>
                            <br>
                            <input type="text" name="txtNombreUsuario" id="txtNombreUsuario" value="<?php echo isset($investigador->Usuario->Nombre)?$investigador->Usuario->Nombre:""; ?>" style="width:300px" maxlength="45"/>
                        </p>
                        <br/>
                        <p>
                            <label class="required">Password:</label>
                            <br>
                            <input type="password" name="txtPassword" id="pwdPassword" style="width:300px" maxlength="45">
                        </p>
                        <br/>
                        <p>
                            <label>Introduce nuevamente el password:</label>
                            <br>
                            <input type="password" name="txtPasswordRepeticion" id="pwdPassword" style="width:300px" maxlength="45">
                        </p>
                        <br/>
                        <p>
                            <input name="btnSubmit" type="submit" value="Guardar"/>
                            &nbsp;&nbsp;&nbsp;
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