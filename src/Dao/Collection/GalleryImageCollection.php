<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class GalleryImageCollection extends Collection {

    public function getGalleryImagesById($sId) {
        $sql = 'SELECT gi.*
                FROM gallery_image gi 
                -- LEFT JOIN gallery g ON(g.id_gallery=gi.id_gallery) 
                -- LEFT JOIN gallery_category c ON(c.id_gallery_category=g.id_gallery_category) 
                -- LEFT JOIN user u ON(u.id_user=g.id_author) 
                WHERE gi.id_gallery="'.$sId.'" ';
        $this->query($sql);
        return $this->getRows();
    }

    public function getGalleryCosplays($limit = 8) {
        $sql = 'SELECT gi.id_gallery_image, gi.name
                FROM gallery_image gi 
                -- LEFT JOIN gallery_category gc ON(gc.id_gallery_category=gi.id_gallery_category)
                WHERE gi.id_gallery=4
                GROUP BY gi.id_gallery_image, gi.name
                ORDER BY gi.id_gallery_image DESC
                LIMIT 0,' . $limit;
        $this->query($sql);
        return $this->getRows();
    }

    public function getGalleryWallpapers($limit = 8) {
        return $this->getGalleryImages(1, $limit);
    }

    public function getGalleryFanarts($limit = 8) {
        return $this->getGalleryImages(2, $limit);
    }

    private function getGalleryImages($type, $limit = 8) {
        // $sql = 'SELECT gi.*, g.slug, gc.slug AS category_slug
        // $sql = 'SELECT ANY_VALUE(gi.id_gallery_image), gi.id_gallery, gi.name, ANY_VALUE(g.slug), ANY_VALUE(gc.slug) category_slug
        // $sql = 'SELECT gi.id_gallery_image, gi.id_gallery
        $sql = 'SELECT gi.*, g.slug AS gallery_name, gc.slug AS category_slug, gc.name AS category_name
                FROM gallery_image gi 
                LEFT JOIN gallery g ON(g.id_gallery=gi.id_gallery)
                LEFT JOIN gallery_category gc ON(gc.id_gallery_category=g.id_gallery_category)
                WHERE gc.id_gallery_category = '.$type.'
                GROUP BY gi.id_gallery
                -- GROUP BY gi.id_gallery, gi.name, gi.id_gallery_image, g.slug, category_slug
                ORDER BY gi.id_gallery_image DESC
                LIMIT 0,8';
              
        // $sql = 'SELECT ANY_VALUE(gi.id_gallery_image) id_gallery_image, ANY_VALUE(gi.name) name, gi.id_gallery, ANY_VALUE(g.slug) slug, ANY_VALUE(gc.slug) category_slug
        //         FROM gallery_image gi
        //         LEFT JOIN gallery g ON (g.id_gallery = gi.id_gallery)
        //         LEFT JOIN gallery_category gc ON (gc.id_gallery_category = g.id_gallery_category)
        //         WHERE gc.id_gallery_category = '.$type.'
        //         GROUP BY gi.id_gallery
        //         order by gi.id_gallery DESC
        //         LIMIT 0 , '.$limit;
        $this->query($sql);
        return $this->getRows();
    }

}