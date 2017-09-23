<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class NewsImageEntity extends Entity {
    
    public function getFirstImage($sNewsId) {
        $sql = 'SELECT ni.*
                FROM news_image ni
                WHERE id_news = "'.$sNewsId.'"
                ORDER BY ni.id_news_image';
        $this->query($sql);
        $this->load();
        return $this->getFields();
    }
}