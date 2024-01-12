<?php

namespace System\Databases\Objects\Unused;

use System\Databases\BaseObject;

/**
 * @method static Developer[] getAll()
 * @method static Developer getById($id)
 */
class Developer extends BaseObject
{

    protected static string $table = 'developers';

    public ?int $id = null;
    public string $name = '';

    /**
     * @return Game[]
     */
    public function games(): array
    {
        $statement = $this->db->prepare(
            "SELECT gam.* FROM `games` AS gam
                    LEFT JOIN developers dev ON dev.id = gam.developer_id
                    WHERE `dev`.`id` = :id"
        );
        $statement->execute([':id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'System\Databases\Objects\Unused\Game');
    }
}