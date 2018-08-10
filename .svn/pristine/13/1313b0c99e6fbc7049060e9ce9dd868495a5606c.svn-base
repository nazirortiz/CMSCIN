<?php
    include_once("../../Config/Config.php");
    include_once(PATH_BL . "InvestigadorDataProvider.php");

    if (isset($_REQUEST['id'])){
        $idinvestigador = $_REQUEST['id'];
    }
    
    InvestigadorDataProvider::EliminarInvestigador($idinvestigador);
    
    echo "Investigador eliminado correctamente.";
?>