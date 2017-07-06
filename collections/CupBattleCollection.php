<?php
require_once AYA_DIR.'/Dao/Collection.php';

class CupBattleCollection extends Collection {

    public function getBattles($cupSlug) {
        $sql = 'SELECT cb.*, cp1.name name1, cp2.name name2, cp1.slug slug1, cp2.slug slug2
                FROM cup_battle cb
                LEFT JOIN cup c ON (c.id_cup=cb.id_cup)
                LEFT JOIN cup_player cp1 ON (cp1.id_cup_player=cb.player1)
                LEFT JOIN cup_player cp2 ON (cp2.id_cup_player=cb.player2)
                WHERE c.slug="'.$cupSlug.'"
                ORDER BY cb.id_cup_battle';
        $this->query($sql);
        return $this->getRows();
    }
    
    public function getCupPhaseBattles() {
        $sql = 'SELECT *
                FROM `cup_battle`
                WHERE id_cup = (SELECT MAX(id_cup) FROM cup)
                ORDER BY id_cup_battle
                LIMIT 48,64';
        $this->query($sql);
        return $this->getRows();
    }

    public function getCupBattle($battleDate) {
        $sql = 'SELECT
                    cb.*, c.slug cup_slug, cp1.name as player1_name, cp2.name AS player2_name, cp1.slug as player1_slug, cp2.slug AS player2_slug
                FROM cup_battle cb 
                LEFT JOIN cup c ON(c.id_cup=cb.id_cup)
                LEFT JOIN cup_player cp1 ON(cp1.id_cup_player=cb.player1)
                LEFT JOIN cup_player cp2 ON(cp2.id_cup_player=cb.player2)
                WHERE cb.id_cup_battle="'.$battleDate.'"';
        $this->query($sql);
        return $this->getRows();
    }

    public function getPlayerRecentStats($player, $battleDate) {
        $sql = 'SELECT 
                    id_cup_battle,
                    SUM(IF(id_cup_battle, 1, 0)) AS matches,
                    SUM(IF((player1 = '.$player.' AND score1 > score2) OR (player2 = '.$player.' AND score1 < score2), 3, 0)) AS wins, 
                    SUM(IF(score1 = score2, 1, 0)) AS draws,
                    SUM(IF(player1 = '.$player.', score1, 0) + IF(player2 = '.$player.', score2, 0)) AS won,
                    SUM(IF(player1 = '.$player.', score2, 0) + IF(player2 = '.$player.', score1, 0)) AS lost
                FROM cup_battle
                WHERE (player1 = '.$player.'
                    OR player2 = '.$player.')
                AND id_cup_battle < "'.$battleDate.'"
                GROUP BY id_cup';
        $this->query($sql);
        return $this->getRows();
    }
}

