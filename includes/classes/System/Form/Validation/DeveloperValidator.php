<?php namespace System\Form\Validation;

use System\Databases\Objects\Developer;
use System\Form\Validation\Validator;

/**
 * Class DeveloperValidator
 * @package System\Form\Validation
 */
class DeveloperValidator implements Validator
{
    private array $errors = [];

    /**
     * DeveloperValidator constructor.
     *
     * @param Developer $developer
     */
    public function __construct(private readonly Developer $developer)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->developer->name == '') {
            $this->errors[] = 'Developer name cannot be empty';
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
