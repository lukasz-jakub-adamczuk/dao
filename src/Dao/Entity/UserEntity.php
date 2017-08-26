<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class UserEntity extends Entity {
    
    public function getUser($userSlug) {
        $sql = 'SELECT u.*, u.slug
                FROM user u 
                WHERE u.slug="'.$userSlug.'" ';
        $this->query($sql);
        $this->load();
        return $this->getFields();
    }

    public function getUserById($id) {
        $sql = 'SELECT u.*, u.slug
                FROM user u 
                WHERE u.id_user="'.$id.'" ';
        $this->query($sql);
        return $this->getFields();
    }
}