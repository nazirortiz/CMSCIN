<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HyperLinkColumn
 *
 * @author NAZIR
 */

include_once(PATH_UC . "Column.php");

class HyperLinkColumn extends Column {
    private $link;
    
    public function  __construct($datafield, $headertext, $link) {
        parent::__construct($datafield, $headertext);
        $this->link = $link;
    }

    public function HyperLink(){
        return $this->link;
    }
}
?>
