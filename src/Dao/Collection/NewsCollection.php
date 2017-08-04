<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class NewsCollection extends Collection {
    
    protected function _getCollection() {
        // $this->fields(array('offer_section.*', 'offer.title AS offer_title'));
        // $this->leftJoin('category');
        // $this->leftJoin('user');
        // $this->leftJoin('article_comment');
        // $this->load($this->_aNavigator['page']);

        // $this->selectPart('SELECT * ');
    }

    public function getSelectPart() {
        // return 'SELECT news.*, user.name author, COUNT(news_comment.id_news_comment) comments';
        return 'SELECT news.*, user.name author, COUNT(news_image.id_news_image) images';
        // return 'SELECT news.*, user.name author';
    }

    // public function getFromPart() {
    // 	return 'FROM article';
    // }

    public function getJoinPart() {
        // return 'LEFT JOIN user ON(user.id_user=news.id_author) LEFT JOIN news_comment ON(news_comment.id_news=news.id_news)';
        return 'LEFT JOIN user ON(user.id_user=news.id_author) LEFT JOIN news_image ON(news_image.id_news=news.id_news)';
        // return 'LEFT JOIN user ON(user.id_user=news.id_author)';
    }

    public function getNews() {
        $sql = 'SELECT n.*, COUNT(n.id_news) items, YEAR(n.creation_date) year 
                FROM news n 
                GROUP BY YEAR(n.creation_date) 
                ORDER BY n.id_news';
        $this->query($sql);
        return $this->getRows();
    }

    public function getNewsForStream($limit = 6) {
        // $sql = 'SELECT n.id_news, n.title, n.slug, n.creation_date, u.name user
        $sql = 'SELECT n.id_news, n.title, n.slug, n.creation_date, n.visible, u.name user, COUNT(nc.id_news_comment) comments		
                FROM news n
                LEFT JOIN user u ON(u.id_user=n.id_author)
                LEFT JOIN news_comment nc ON(nc.id_news=n.id_news)
                WHERE n.visible=1
                GROUP BY n.id_news
                ORDER BY n.id_news DESC
                LIMIT 0,'.$limit;
        $this->query($sql);
        // $this->load(-1);
        return $this->getRows();
    }

    public function getNewsForRssFeed($limit = 10) {
        $sql = 'SELECT n.id_news, n.title, n.slug, n.creation_date, n.markup, u.name
                FROM news n
                LEFT JOIN user u ON(u.id_user=n.id_author)
                WHERE n.visible=1
                GROUP BY n.id_news
                ORDER BY n.id_news DESC
                LIMIT 0,'.$limit;
        $this->query($sql);
        // $this->load(-1);
        return $this->getRows();
    }

    public function getNewsSiblings($iId, $limit = 10) {
        $sql = 'SELECT n.id_news, n.title, n.slug, n.creation_date, n.visible, MAX(n.id_news) recent
                FROM news n
                WHERE n.visible=1 AND n.id_news > '.($iId-round($limit/2)).' AND n.id_news < '.($iId+round($limit/2)).'
                GROUP BY n.id_news
                ORDER BY n.id_news DESC';
        $this->query($sql);
        // echo $sql;
        return $this->getRows();
    }

}