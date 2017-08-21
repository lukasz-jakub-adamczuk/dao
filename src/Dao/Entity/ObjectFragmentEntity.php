<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class ObjectFragmentEntity extends Entity {
    
    public function getImageFragment($sObjectType, $sObjectId, $sFragmentTypeId) {
        $this->query('SELECT of.id_object_fragment, f.* FROM object_fragment of LEFT JOIN fragment f ON(f.id_fragment=of.id_fragment) WHERE object = "'.$sObjectType.'" AND id_object = '.$sObjectId.' AND id_fragment_type = '.$sFragmentTypeId.'');
        $this->load();
        return $this->getFields();
    }
}