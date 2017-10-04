<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class StoryCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT story.*, story_category.name category, user.name author, COUNT(story_comment.id_story_comment) comments';
    }

    public function getJoinPart() {
        return 'LEFT JOIN story_category ON(story_category.id_story_category=story.id_story_category) LEFT JOIN user ON(user.id_user=story.id_author) LEFT JOIN story_comment ON(story_comment.id_story=story.id_story)';
    }



    // public function getArticleWithTitle($title) {
    // 	$this->query('SELECT article.id_article, article.title, article_category.name category FROM article LEFT JOIN article_category ON(article_category.id_article_category=article.id_article_category) WHERE title LIKE "'.$title.'%" ORDER BY category, title');
    // 	$this->load(-1);
    // 	return $this->getRows();
    // }

    public function getArticleCategories() {
    	$sql = 'SELECT id_story_category, COUNT( id_story ) total
                FROM  `story` 
                GROUP BY id_story_category';
    	return $this->_db->getArray($sql, 'id_story_category');
    }

    public function getArticleCategoriesVerified() {
    	$sql = 'SELECT id_story_category, COUNT( id_story ) good
                FROM  `story` 
                WHERE verified = 1
                GROUP BY id_story_category';
    	return $this->_db->getArray($sql, 'id_story_category');
    }

    public function getArticlesForCategory($category) {
        // $sql = 'SELECT s.*, c.name category_name, c.slug category_slug, f.fragment
        $sql = 'SELECT s.*, c.name category_name, c.slug category_slug
                FROM story s 
                LEFT JOIN story_category c ON(c.id_story_category=s.id_story_category) 
                -- LEFT JOIN object_fragment of ON(of.id_object=s.id_story)
                -- LEFT JOIN fragment f ON(f.id_fragment=of.id_fragment)
                -- WHERE c.slug="'.$category.'" AND s.visible=1 AND of.object="story"
                WHERE c.slug="'.$category.'" AND s.visible=1
                ORDER BY s.creation_date DESC';
        $this->query($sql);
        return $this->getRows();
    }

    public function getArticlesByCategory($idCategory) {
        $sql = 'SELECT story.id_story, story.title name, story.idx
                FROM story
                WHERE id_story_category = "'.$idCategory.'"
                ORDER BY idx, title';
        $this->query($sql);
        $this->load(-1);
        return $this->getRows();
    }

    public function getArticlesForStream($limit = 6) {
        $sql = 'SELECT s.id_story, s.title, s.slug, s.creation_date, s.visible, u.name user_name, c.slug category_slug, c.name category_name, COUNT(sc.id_story_comment) comments, f.fragment
                FROM story s
                LEFT JOIN user u ON(u.id_user=s.id_author)
                LEFT JOIN story_category c ON(c.id_story_category=s.id_story_category)
                LEFT JOIN story_comment sc ON(sc.id_story=s.id_story)
                LEFT JOIN object_fragment of ON(of.id_object=s.id_story)
                LEFT JOIN fragment f ON(f.id_fragment=of.id_fragment)
                WHERE s.visible=1 AND of.object="story"
                GROUP BY s.id_story
                -- GROUP BY s.id_story, s.title, s.slug, s.creation_date, s.visible, user_name, category_slug, category_name, f.fragment
                ORDER BY s.id_story DESC
                LIMIT 0,'.$limit;
        $this->query($sql);
        return $this->getRows();
    }

    public function mostActiveAuthors() {
        $sql = 'SELECT s.id_story, COUNT(s.id_story) total, u.id_user, u.name, u.slug 
                FROM story s
                LEFT JOIN user u ON(u.id_user=s.id_author) 
                WHERE s.id_author > 0 AND u.id_user IS NOT NULL
                GROUP BY s.id_author 
                ORDER BY total DESC 
                LIMIT 0, 10';
        $this->query($sql);
        return $this->getRows();
    }

    public function howManyArticlesWroteUser($id) {
        $sql = 'SELECT COUNT(id_story) FROM story WHERE id_author="'.$id.'"';
        return $this->getOne($sql);
    }
}
