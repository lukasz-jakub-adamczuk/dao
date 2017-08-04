<?php
require_once AYA_DIR.'/Dao/Collection.php';

class ObjectFragmentCollection extends Collection {
    
    public function getFragmentRelations($mId) {
        $this->query('SELECT of.* FROM object_fragment of WHERE of.id_fragment = "'.$mId.'"');
        $this->load(-1);
        return $this->getRows();
    }
}