<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class UserEntity extends Entity {
    
    public function getUser($userSlug) {
        $sql = 'SELECT u.*, u.slug
                FROM user u 
                WHERE u.slug="'.$userSlug.'" ';
        $this->query($sql);
        // $this->load();
        return $this->getFields();
    }

    public function getUserById($id) {
        $sql = 'SELECT u.*, u.slug
                FROM user u 
                WHERE u.id_user="'.$id.'" ';
        $this->query($sql);
        return $this->getFields();
    }

    public function getAuthenticatedUser($id) {
        $cond = 'WHERE u.id_user="'.$id.'"';
        return $this->_getAuthenticatedUserDetails($cond);
    }

    public function authenticateUser($username, $password) {
        $cond = 'WHERE u.name="'.addslashes($username).'" 
                AND u.hash="'.sha1(addslashes(strtolower($username)).addslashes($password)).'"';
        return $this->_getAuthenticatedUserDetails($cond);
    }

    private function _getAuthenticatedUserDetails($cond) {
        $sql = 'SELECT u.*, ug.slug group_slug, ug.name group_name, up.*
                FROM user u
                LEFT JOIN user_group ug ON(ug.id_user_group=u.id_user_group)
                LEFT JOIN user_permission up ON(up.id_user=u.id_user)
                '.$cond.'';
        $this->query($sql);
        return $this->getFields();
    }
}