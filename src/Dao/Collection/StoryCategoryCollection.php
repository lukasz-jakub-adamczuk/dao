<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class StoryCategoryCollection extends Collection {
    
    public function getCategories() {
        $sql = 'SELECT story_category.id_story_category, story_category.name, story_category.slug, story_category.abbr
                FROM story_category
                WHERE `visible`=1
                ORDER BY name';
        $this->query($sql);
        $this->load(-1);
        return $this->getRows();
    }

    public function getCategoriesWithCounters() {
        $sql = 'SELECT c.*, COUNT(s.id_story) items
                FROM story s 
                LEFT JOIN story_category c
                    ON(c.id_story_category=s.id_story_category)
                GROUP BY s.id_story_category';
        $this->query($sql);
        return $this->getRows();
    }
}