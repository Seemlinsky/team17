<?php namespace System\Handlers\Unused;

use System\Form\Data;
use System\Form\Validation\GameValidator;

/**
 * Trait Game
 * @package MusicCollection\Handlers
 */
trait Game
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->game->name = $this->formData->getPostVar('name');
            $this->game->description = $this->formData->getPostVar('description');
            $this->game->developer_id = $this->formData->getPostVar('developer-id');
            $this->game->year = $this->formData->getPostVar('year');
            $this->game->rating = (float)$this->formData->getPostVar('rating');
            $this->game->setGenreIds($this->formData->getPostVar('genre-ids'));

            //Actual validation
            $validator = new GameValidator($this->game);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
