<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class UserCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT user_comment.*, u.name author, uu.name object_name, uu.slug object_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user u ON(u.id_user=user_comment.id_author)
                LEFT JOIN user uu ON(uu.id_user=user_comment.id_user)';
    }
}