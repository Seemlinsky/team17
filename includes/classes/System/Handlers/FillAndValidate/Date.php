<?php namespace System\Handlers\FillAndValidate;

use System\Form\Data;
use System\Form\Validation\DateValidator;
use System\Databases\Objects\Job;

/**
 * Trait Date
 * @package System\Handlers
 */
trait Date
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->date->location = $this->formData->getPostVar('location');
            $this->date->description = $this->formData->getPostVar('description');
            $this->date->setJobIds($this->formData->getPostVar('job-ids'));
            $this->date->size = $this->formData->getPostVar('size');
            $this->date->datetime = $this->formData->getPostVar('datetime');

            foreach($this->formData->getPostVar('job-ids') as $jobId)
            {
                $this->date->price += Job::getById($jobId)->price;
            }


            //Actual validation
            $validator = new DateValidator($this->date);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
