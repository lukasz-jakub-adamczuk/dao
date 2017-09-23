<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ArticleCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT article_comment.*, u.name author, a.title object_name, a.slug object_slug, c.name category_name, c.slug category_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user u ON(u.id_user=article_comment.id_author)
                LEFT JOIN article a ON(a.id_article=article_comment.id_article)
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category)';
    }
}