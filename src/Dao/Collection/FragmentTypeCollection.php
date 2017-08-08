<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class FragmentTypeCollection extends Collection {
    
    public function getFragmentTypes() {
        $this->query('SELECT fragment_type.id_fragment_type, fragment_type.name FROM fragment_type ORDER BY name');
        $this->load(-1);
        // return $this->getRows();
        return $this->getColumn();
    }
}