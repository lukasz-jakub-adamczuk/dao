<?php
require_once AYA_DIR.'/Dao/Collection.php';

class GalleryCollection extends Collection {

    // public function getSelectPart() {
    // 	return 'SELECT article.*, article_category.name category, user.name author, COUNT(article_comment.id_article_comment) comments';
    // }

    // public function getJoinPart() {
    // 	return 'LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category) LEFT JOIN user ON(user.id_user=article.id_author) LEFT JOIN article_comment ON(article_comment.id_article=article.id_article)';
    // }

    // public function getArticles() {
    // 	$this->query('SELECT article.id_article, article.title name, article.idx FROM article ORDER BY idx, title');
    // 	$this->load(-1);
    // 	return $this->getRows();
    // }

    // public function getArticlesByTitle($sTitle, $bNegate = false) {
    // 	$sCondition = $bNegate ? 'title NOT LIKE "'.$sTitle.'%"' : 'title LIKE "'.$sTitle.'%"';
    // 	$this->query('SELECT article.id_article, article.title, article_category.name category FROM article LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category) WHERE '.$sCondition.' ORDER BY category, title');
    // 	$this->load(-1);
    // 	return $this->getRows();
    // }

    // public function getArticlesByCategory($sIdCategory) {
    // 	$this->query('SELECT article.id_article, article.title name, article.idx FROM article WHERE id_article_category = "'.$sIdCategory.'" ORDER BY idx, title');
    // 	$this->load(-1);
    // 	return $this->getRows();
    // }

    // public function getArticlesByTemplate($sIdTemplate) {
    // 	$this->query('SELECT article.id_article, article.title name, article.idx FROM article WHERE id_article_category = "'.$sIdCategory.'" ORDER BY idx, title');
    // 	$this->load(-1);
    // 	return $this->getRows();
    // }

    public function getGalleryImagesById($sId) {
        $sql = 'SELECT gi.*
                FROM gallery_image gi 
                -- LEFT JOIN gallery g ON(g.id_gallery=gi.id_gallery) 
                -- LEFT JOIN gallery_category c ON(c.id_gallery_category=g.id_gallery_category) 
                -- LEFT JOIN user u ON(u.id_user=g.id_author) 
                WHERE gi.id_gallery="'.$sId.'" ';
        $this->query($sql);
        // echo $this->getQuery();
        // $this->load(-1);
        return $this->getRows('id_gallery_image');
    }

}