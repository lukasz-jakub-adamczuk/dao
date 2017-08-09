<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ObjectFragmentCollection extends Collection {
    
    public function getFragmentRelations($id) {
        $this->query('SELECT of.*
        FROM object_fragment of
        WHERE of.id_fragment = "'.$id.'"');
        $this->load(-1);
        return $this->getRows();
    }

    public function getFragments($id, $type) {
        $sql = 'SELECT of.*, f.*, ft.name type
                FROM object_fragment of 
                LEFT JOIN fragment f ON(f.id_fragment=of.id_fragment) 
                LEFT JOIN fragment_type ft ON(ft.id_fragment_type=f.id_fragment_type) 
                WHERE of.object="'.$type.'" AND of.id_object="'.$id.'" ';
        $this->query($sql);
        return $this->getRows();
    }
}