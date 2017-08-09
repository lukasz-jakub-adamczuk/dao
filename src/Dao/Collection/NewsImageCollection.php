<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class NewsImageCollection extends Collection {
    
    public function getNewsImagesById($id) {
        $sql = 'SELECT ni.*
                FROM news_image ni 
                WHERE ni.id_news='.$id.'';
        $this->query($sql);
        return $this->getRows();
    }
}