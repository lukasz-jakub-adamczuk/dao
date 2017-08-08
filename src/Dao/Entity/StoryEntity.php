<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class StoryEntity extends Entity {
    
    public function getStory($slug) {
        $sql = 'SELECT s.*, c.name category_name, c.slug category_slug, u.slug author_slug, u.name author_name 
                    FROM story s 
                    LEFT JOIN story_category c ON(c.id_story_category=s.id_story_category) 
                    LEFT JOIN user u ON(u.id_user=s.id_author) 
                    WHERE s.slug="'.$slug.'" ';
        $this->query($sql);
        return $this->getFields();
    }

    public function getStoryByOldUrl($url) {
        $sql = 'SELECT s.*, c.name category_name, c.slug category_slug, u.slug author_slug, u.name author_name 
                    FROM story s 
                    LEFT JOIN story_category c ON(c.id_story_category=s.id_story_category) 
                    LEFT JOIN user u ON(u.id_user=s.id_author) 
                    WHERE s.old_url="'.$url.'" ';
        $this->query($sql);
        return $this->getFields();
    }
}