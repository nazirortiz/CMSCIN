<?php
    include_once("../../Config/Config.php");
    include_once(PATH_TPT . "Header.php");
    include_once(PATH_TPT . "LeftPanelInvestigador.php");
?>
 <!-- Begin content -->
<?php
    include_once(PATH_BL . "InvestigadorDataProvider.php");
    session_start();
    $investigador = $_SESSION["usuario"]
?>
<div id="content">
    <div class="inner">
        <!-- Begin one column window -->
        <div class="onecolumn">
            <div class="header">
                <span>Ultimos articulos publicados</span>
            </div>
            <br class="clear"/>
            <div class="content">
                <form id="form_data" name="form_data" action="" method="post">
                    <?php
                        echo "<h2 align=\"center\">Sin articulos</h2>";
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
