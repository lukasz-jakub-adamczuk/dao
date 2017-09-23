<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class GalleryCommentCollection extends Collection {
    
    public function getSelectPart() {
    	return 'SELECT gallery_comment.*, u.name author, g.name object_name, g.slug object_slug, c.name category_name, c.slug category_slug';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user u ON(u.id_user=gallery_comment.id_author)
                LEFT JOIN gallery g ON(g.id_gallery=gallery_comment.id_gallery)
                LEFT JOIN gallery_category c ON(c.id_gallery_category=g.id_gallery_category)';
    }
}