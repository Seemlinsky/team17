<?php namespace System\Handlers\FillAndValidate;

use System\Form\Data;
use System\Form\Validation\JobValidator;

/**
 * Trait Job
 * @package System\Handlers
 */
trait Job
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->job->name = $this->formData->getPostVar('name');
            $this->job->description = $this->formData->getPostVar('description');
            $this->job->price = $this->formData->getPostVar('price');

            //Actual validation
            $validator = new JobValidator($this->job);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
