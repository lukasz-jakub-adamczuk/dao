<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class StoryCommentCollection extends Collection {
    
    public function getSelectPart() {
        return 'SELECT story_comment.*, u.name author, s.title object_name, s.slug object_slug, c.name category_name, c.slug category_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user u ON(u.id_user=story_comment.id_author)
                LEFT JOIN story s ON(s.id_story=story_comment.id_story)
                LEFT JOIN story_category c ON(c.id_story_category=s.id_story_category)';
    }
}