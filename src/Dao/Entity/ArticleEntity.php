<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class ArticleEntity extends Entity {
    
    public function getArticle($articleSlug, $categorySlug) {
        $sql = 'SELECT a.*, c.name category_name, c.slug category_slug, u.slug author_slug, u.name author_name 
                FROM article a 
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category) 
                LEFT JOIN user u ON(u.id_user=a.id_author) 
                WHERE a.slug="'.$articleSlug.'" AND c.slug="'.$categorySlug.'" ';
        $this->query($sql);
        return $this->getFields();
    }

    public function getArticleByOldUrl($url) {
        $sql = 'SELECT a.*, c.name category_name, c.slug category_slug, u.slug author_slug, u.name author_name 
                FROM article a 
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category) 
                LEFT JOIN user u ON(u.id_user=a.id_author) 
                WHERE a.old_url="'.$url.'" ';
        $this->query($sql);
        return $this->getFields();
    }
}