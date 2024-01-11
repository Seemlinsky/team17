<?php namespace System\Handlers\FillAndValidate;

use System\Form\Validation\DeveloperValidator;
use System\Form\Data;

/**
 * Trait Developer
 * @package System\Handlers
 */
trait Developer
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->developer->name = $this->formData->getPostVar('name');

            //Actual validation
            $validator = new DeveloperValidator($this->developer);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
