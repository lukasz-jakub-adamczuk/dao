<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class UserCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT user_comment.*, user.name author, uu.name object_name, uu.slug object_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=user_comment.id_author) LEFT JOIN user uu ON(user.id_user=user_comment.id_user)';
    }

    public function getCommentsById($id) {
        $sql = 'SELECT uc.*, u.name author_name 
                FROM user_comment uc 
                LEFT JOIN user u ON(u.id_user=uc.id_author) 
                WHERE uc.id_user='.$id.' AND uc.visible=1';
        $this->query($sql);
        return $this->getRows();
    }

    public function howManyCommentsWroteUser($id) {
        $sql = 'SELECT COUNT(id_user_comment) FROM user_comment WHERE id_author="'.$id.'"';
        return $this->getOne($sql);
    }
}