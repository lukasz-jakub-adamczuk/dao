<?php

namespace Dao\Collection;

use Aya\Dao\Collection;

class ChangeLogCollection extends Collection {

    public function getSelectPart() {
        return 'SELECT change_log.*, user.name author';
    }

    public function getJoinPart() {
        return 'LEFT JOIN user ON(user.id_user=change_log.id_author)';
    }
    
    public function getChangeLogs($sObjectType, $sObjectId) {
        $this->leftJoin('user', 'id_user', 'id_author');
        $this->where('id_record', $sObjectId);
        $this->where('`table`', $sObjectType);
        $this->orderby('creation-date', 'desc');
        return $this->getRows();
        // return $this->getColumn();
    }
}