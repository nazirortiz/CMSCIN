<?php
    include_once("../../Config/Config.php");
    include_once(PATH_TPT . "Header.php");
    //include_once(PATH_TPT . "LeftPanelInvestigador.php");
?>
 <!-- Begin content -->
<div id="content">
    <?php
        include_once(PATH_BL . "InvestigadorDataProvider.php");
        $investigadores = InvestigadorDataProvider::ObtenerInvestigadores();
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
                        if ($total_investigadores > 0){
                            include_once(PATH_UC . "UCTable.php");

                            $tblInvestigadores = new UCTable();
                            $tblInvestigadores->TableName("tblInvestigadores1");

                            $tblInvestigadores->AddColumn(new TextColumn("Nombres", "Nombre(s)"));
                            $tblInvestigadores->AddColumn(new TextColumn("ApellidoPaterno", "Apellido Paterno"));
                            $tblInvestigadores->AddColumn(new TextColumn("ApellidoMaterno", "Apellido Materno"));
                            $tblInvestigadores->AddColumn(new HyperLinkColumn("NombreUsuario", "Visitar", "RutaUsuario"));

                            $tblInvestigadores->EnabledActionColumn(false);
                            //$tblInvestigadores->PageModification("ModificarInvestigador.php", "IdInvestigador");
                            //$tblInvestigadores->PageElimination("EliminarInvestigador.php", "IdInvestigador");
                            //$tblInvestigadores->MensajeConfirmacionEliminacion("¿Realmente desea eliminar el investigador?");

                            $tblInvestigadores->DataSource($investigadores);
                            $tblInvestigadores->Bind();
                        }
                        else{
                            
                            echo "<h2 align=\"center\">No hay investigadores registrados.</h2>";
                        }
                    ?>
                </form>
            </div>
            <!-- End Content -->
        </div>
        <!-- End one column window -->
</div>
<?php
    include_once(PATH_TPT . "Footer.php");
?>