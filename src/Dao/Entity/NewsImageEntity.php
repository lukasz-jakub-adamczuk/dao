<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class NewsImageEntity extends Entity {
    
    public function getFirstImage($sNewsId) {
        $this->query('SELECT ni.* FROM news_image ni WHERE id_news = "'.$sNewsId.'"');
        $this->load();
        return $this->getFields();
    }
}