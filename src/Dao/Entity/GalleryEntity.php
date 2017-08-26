<?php

namespace Dao\Entity;

use Aya\Dao\Entity;

class GalleryEntity extends Entity {
    
    public function getGallery($gallerySlug, $categorySlug) {
        $sql = 'SELECT gi.*, g.name name, c.name category_name, c.slug category_slug, u.name author_name 
                FROM gallery_image gi 
                LEFT JOIN gallery g ON(g.id_gallery=gi.id_gallery) 
                LEFT JOIN gallery_category c ON(c.id_gallery_category=g.id_gallery_category) 
                LEFT JOIN user u ON(u.id_user=g.id_author) 
                WHERE g.slug="'.$gallerySlug.'" AND c.slug="'.$categorySlug.'" ';
        $this->query($sql);
        return $this->getFields();
    }

    public function getGalleryByOldUrl($url) {
        $sql = 'SELECT gi.*, c.name category_name, c.slug category_slug, u.name author_name 
                FROM gallery_image gi 
                LEFT JOIN gallery g ON(g.id_gallery=gi.id_gallery) 
                LEFT JOIN gallery_category c ON(c.id_gallery_category=g.id_gallery_category) 
                LEFT JOIN user u ON(u.id_user=g.id_author) 
                WHERE g.old_url="'.$url.'" ';
        $this->query($sql);
        return $this->getFields();
    }
}