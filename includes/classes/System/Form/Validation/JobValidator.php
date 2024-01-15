<?php namespace System\Form\Validation;


use System\Databases\Objects\Job;

/**
 * Class JobValidator
 * @package System\Form\Validation
 */
class JobValidator implements Validator
{
    private array $errors = [];

    /**
     * JobValidator constructor.
     *
     * @param Job $job
     */
    public function __construct(private readonly Job $job)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->job->name == '') {
            $this->errors[] = 'Name cannot be empty';
        }
        if ($this->job->description == '') {
            $this->errors[] = 'Description cannot be empty';
        }
        if ($this->job->price < 0) {
            $this->errors[] = 'Price cannot be negative';
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
