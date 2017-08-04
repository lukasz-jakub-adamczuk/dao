<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class NewsImageCollection extends Collection {
    
    public function getNewsImagesById($mId) {
        $sql = 'SELECT ni.*
                FROM news_image ni 
                WHERE ni.id_news='.$mId.'';
        $this->query($sql);
        return $this->getRows();
    }
}