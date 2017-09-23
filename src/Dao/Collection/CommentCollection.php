<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class CommentCollection extends Collection {
    
    public function getAllComments($mVisible = null) {
        $sql = 'SELECT COUNT(id_news_comment)
                FROM news_comment';

        if (!is_null($mVisible)) {
            $sql .= ' WHERE visible='.(int)$mVisible.'';
        }
        // $this->query($sql);
        return $this->getOne($sql);
    }

    public function getUnauthorizedComments($type) {
        $sql = 'SELECT COUNT(id_'.$type.'_comment)
                FROM '.$type.'_comment
                WHERE visible=0';

        return $this->getOne($sql);
    }

    public function getCommentsById($type, $id) {
        // table name and primary key in such collection are various
        $this->_mId = 'id_'.$type.'_comment';
        $this->_sTable = $type.'_comment';
        // query
        $sql = 'SELECT c.*, u.id_user id_author, u.name author_name, u.slug author_slug 
                FROM '.$type.'_comment c 
                LEFT JOIN user u ON(u.id_user=c.id_author) 
                WHERE c.id_'.$type.'='.$id.'';
        $this->query($sql);
        return $this->getRows();
    }

    public function howManyCommentsWroteUser($type, $id) {
        $sql = 'SELECT COUNT(id_'.$type.'_comment) FROM '.$type.'_comment WHERE id_author="'.$id.'"';
        return $this->getOne($sql);
    }
}