<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class CommentsCollection extends Collection {
    
    public function getAllComments($mVisible = null) {
        $sql = 'SELECT COUNT(id_news_comment)
                FROM news_comment';

        if (!is_null($mVisible)) {
            $sql .= ' WHERE visible='.(int)$mVisible.'';
        }
        // $this->query($sql);
        return $this->getOne($sql);
    }

    public function getUnauthorizedComments($sType) {
        $sql = 'SELECT COUNT(id_'.$sType.'_comment)
                FROM '.$sType.'_comment
                WHERE visible=0';

        return $this->getOne($sql);
    }

    public function getCommentsById($sType, $id) {
        // table name and primary key in such collection are various
        $this->_mId = 'id_'.$sType.'_comment';
        $this->_sTable = $sType.'_comment';
        // query
        $sql = 'SELECT c.*, u.id_user id_author, u.name author_name, u.slug author_slug 
                FROM '.$sType.'_comment c 
                LEFT JOIN user u ON(u.id_user=c.id_author) 
                WHERE c.id_'.$sType.'='.$id.' AND c.visible=1';
        $this->query($sql);
        return $this->getRows();
    }
}