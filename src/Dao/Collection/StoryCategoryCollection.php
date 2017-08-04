<?php
require_once AYA_DIR.'/Dao/Collection.php';

class StoryCategoryCollection extends Collection {
    
    public function getCategories() {
        $this->query('SELECT story_category.id_story_category, story_category.name, story_category.slug, story_category.abbr FROM story_category WHERE `visible`=1 ORDER BY name');
        $this->load(-1);
        return $this->getRows();
        // return $this->getColumn();
    }
}