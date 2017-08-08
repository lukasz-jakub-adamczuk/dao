<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ArticleTemplateCollection extends Collection {
    
    public function getTemplates() {
        $this->query('SELECT article_template.id_article_template, article_template.name, article_template.slug FROM article_template WHERE `visible`=1 ORDER BY name');
        $this->load(-1);
        return $this->getRows();
        // return $this->getColumn();
    }
}