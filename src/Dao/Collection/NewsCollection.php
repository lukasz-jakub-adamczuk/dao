<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class NewsCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT news.*, user.name author, COUNT(news_image.id_news_image) images, COUNT(news_comment.id_news_comment) comments';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=news.id_author) LEFT JOIN news_image ON(news_image.id_news=news.id_news) LEFT JOIN news_comment ON(news_comment.id_news=news.id_news)';
    }
    
    public function getNews() {
        $sql = 'SELECT n.*, COUNT(n.id_news) items, YEAR(n.creation_date) year 
                FROM news n 
                GROUP BY YEAR(n.creation_date) 
                ORDER BY n.id_news';
        $this->query($sql);
        return $this->getRows();
    }

    public function getNewsByYear($year) {
        $sql = 'SELECT n.*, COUNT(n.id_news) items, YEAR(n.creation_date) year, MONTH(n.creation_date) month 
                FROM news n 
                WHERE YEAR(n.creation_date)='.$year.' 
                GROUP BY MONTH(n.creation_date)';
        $this->query($sql);
        return $this->getRows();
    }

    public function getNewsByMonth($year, $month) {
        $sql = 'SELECT n.*, COUNT(n.id_news) items, u.name user, COUNT(nc.id_news_comment) comments 
                FROM news n 
                LEFT JOIN user u ON(u.id_user=n.id_author) 
                LEFT JOIN news_comment nc ON(nc.id_news=n.id_news) 
                WHERE YEAR(n.creation_date)="'.$year.'" AND MONTH(n.creation_date)="'.$month.'" 
                GROUP BY n.id_news 
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
        return $this->getRows();
    }

    public function getNewsSiblings($iId, $limit = 10) {
        $sql = 'SELECT n.id_news, n.title, n.slug, n.creation_date, n.visible, MAX(n.id_news) recent
                FROM news n
                WHERE n.visible=1 AND n.id_news > '.($iId-round($limit/2)).' AND n.id_news < '.($iId+round($limit/2)).'
                GROUP BY n.id_news
                ORDER BY n.id_news DESC';
        $this->query($sql);
        return $this->getRows();
    }
}