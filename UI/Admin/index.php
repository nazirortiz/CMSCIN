<?php
    include_once("../../Config/Config.php");
    include_once(PATH_TPT . "Header.php");
    include_once(PATH_TPT . "LeftPanelAdmin.php");

?>
 <!-- Begin content -->
<div id="content">
    <?php
        $investigador = Investigador::first();
        
        echo $investigador->usuarios->id . "<br>";
        echo $investigador->usuarios->nombre . "<br>";
        echo $investigador->usuarios->password . "<br>";
        
        $investigadores[] = $investigador;
        $total_investigadores = count($investigadores);
    ?>
    <div class="inner">
        <!-- Begin one column window -->
        <div class="onecolumn">
            <div class="header">
                <span>Investigadores Registrados (<?php echo $total_investigadores; ?>)</span>
            </div>
            <br class="clear"/>
            <div class="content">
                <form id="form_data" name="form_data" action="" method="post">
                    <?php
                        if ($total_investigadores > 0)
                        {    
                            include_once(PATH_UC . "UCTable.php");
                            
                            $tblInvestigadores = new UCTable();
                            $tblInvestigadores->TableName("tblInvestigadores1");

                            $tblInvestigadores->AddColumn(new TextColumn("nombres", "Nombre(s)"));
                            $tblInvestigadores->AddColumn(new TextColumn("apellidopaterno", "Apellido Paterno"));
                            $tblInvestigadores->AddColumn(new TextColumn("apellidomaterno", "Apellido Materno"));
                            //$tblInvestigadores->AddColumn(new HyperLinkColumn("nombreusuario", "Visitar", "RutaUsuario"));

                            $tblInvestigadores->EnabledActionColumn(true);
                            $tblInvestigadores->PageModification("ModificarInvestigador.php", "idinvestigador");
                            $tblInvestigadores->PageElimination("EliminarInvestigador.php", "idinvestigador");
                            $tblInvestigadores->MensajeConfirmacionEliminacion("¿Realmente desea eliminar el investigador?");

                            $tblInvestigadores->DataSource($investigadores);
                            $tblInvestigadores->Bind();
                        }
                        else
                        {
                            echo "<h2 align=\"center\">No hay investigadores registrados.</h2>";
                        }
                    ?>
                <p>
                    <a href="NuevoInvestigador.php">
                        <input type="button" value="Nuevo Investigador">
                    </a>
                </p>
                </form>
            </div>
            <!-- End Content -->
        </div>
        <!-- End one column window -->
</div>
<?php
    include_once(PATH_TPT . "Footer.php");
?>