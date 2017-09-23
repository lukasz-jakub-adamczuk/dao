<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class NewsImageCollection extends Collection {
    
    public function getNewsImagesById($id) {
        $sql = 'SELECT ni.*
                FROM news_image ni 
                WHERE ni.id_news='.$id.'
                ORDER BY ni.id_news_image';
        $this->query($sql);
        return $this->getRows();
    }
}