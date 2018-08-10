<?php
/**
 * Tipos de mensajes para la interfaz de usuario.
 *
 * @author NAZIR
 */
class Messages {
    public static function Error($message){
        echo str_replace("@MESSAGE", $message, file_get_contents(PATH_TPT . "MessagesError.php"));
    }

    public static function Warning($message){
        echo str_replace("@MESSAGE", $message, file_get_contents(PATH_TPT . "MessagesWarning.php"));
    }

    public static function Info($message){
        echo str_replace("@MESSAGE", $message, file_get_contents(PATH_TPT . "MessagesInfo.php"));
    }

    public static function Success($message){
        echo str_replace("@MESSAGE", $message, file_get_contents(PATH_TPT . "MessagesSuccess.php"));
    }
}
?>
