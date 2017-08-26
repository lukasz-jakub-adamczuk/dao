<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class GalleryCommentCollection extends Collection {
    
    // public function getSelectPart() {
    // 	return 'SELECT gallery_comment.*, user.name author, gallery.title object_name, gallery.slug object_slug, gallery_category.name category_name, gallery_category.slug category_slug';
    // }

    // public function getJoinPart() {
    // 	return 'LEFT JOIN user ON(user.id_user=gallery_comment.id_author) LEFT JOIN gallery ON(gallery.id_gallery=gallery_comment.id_gallery) LEFT JOIN gallery_category ON(gallery_category.id_gallery_category=gallery.id_gallery_category)';
    // }

    public function getCommentsById($id) {
        $sql = 'SELECT gc.*, u.name author_name 
                FROM gallery_comment gc 
                LEFT JOIN user u ON(u.id_user=gc.id_author) 
                WHERE gc.id_gallery='.$id.' AND gc.visible=1';
        $this->query($sql);
        return $this->getRows();
    }

    public function howManyCommentsWroteUser($id) {
        $sql = 'SELECT COUNT(id_gallery_comment) FROM gallery_comment WHERE id_author="'.$id.'"';
        return $this->getOne($sql);
    }
}