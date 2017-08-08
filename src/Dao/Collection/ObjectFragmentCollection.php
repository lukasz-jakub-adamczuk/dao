<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ObjectFragmentCollection extends Collection {
    
    public function getFragmentRelations($mId) {
        $this->query('SELECT of.* FROM object_fragment of WHERE of.id_fragment = "'.$mId.'"');
        $this->load(-1);
        return $this->getRows();
    }
}