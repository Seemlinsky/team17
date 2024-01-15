<?php namespace System\Form\Validation;

use System\Databases\Objects\Date;

/**
 * Class GameValidator
 * @package System\Form\Validation
 */
class DateValidator implements Validator
{
    private array $errors = [];

    /**
     * GameValidator constructor.
     *
     * @param Date $date
     */
    public function __construct(private readonly Date $date)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->date->location == '') {
            $this->errors[] = 'Location cannot be empty';
        }

        if ($this->date->description == '') {
            $this->errors[] = 'Description cannot be empty';
        }

        if (empty($this->date->getJobIds())) {
            $this->errors[] = 'You need to choose at least 1 job';
        }

        if ($this->date->size == '') {
            $this->errors[] = 'Size cannot be empty';
        }

        //TODO: add datetime checks for DateValidator
        if (!isset($this->date->datetime)) {
            $this->errors[] = 'Need to set a date';
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
