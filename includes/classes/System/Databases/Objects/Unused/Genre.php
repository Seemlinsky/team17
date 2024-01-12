<?php

namespace System\Databases\Objects\Unused;

use System\Databases\BaseObject;

class Genre extends BaseObject
{
    protected static string $table = 'genres';

    public int $id = 0;
    public string $name = '';

    /**
     * As Genre is used on many-to-many related scenarios, we need a simple string when printing the object
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Game[]
     */
    public function games(): array
    {
        $statement = $this->db->prepare(
            "SELECT gam.* FROM `games` AS gam
                    LEFT JOIN game_genre gg ON gam.id = gg.game_id
                    LEFT JOIN genres g on gg.genre_id = g.id
                    WHERE `g`.`id` = :id"
        );
        $statement->execute([':id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'System\Databases\Objects\Unused\Game');
    }
}