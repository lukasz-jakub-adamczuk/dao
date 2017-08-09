<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class StoryCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT story_comment.*, user.name author, story.title object_name, story.slug object_slug, story_category.name category_name, story_category.slug category_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=story_comment.id_author) LEFT JOIN story ON(story.id_story=story_comment.id_story) LEFT JOIN story_category ON(story_category.id_story_category=story.id_story_category)';
    }

    public function getCommentsById($id) {
        $sql = 'SELECT sc.*, u.name author_name 
                FROM story_comment sc 
                LEFT JOIN user u ON(u.id_user=sc.id_author) 
                WHERE sc.id_story='.$id.'';
        $this->query($sql);
        return $this->getRows();
    }
}