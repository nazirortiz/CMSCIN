<?php
/**
 * Control de usuario que renderea una tabla que recibe una lista de objetos.
 *
 * @author NAZIR
 */
include_once(PATH_UC . "HyperLinkColumn.php");
include_once(PATH_UC . "TextColumn.php");

class UCTable {   

    private $table_name = "table1";
    private $mensajeConfirmacionEliminacion;
    private $enabledActionColumn = false;
    private $urlModification = "#";
    private $urlElimination = "#";
    private $fieldReturnedModification;
    private $fieldReturnedElimination;
    private $columns = array();
    private $objects;

    public function  __construct() {
        
    }

    public static function Modificacion(){
        return "Modificacion";
    }

    public static function Eliminar(){
        return "Eliminar";
    }

    public function TableName($table_name){
        $this->table_name = $table_name;
    }

    public function MensajeConfirmacionEliminacion($mensaje){
        $this->mensajeConfirmacionEliminacion = $mensaje;
    }

    /*
     * Agrega una columna a la tabla
     * $field_title = Nombre de la columna, este nombre se mostrara en el titulo
     *                de la columna.
     * $field_key = Nombre del atributo en el objeto.
     */
    /*public function AddColumn($field_title, $field_key, $link = ""){
        $this->columns[$field_key] = $field_title;
    }*/

    /*
     * Agrega una columna a la tabla
     * $column = Objecto tipo columna
     */
    public function AddColumn($column){
        $this->columns[] = $column;
    }

    /*
     * Indica que pagina mostrara los campos para realizar la modificacion.
     * $url = Nombre de la pagina web.
     * $id_returned = campos que contiene el id que se anexara a la url.
     */
    public function PageModification($url, $field_returned){
        $this->urlModification = $url;
        $this->fieldReturnedModification = $field_returned;
    }

    /*
    * Indica que pagina mostrara los campos para realizar la modificacion.
    * $url = Nombre de la pagina web.
    * $id_returned = campos que contiene el id que se anexara a la url.
    */
    public function PageElimination($url, $field_returned){
        $this->urlElimination = $url;
        $this->fieldReturnedElimination = $field_returned;
    }

    /*
     * Indica si la tabla va a tener la columna para modificar y eliminar
     * las filas.
     */
    public function EnabledActionColumn($condition){
        $this->enabledActionColumn = $condition;
    }

    /*
     * Agrega la lista/arreglos de objectos que llenaran la tabla.
     * $objects = Lista de objectos.
     */
    public function DataSource($objects){
        $this->objects = $objects;
    }

    /*
     * Contruye la cebecera de la tabla.
     */
    private function BuildTableHeader(){
        echo "<thead>";
        echo "<tr>";

        $porcentaje_columna = 0;

        if ($this->enabledActionColumn){
            $porcentaje_columna = 100 / (count($this->columns) + 1);
        }
        else{
            $porcentaje_columna = 100 / count($this->columns);
        }

        $porcentaje_columna = number_format($porcentaje_columna);

        foreach($this->columns as $c){
            echo "<th style=\"width:" . $porcentaje_columna . "%\">" . $c->HeaderText() . "</th>";
        }

        if ($this->enabledActionColumn){
            echo "<th style=\"width:". $porcentaje_columna . "%\">Acciones</th>";
        }

        echo "</tr>";
        echo "</thead>";
    }

    /*
    * Contruye el cuerpo de la tabla.
    */
    private function BuildTableBody(){
        echo "<tbody>";
        foreach($this->objects as $i){
            echo "<tr>";
            
            foreach($this->columns as $c){
                 $this->BuildTableCell($i, $c);
            }
            
            if ($this->enabledActionColumn){
                echo "<td>";
                $this->BuildActionLink($this->urlModification, $i->{$this->fieldReturnedModification}, UCTable::Modificacion());
                echo "&nbsp;&nbsp;";
                $this->BuildActionLink($this->urlElimination, $i->{$this->fieldReturnedElimination}, UCTable::Eliminar());
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
    }

    private function BuildTableCell($objeto, $columna){
        
        $datafield = $objeto->{$columna->DataField()};

        if (empty($datafield)){
            echo "-";
        }
        else{
            if ($columna instanceof HyperLinkColumn){
                echo "<td><a href=\"" . $objeto->{$columna->HyperLink()} . "\">" . $objeto->{$columna->DataField()} . "</a></td>";
            }
            elseif($columna instanceof TextColumn){
                echo "<td>" . $objeto->{$columna->DataField()} . "</td>";
            }
        }
    }

    /*
     * Contruye la columna de accion, Modificar y Eliminar.
     * $url = Url de la pagina que se llamara para mostrar los campos de la
     *        modificacion.
     * $id = id que se anexara a la url.
     */
    private function BuildActionLink($url, $id, $tipoAccion){
        switch ($tipoAccion){
            case UCTable::Modificacion():
                echo "<a href=\"" . $url . "?id=" . $id . "\">";
                echo "<img src=\"../Resources/Images/icon_edit.png\" alt=\"Modificar\" class=\"help\" title=\"Modificar\"/>";
                break;
            case UCTable::Eliminar():
                echo "<a onClick=\"eliminar_$this->table_name($id);\">";
                echo "<img src=\"../Resources/Images/icon_delete.png\" alt=\"Eliminar\" class=\"help\" title=\"Eliminar\"/>";
                break;
        }
        echo "</a>";
    }

    private function AddPagination(){
        echo "<div id=\"controls\">";
        echo "<div id=\"perpage\">";
        echo "<select onchange=\"sorter.size(this.value)\">";
        echo "<option value=\"5\">5</option>";
        echo "<option value=\"10\" selected=\"selected\">10</option>";
        echo "<option value=\"15\">15</option>";
        echo "<option value=\"20\">20</option>";
        echo "<option value=\"25\">25</option>";
        echo "</select>";
        echo "<span>&nbsp; Registros por página</span>";
        echo "</div>";
        echo "<div id=\"navigation\">";
        echo "<img src=\"../Resources/Images/first.gif\" width=\"16\" height=\"16\" alt=\"First Page\" onclick=\"sorter.move(-1,true)\" />";
        echo "<img src=\"../Resources/Images/previous.gif\" width=\"16\" height=\"16\" alt=\"First Page\" onclick=\"sorter.move(-1)\" />";
        echo "<img src=\"../Resources/Images/next.gif\" width=\"16\" height=\"16\" alt=\"First Page\" onclick=\"sorter.move(1)\" />";
        echo "<img src=\"../Resources/Images/last.gif\" width=\"16\" height=\"16\" alt=\"Last Page\" onclick=\"sorter.move(1,true)\" />";
        echo "</div>";
        echo "<div id=\"text\">";
        echo "<span id=\"currentpage\"></span> de <span id=\"pagelimit\"></span>";
        echo "</div>";
        echo "</div>";
        echo "<br><br>";
    }

    /*
     * Agrega el script que se encarga de paginar y ordenar las columnas asc
     * y desc.
     */
    private function AddSortTableJS(){
        echo "<script type=\"text/javascript\" src=\"../Resources/JS/SortTable/SortTable.js\"></script>";
	echo "<script type=\"text/javascript\">";
        echo "var sorter = new TINY.table.sorter(\"sorter\");" . "\n";
	echo "sorter.head = \"head\";" . "\n";
	echo "sorter.asc = \"asc\";" . "\n";
	echo "sorter.desc = \"desc\";" . "\n";
	echo "sorter.even = \"evenrow\";" . "\n";
	echo "sorter.odd = \"oddrow\";" . "\n";
	echo "sorter.evensel = \"evenselected\";" . "\n";
	echo "sorter.oddsel = \"oddselected\";" . "\n";
	echo "sorter.paginate = true;" . "\n";
	echo "sorter.currentid = \"currentpage\";" . "\n";
	echo "sorter.limitid = \"pagelimit\";" . "\n";
	echo "sorter.init(\"$this->table_name\",1);" . "\n";
        echo "</script>";
    }

    /*
     * Agrega la funcion javascript que confirma la eliminación.
     */
    private function AddFunctionEliminationJS(){
        echo "<script type=\"text/javascript\">\n";
        echo "function eliminar_$this->table_name(id_fila){\n";
        echo "if(confirm(\"$this->mensajeConfirmacionEliminacion\")){\n";
        echo "$.ajax({";
        echo "url: '$this->urlElimination',";
        echo "type: \"GET\",";
        echo "data: \"id=\" + id_fila,";
        echo "success: function(datos){";
        echo "alert(datos);";
        echo "window.location.reload();";
        echo "}";
        echo "});";
        echo "}";
        echo "return false;";
        echo "}";
        echo "</script>";
    }

    /*
    * Metodo que renderea la tabla.
    */
    public function Bind(){
        $this->AddFunctionEliminationJS();
        
        echo "<table id=\"" . $this->table_name . "\" name=\"table\" class=\"data\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">";
        $this->BuildTableHeader();
        $this->BuildTableBody();
        echo "</table>";
        echo "<br>";
        
        if (count($this->objects) > 5){
            $this->AddPagination();
        }

        $this->AddSortTableJS();
    }
}
?>
