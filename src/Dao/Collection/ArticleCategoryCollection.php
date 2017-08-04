<?php
require_once AYA_DIR.'/Dao/Collection.php';

class ArticleCategoryCollection extends Collection {
    
    public function getCategories() {
        $this->query('SELECT article_category.id_article_category, article_category.name, article_category.slug, article_category.abbr, article_category.idx FROM article_category ORDER BY idx, name');
        $this->load(-1);
        return $this->getRows();
        // return $this->getColumn();
    }

    public function getArticleCategories() {
        $sql = 'SELECT c.*, c.id_article_category, f.fragment
                -- FROM article a 
                FROM article_category c
                -- LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category)
                
                LEFT OUTER JOIN object_fragment of ON(of.id_object=c.id_article_category)
                LEFT JOIN fragment f ON(f.id_fragment=of.id_fragment)
                
                -- WHERE f.id_fragment_type = 2 AND f.id_object = a.id_article AND f.id_object = "article" AND a.slug = "recenzja"
                -- WHERE f.id_fragment_type = 2 AND of.object = "article_category"
                -- WHERE of.object = "article_category"
                WHERE c.visible = 1
                -- GROUP BY a.id_article_category
                ORDER BY c.idx';
        $this->query($sql);
        return $this->getRows();
    }
}