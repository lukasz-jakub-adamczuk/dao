<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ArticleVerdictCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT article_verdict.*, article.title title, article_category.name category, user.name author';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=article_verdict.id_author) LEFT JOIN article ON(article.id_article=article_verdict.id_article) LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category)';
    }

    public function getVerdicts($id) {
        $sql = 'SELECT av.*, u.name author_name, u.slug author_slug
                FROM article_verdict av 
                LEFT JOIN user u ON(u.id_user=av.id_author) 
                WHERE av.id_article='.$id.' AND av.visible=1';
        $this->query($sql);
        return $this->getRows();
    }

    public function mostActiveAuthors() {
        $sql = 'SELECT av.id_article_verdict, COUNT(av.id_article_verdict) total, u.id_user, u.name, u.slug 
                FROM article_verdict av
                LEFT JOIN user u ON(u.id_user=av.id_author) 
                WHERE av.id_author <> 0 AND av.id_article_verdict <> 0 
                GROUP BY av.id_author 
                ORDER BY total DESC 
                LIMIT 0, 10';
        $this->query($sql);
        return $this->getRows();
    }
}
