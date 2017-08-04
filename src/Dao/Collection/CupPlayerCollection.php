<?php
require_once AYA_DIR.'/Dao/Collection.php';

class CupPlayerCollection extends Collection {

    public function getPlayersFromLatestCup() {
        $sql = 'SELECT id_cup_player, `group`, battles, points, won, lost
                FROM `cup_player`
                WHERE id_cup=(SELECT MAX(id_cup) FROM cup)
                ORDER BY `group` ASC, battles DESC, points DESC, won DESC, lost ASC';
        $this->query($sql);
        return $this->getRows();
    }

    public function getPlayersForRanking($cupSlug) {
		$sql = 'SELECT cp.*
                FROM cup_player cp
                LEFT JOIN cup c ON (c.id_cup=cp.id_cup)
                WHERE c.slug="'.$cupSlug.'"
                ORDER BY cp.group, points DESC, won DESC, lost ASC';
        $this->query($sql);
		return $this->getRows();
	}
}

