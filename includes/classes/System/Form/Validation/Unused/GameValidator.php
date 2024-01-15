<?php namespace System\Form\Validation\Unused;

use System\Databases\Objects\Unused\Game;
use System\Form\Validation\Validator;

/**
 * Class GameValidator
 * @package System\Form\Validation
 */
class GameValidator implements Validator
{
    private array $errors = [];

    /**
     * GameValidator constructor.
     *
     * @param Game $game
     */
    public function __construct(private readonly Game $game)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->game->name == '') {
            $this->errors[] = 'Name cannot be empty';
        }

        if ($this->game->description == '') {
            $this->errors[] = 'Description cannot be empty';
        }

        //Developer check
        if ($this->game->developer_id == '') {
            $this->errors[] = 'Developer cannot be empty';
        }

        //Genre(s) check
        if (empty($this->game->getGenreIds())) {
            $this->errors[] = 'You need to choose at least 1 genre';
        }

        if ($this->game->year == '') {
            $this->errors[] = 'Year cannot be empty';
        }
        if (!is_numeric($this->game->year) || strlen($this->game->year) != 4) {
            $this->errors[] = 'Year needs to be a number with the length of 4';
        }
        if ($this->game->rating < 0) {
            $this->errors[] = 'Rating cannot be less than 0';
        }
        if($this->game->rating > 10){
            $this->errors[] = 'Rating cannot be higher than 10';
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
