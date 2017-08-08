<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class NewsCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT news_comment.*, user.name author, news.title object_name, news.slug object_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=news_comment.id_author) LEFT JOIN news ON(news.id_news=news_comment.id_news)';
    }

    public function getCommentsById($mId) {
        $sql = 'SELECT nc.*, u.name author_name 
                FROM news_comment nc 
                LEFT JOIN user u ON(u.id_user=nc.id_author) 
                WHERE nc.id_news='.$mId.'';
        $this->query($sql);
        return $this->getRows();
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