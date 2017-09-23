<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class NewsCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT news_comment.*, u.name author, n.title object_name, n.slug object_slug, REPLACE(DATE(n.creation_date), "-", "/") newsdate';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user u ON(u.id_user=news_comment.id_author)
                LEFT JOIN news n ON(n.id_news=news_comment.id_news)';
    }

    public function getComments($mVisible = null) {
        $sql = 'SELECT COUNT(id_news_comment)
                FROM news_comment';

        if (!is_null($mVisible)) {
            $sql .= ' WHERE visible='.(int)$mVisible.'';
        }
        // $this->query($sql);
        return $this->getOne($sql);
    }
}