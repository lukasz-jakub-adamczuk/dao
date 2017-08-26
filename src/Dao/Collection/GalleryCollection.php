<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class GalleryCollection extends Collection {

    // public function getSelectPart() {
    // 	return 'SELECT article.*, article_category.name category, user.name author, COUNT(article_comment.id_article_comment) comments';
    // }

    // public function getJoinPart() {
    // 	return 'LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category) LEFT JOIN user ON(user.id_user=article.id_author) LEFT JOIN article_comment ON(article_comment.id_article=article.id_article)';
    // }

    public function getGalleriesForCategory($category) {
        $sql = 'SELECT g.*, c.name category_name, c.slug category_slug
                FROM gallery g 
                LEFT JOIN gallery_category c ON(c.id_gallery_category=g.id_gallery_category) 
                WHERE c.slug="'.$category.'" 
                ORDER BY g.name';
        $this->query($sql);
        return $this->getRows();
    }

    public function getGalleryImagesById($sId) {
        $sql = 'SELECT gi.*
                FROM gallery_image gi 
                -- LEFT JOIN gallery g ON(g.id_gallery=gi.id_gallery) 
                -- LEFT JOIN gallery_category c ON(c.id_gallery_category=g.id_gallery_category) 
                -- LEFT JOIN user u ON(u.id_user=g.id_author) 
                WHERE gi.id_gallery="'.$sId.'" ';
        $this->query($sql);
        // echo $this->getQuery();
        // $this->load(-1);
        return $this->getRows('id_gallery_image');
    }

}