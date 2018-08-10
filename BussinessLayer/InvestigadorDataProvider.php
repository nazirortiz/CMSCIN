<?php
/**
 * ArticulosDataProvider.php
 *
 * Proveedor de datos para Investigador.
 *
 * @author Nazir Ortiz
 *
 */

include_once (PATH_DL . "DBConnection.php");
include_once (PATH_DL . "Investigador.php");
include_once (PATH_BL . "UsuarioDataProvider.php");

class InvestigadorDataProvider {

    /*
     *  Devuelve todos los Investigadores registrados.
     */
    public static function ObtenerInvestigadores(){
        $result = DBConnection::GetInstance()->ExecuteQuery("call ObtenerInvestigadores();");

        $investigadores = array();
        
        while ($row = mysqli_fetch_array($result)){
            $investigador = InvestigadorDataProvider::ParseRowToInvestigador($row);
            $investigador->Usuario = UsuarioDataProvider::ObtenerUsuarioById($investigador->IdUsuario);
            $investigador->NombreUsuario = $investigador->Usuario->Nombre;
            $investigador->RutaUsuario = InvestigadorDataProvider::ObtenerRutaInvestigador($investigador);
            array_push($investigadores, $investigador);
        }

        return $investigadores;
    }

    /*
     * Obtiene un investigador por id.
     */
    public static function ObtenerInvestigadorById($idInvestigador){
        $result = DBConnection::GetInstance()->ExecuteQuery("call ObtenerInvestigadorById($idInvestigador);");
        $row = mysqli_fetch_array($result);
        $investigador = InvestigadorDataProvider::ParseRowToInvestigador($row);
        $investigador->Usuario = UsuarioDataProvider::ObtenerUsuarioById($investigador->IdUsuario);
        $investigador->NombreUsuario = $investigador->Usuario->Nombre;
        $investigador->RutaUsuario = InvestigadorDataProvider::ObtenerRutaInvestigador($investigador);
        return $investigador;
    }

    public static function ObtenerInvestigadorByUserName($nombre_usuario){
        $result = DBConnection::GetInstance()->ExecuteQuery("call ObtenerInvestigadorByUserName($nombre_usuario);");
        $row = mysqli_fetch_array($result);
        $investigador = InvestigadorDataProvider::ParseRowToInvestigador($row);
        $investigador->Usuario = UsuarioDataProvider::ObtenerUsuarioById($investigador->IdUsuario);
        $investigador->NombreUsuario = $investigador->Usuario->Nombre;
        $investigador->RutaUsuario = InvestigadorDataProvider::ObtenerRutaInvestigador($investigador);
        return $investigador;
    }

    /*
     *  Guarda un investigador en la base de datos.
     */
    public static function RegistrarInvestigador($investigador, $usuario){
        $query = "call RegistrarInvestigador('$investigador->Nombres', '$investigador->ApellidoPaterno', '$investigador->ApellidoMaterno', '$investigador->Direccion', '$investigador->FechaNacimiento', '$investigador->Sexo', '$investigador->Estado', '$investigador->Nacionalidad', '$usuario->Nombre', '$usuario->Password');";
        DBConnection::GetInstance()->ExecuteNonQuery($query);
    }

    /*
     * Actualiza un investigador.
     */
    public static function ActualizarInvestigador($investigador){                                                                                                          
        $query = "call ActualizarInvestigador($investigador->IdInvestigador, '$investigador->Nombres', '$investigador->ApellidoPaterno', '$investigador->ApellidoMaterno', ' " . $investigador->Usuario->Password . "');";
        DBConnection::GetInstance()->ExecuteNonQuery($query);
    }

    /*
     * Elimina logicamente el investigador, no lo elimina fisicamente.
     */
    public static function EliminarInvestigador($idinvestigador){
        $query = "call EliminarInvestigador($idinvestigador);";
        DBConnection::GetInstance()->ExecuteNonQuery($query);
    }

    /*
     * Retorna la ruta para la pagina de cada investigador.
     */
    public static function ObtenerRutaInvestigador($investigador){
        return "../Investigador/index.php?usuario=" . $investigador->NombreUsuario;
    }

    /*
     *  Convierte una fila en un objeto tipo Investigdor.
     */
    public static function ParseRowToInvestigador($row){
        $investigador = new Investigador();

        $investigador->IdInvestigador = $row['idInvestigador'];
        $investigador->IdUsuario = $row['idUsuario'];
        $investigador->Nombres = $row['Nombres'];
        $investigador->ApellidoPaterno = $row['ApellidoPaterno'];
        $investigador->ApellidoMaterno = $row['ApellidoMaterno'];
        $investigador->Direccion = $row['Direccion'];
        $investigador->FechaNacimiento = $row['FechaNacimiento'];
        $investigador->Sexo = $row['Sexo'];
        $investigador->Estado = $row['Estado'];
        $investigador->Nacionalidad = $row['Nacionalidad'];

        return $investigador;
    }
}
?>
