<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class CupPlayerEntity extends Entity {
    
    public function getCupPlayerByOldUrl($id) {
        $sql = 'SELECT cp.*, c.name category_name, c.slug category_slug
                FROM cup_player cp
                LEFT JOIN cup c ON (c.id_cup=cp.id_cup)
                WHERE cp.id_cup_player="'.$id.'"';
        $this->query($sql);
        return $this->getFields();
    }

    public function getCupPlayer($categorySlug, $nameSlug) {
        $sql = 'SELECT cp.*
                FROM cup_player cp
                LEFT JOIN cup c ON (c.id_cup=cp.id_cup)
                WHERE c.slug="'.$categorySlug.'" AND cp.slug="'.$nameSlug.'"';
        $this->query($sql);
        return $this->getFields();
    }
}