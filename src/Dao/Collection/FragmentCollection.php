<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class FragmentCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT fragment.*, fragment_type.name type, user.id_user, user.name author';
    }

    public function getJoinPart() {
        return 'LEFT JOIN fragment_type ON(fragment_type.id_fragment_type=fragment.id_fragment_type) LEFT JOIN user ON(user.id_user=fragment.id_author)';
    }
}