<?php
require_once AYA_DIR.'/Dao/Collection.php';

class ArticleCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT article_comment.*, user.name author, article.title object_name, article.slug object_slug, article_category.name category_name, article_category.slug category_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=article_comment.id_author) LEFT JOIN article ON(article.id_article=article_comment.id_article) LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category)';
    }

    public function getCommentsById($mId) {
        $sql = 'SELECT ac.*, u.name author_name 
                FROM article_comment ac 
                LEFT JOIN user u ON(u.id_user=ac.id_author) 
                WHERE ac.id_article='.$mId.'';
        $this->query($sql);
        return $this->getRows();
    }
}