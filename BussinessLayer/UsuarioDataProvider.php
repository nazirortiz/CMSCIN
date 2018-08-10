<?php
/**
 * Proveedor de datos de usuario.
 *
 * @author NAZIR
 */

include_once(PATH_DL . "DBConnection.php");
include_once (PATH_DL . "/Usuario.php");

class UsuarioDataProvider {

    public function _constructor(){

    }

    public static function ObtenerUsuarios(){

    }

    public static function ObtenerUsuarioById($idUsuario){
        $query = "call ObtenerUsuarioById($idUsuario);";
        $result = DBConnection::GetInstance()->ExecuteQuery($query);
        $row = mysqli_fetch_array($result);
        return UsuarioDataProvider::ParseRowToUsuario($row);
    }

    public static function ObtenerUsuarioByUserName($nombre_usuario){
        // TODO: Crear el sp ObtenerUsuarioByUserName
        $query = "call ObtenerUsuarioByUserName($nombre_usuario);";
        $result = DBConnection::GetInstance()->ExecuteQuery($query);
        $row = mysqli_fetch_array($result);
        return UsuarioDataProvider::ParseRowToUsuario($row);
    }

    public static function RegistrarUsuario($usuario){
        $query = "call RegistrarUsuario('$usuario->NombreUsuario', '$usuario->Password');";
        return DBConnection::GetInstance()->ExecuteNonQuery($query);
    }

    // Convierte una fila en un objeto tipo Usuario.
    public static function ParseRowToUsuario($row){
        $usuario = new Usuario();

        $usuario->IdUsuario = $row['idUsuario'];
        $usuario->Nombre = $row['Nombre'];
        $usuario->Password = $row['Password'];

        return $usuario;
    }
}
?>
