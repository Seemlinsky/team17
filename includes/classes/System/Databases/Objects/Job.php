<?php

namespace System\Databases\Objects;

use System\Databases\BaseObject;

class Job extends BaseObject
{
    protected static string $table = 'jobs';

    public int $id = 0;
    public string $name = '';
    public string $description = '';
    public float $price = 0;

    /**
     * As Job is used on many-to-many related scenarios, we need a simple string when printing the object
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Date[]
     */
    public function dates(): array
    {
        $statement = $this->db->prepare(
            "SELECT date.* FROM `dates` AS date
                    LEFT JOIN date_job dj ON date.id = dj.date_id
                    LEFT JOIN jobs j on dj.job_id = j.id
                    WHERE `j`.`id` = :id"
        );
        $statement->execute([':id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'System\Databases\Objects\Date');
    }
}