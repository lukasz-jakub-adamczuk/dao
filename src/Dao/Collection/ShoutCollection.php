<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ShoutCollection extends Collection {
    
    public function getRecentShouts() {
        $sql = 'SELECT s.*, u.name user_name, u.slug user_slug, u.avatar user_avatar
                FROM shout s
                LEFT JOIN user u ON(u.id_user=s.id_author) 
                GROUP BY s.id_shout 
                ORDER BY creation_date DESC 
                LIMIT 0, 30';
        $this->query($sql);
        return $this->getRows();
    }

    public function howManyShoutsWroteUser($id) {
        $sql = 'SELECT COUNT(id_shout) FROM shout WHERE id_author="'.$id.'"';
        return $this->getOne($sql);
    }
}