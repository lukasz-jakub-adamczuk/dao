<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class NewsEntity extends Entity {
    
    public function getNews($slug, $year, $month, $day) {
        $sql = 'SELECT n.*, COUNT(nc.id_news_comment) comments, u.slug author_slug, u.name author_name 
                FROM news n 
                LEFT JOIN user u ON(u.id_user=n.id_author) 
                LEFT JOIN news_comment nc ON(nc.id_news=n.id_news) 
                WHERE n.slug="'.$slug.'" AND YEAR(n.creation_date)="'.$year.'" AND MONTH(n.creation_date)="'.$month.'" AND DAY(n.creation_date)="'.$day.'"';
        $this->query($sql);
        return $this->getFields();
    }

    public function getNewsByOldUrl($url) {
        $sql = 'SELECT n.*, COUNT(nc.id_news_comment) comments, u.slug author_slug, u.name author_name 
                FROM news n 
                LEFT JOIN user u ON(u.id_user=n.id_author) 
                LEFT JOIN news_comment nc ON(nc.id_news=n.id_news) 
                WHERE n.old_url="'.$url.'" ';
        $this->query($sql);
        return $this->getFields();
    }
}