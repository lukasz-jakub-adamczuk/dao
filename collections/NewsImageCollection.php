<?php
require_once AYA_DIR.'/Dao/Collection.php';

class NewsImageCollection extends Collection {
    
    public function getNewsImagesById($mId) {
        $sql = 'SELECT ni.*
                FROM news_image ni 
                WHERE ni.id_news='.$mId.'';
        $this->query($sql);
        return $this->getRows();
    }
}