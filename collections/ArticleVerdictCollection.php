<?php
require_once AYA_DIR.'/Dao/Collection.php';

class ArticleVerdictCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT article_verdict.*, article.title title, article_category.name category, user.name author';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=article_verdict.id_author) LEFT JOIN article ON(article.id_article=article_verdict.id_article) LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category)';
    }

}
