<?php
/**
 * Description of config.php
 * Archivo con la configuración del sistema
 *
 * @author: Nazir Ortiz
 * @email:  naz.hack@gmail.com
 * @fecha:  17/mar/2011
 */

/* Datos para la conexión con la base de datos. */
define('SERVER', "localhost");
define('PORT', 3306);
define('DATABASE', "crmcin");
define('USER', "root");
define('PASSWORD', "");

/* Datos de la aplicación */
define('TITULO_APLICACION', "Administrador de investigadores");

/* Rutas del proyecto */

// Servidor
define('PATH_HOME', $_SERVER['DOCUMENT_ROOT']);
// Aplicacion
define('PATH_APP', PATH_HOME . "crmcin/");
// Configuracion
define('PATH_CONF', PATH_APP . "Config/");
// Logica de negocio
define('PATH_BL', PATH_APP . "BusinessLayer/");
// Acceso a datos
define('PATH_DL', PATH_APP . "DataAccessLayer/");
// PHP ActiveRecord
define('PATH_ACTIVERECORD', PATH_DL . "php-activerecord/");
// Interfaz grafica
define('PATH_UI', PATH_APP . "UI/");
// Templates
define('PATH_TPT', PATH_UI . "Templates/");
// Library
define('PATH_LIB', PATH_UI . "Library/");
// User Controls
define('PATH_UC', PATH_UI . "UserControl/");

/* 
 * Configuración de PHP ActiveRecord 
 */

require_once(PATH_ACTIVERECORD . "ActiveRecord.php");

ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('../../DataAccessLayer/models/');
    $cfg->set_connections(array('development' => 'mysql://' . USER . ':' . PASSWORD . '@' . SERVER . '/CRMCIN'));
});

?>