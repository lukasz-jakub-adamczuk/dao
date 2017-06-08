<?php
require_once AYA_DIR.'/Dao/Collection.php';

class ArticleCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT article.*, article_category.name category, user.name author, COUNT(article_comment.id_article_comment) comments';
    }

    public function getJoinPart() {
        return 'LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category) LEFT JOIN user ON(user.id_user=article.id_author) LEFT JOIN article_comment ON(article_comment.id_article=article.id_article)';
    }

    public function getArticles() {
        $this->query('SELECT article.id_article, article.title name, article.idx FROM article ORDER BY idx, title');
        $this->load(-1);
        return $this->getRows();
    }

    public function getArticlesByTitle($sTitle, $bNegate = false) {
        $sCondition = $bNegate ? 'title NOT LIKE "'.$sTitle.'%"' : 'title LIKE "'.$sTitle.'%"';
        $this->query('SELECT article.id_article, article.title, article_category.name category FROM article LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category) WHERE '.$sCondition.' ORDER BY category, title');
        $this->load(-1);
        return $this->getRows();
    }

    public function getArticlesByCategory($sIdCategory) {
        $this->query('SELECT article.id_article, article.title name, article.idx FROM article WHERE id_article_category = "'.$sIdCategory.'" ORDER BY idx, title');
        $this->load(-1);
        return $this->getRows();
    }

    public function getArticlesByTemplate($sIdTemplate) {
        $this->query('SELECT article.id_article, article.title name, article.idx FROM article WHERE id_article_category = "'.$sIdCategory.'" ORDER BY idx, title');
        $this->load(-1);
        return $this->getRows();
    }

    public function getArticlesForStream($limit = 6) {
        // $sql = 'SELECT a.id_article, a.title, a.slug, a.creation_date, a.visible, u.name user_name, c.slug category_slug, c.name category_name, COUNT(ac.id_article_comment) comments, f.fragment, f.id_fragment_type
        $sql = 'SELECT a.id_article, a.title, a.slug, a.creation_date, a.visible, u.name user_name, c.slug category_slug, c.name category_name, COUNT(ac.id_article_comment) comments, f.fragment, f.id_fragment_type
                FROM article a
                LEFT JOIN user u ON(u.id_user=a.id_author)
                LEFT JOIN article_category c ON(c.id_article_category=a.id_article_category)
                LEFT JOIN article_comment ac ON(ac.id_article=a.id_article)
                LEFT JOIN object_fragment of ON(of.id_object=a.id_article)
                LEFT JOIN fragment f ON(f.id_fragment=of.id_fragment)
                WHERE a.visible=1 and of.object="article" AND f.id_fragment_type=2
                GROUP BY a.id_article
                -- GROUP BY a.id_article, a.title, a.slug, a.creation_date, a.visible, user_name, category_slug, category_name, f.fragment, f.id_fragment_type
                ORDER BY a.id_article DESC
                LIMIT 0,'.$limit;
        $this->query($sql);
        return $this->getRows();
    }

}