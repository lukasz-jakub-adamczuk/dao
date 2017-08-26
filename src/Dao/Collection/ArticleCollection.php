<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ArticleCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT article.*, article_category.name category, user.name author, COUNT(article_comment.id_article_comment) comments';
    }

    public function getJoinPart() {
        return 'LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category) LEFT JOIN user ON(user.id_user=article.id_author) LEFT JOIN article_comment ON(article_comment.id_article=article.id_article)';
    }

    public function getArticles() {
        $sql = 'SELECT a.id_article, a.title name, a.idx
                FROM article a
                ORDER BY idx, title';
        $this->query($sql);
        return $this->getRows();
    }

    public function getArticlesCategories() {
    	$sql = 'SELECT id_article_category, COUNT( id_article ) total
                FROM  `article` 
                GROUP BY id_article_category';
    	return $this->_db->getArray($sql, 'id_article_category');
    }

    public function getArticlesCategoriesVerified() {
    	$sql = 'SELECT id_article_category, COUNT( id_article ) good
                FROM  `article` 
                WHERE verified = 1
                GROUP BY id_article_category';
    	return $this->_db->getArray($sql, 'id_article_category');
    }

    public function getArticlesForCategory($category) {
        $sql = 'SELECT a.*, c.name category_name, c.slug category_slug
                FROM article a 
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category) 
                WHERE c.slug="'.$category.'" 
                ORDER BY a.creation_date DESC';
        $this->query($sql);
        return $this->getRows();
    }

    public function getArticlesByTitle($title, $bNegate = false) {
        $condition = $bNegate ? 'title NOT LIKE "'.$title.'%"' : 'title LIKE "'.$title.'%"';
        $sql = 'SELECT a.id_article, a.title, c.name category
                FROM article a
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category)
                WHERE '.$condition.'
                ORDER BY category, title';
        $this->query($sql);
        return $this->getRows();
    }

    public function getArticlesByCategory($category) {
        $condition = is_numeric($category) ? 'a.id_article_category = "'.$category.'"' : 'c.slug="'.$category.'"';
        $sql = 'SELECT a.*, c.slug category_slug
                FROM article a
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category) 
                WHERE '.$condition.'
                ORDER BY a.idx, a.title';
        $this->query($sql);
        return $this->getRows();
    }

    public function getArticlesByTemplate($idTemplate) {
        $sql = 'SELECT a.id_article, a.title name, a.idx
                FROM article
                WHERE id_article_category = "'.$idTemplate.'"
                ORDER BY idx, title';
        $this->query($sql);
        return $this->getRows();
    }

    public function getArticlesForStream($limit = 6) {
        $sql = 'SELECT a.id_article, a.title, a.slug, a.creation_date, a.visible, u.name user_name, c.slug category_slug, c.name category_name, COUNT(ac.id_article_comment) comments, f.fragment, f.id_fragment_type
                FROM article a
                LEFT JOIN user u ON(u.id_user=a.id_author)
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category)
                LEFT JOIN article_comment ac ON(ac.id_article=a.id_article)
                LEFT JOIN object_fragment of ON(of.id_object=a.id_article)
                LEFT JOIN fragment f ON(f.id_fragment=of.id_fragment)
                WHERE a.visible=1 and of.object="article" AND f.id_fragment_type=2
                GROUP BY a.id_article
                ORDER BY a.id_article DESC
                LIMIT 0,'.$limit;
        $this->query($sql);
        return $this->getRows();
    }

    public function howManyArticlesWroteUser($id) {
        $sql = 'SELECT COUNT(id_article) FROM article WHERE id_author="'.$id.'"';
        return $this->getOne($sql);
    }

}