<?php

namespace System\Databases\Objects;

use System\Databases\BaseObject;

/**
 * @method static Date[] getAll()
 * @method static Date getById($id)
 */
class Date extends BaseObject
{

    protected static string $table = 'dates';
    protected static array $joinForeignKeys = [
        'user_id' => [
            'table' => 'users',
            'object' => 'System\Databases\Objects\User'
        ]
    ];

    public ?int $id = null;
    public ?int $user_id = null;
    public string $location = '';
    public string $description = '';
    public string $datetime = '';
    public string $size = '';
    public float $price = 0;
    public int $hours = 0;
    private array $jobIds = [];


    /**
     * @return bool
     */
    public function saveJobs(): bool
    {
        try {
            $this->db->beginTransaction();

            //Delete all current references
            $statement = $this->db->prepare('DELETE FROM date_job WHERE date_id = :date_id');
            $statement->execute([':date_id' => $this->id]);

            //Add the current references
            foreach ($this->jobIds as $jobId) {
                $statement = $this->db->prepare('INSERT INTO date_job (job_id, date_id) VALUES (:job_id, :date_id)');
                $statement->execute([
                    ':job_id' => $jobId,
                    ':date_id' => $this->id
                ]);
            }
            $this->db->commit();
            return true;
        } catch (\PDOException) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * @return Job[]
     */
    public function getJobs(): array
    {
        $statement = $this->db->prepare(
            'SELECT jobs.* FROM jobs
                    LEFT JOIN date_job ON jobs.id = date_job.job_id
                    LEFT JOIN dates on date_job.date_id = dates.id
                    WHERE dates.id = :date_id'
        );
        $statement->execute([':date_id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, "\System\Databases\Objects\Job");
    }

    /**
     * @return array
     */
    public function getJobIds(): array
    {
        return $this->jobIds;
    }


    /**
     * @param array $jobIds
     * @return void
     */
    public function setJobIds(array $jobIds): void
    {
        $this->jobIds = $jobIds;
    }
}