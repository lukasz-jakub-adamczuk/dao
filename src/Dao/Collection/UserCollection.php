<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class UserCollection extends Collection {
    
    public function getAuthors() {
        $this->query('SELECT user.id_user, user.name FROM user LEFT JOIN user_permission ON(user_permission.id_user=user.id_user) WHERE `id_permission`=1 ORDER BY name');
        $this->load(-1);
        return $this->getColumn();
    }
}