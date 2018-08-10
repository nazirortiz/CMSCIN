<?php
/**
 * Clase encargada de registrar en un archivo los mensajes de error,
 * advertencia entre otros de la aplicación.
 *
 * @author NAZIR
 */

include_once(PATH_CONF . "MessageLogger.php");

class Logger {
    
    public function  __construct() {
    }

    /*
     * $mensaje_personal = Mensaje personalizado
     * $mensaje_sistema = Mensaje arrojado por el sistema.
     * $tipo_mensaje = Error o Advertencia
     */
    public static function RegistrarMensaje($mensaje_personal, $mensaje_sistema, $tipo_mensaje){
        $archivo = fopen(PATH_CONF . "Logger.txt", "a");
        $fecha = date("d-m-Y");
        $hora = date("H:i:s");
        fwrite($archivo, "\nFecha: $fecha, Hora: $hora, \nTipo: $tipo_mensaje \nMensaje Personal: $mensaje_personal \nMensaje Sistema: $mensaje_sistema");
        fwrite($archivo, "\n# -----------------------------------------------------------------------------");
        fclose($archivo);
    }
}
?>
