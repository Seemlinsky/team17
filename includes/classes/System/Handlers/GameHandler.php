<?php namespace System\Handlers;

use System\Databases\Objects\Game;
use System\Databases\Objects\Developer;
use System\Databases\Objects\Genre;
use System\Form\Data;
use System\Utils\Image;

class GameHandler extends BaseHandler
{
    use FillAndValidate\Game;
    private Game $game;
    private Data $formData;
    private Image $image;

    public function __construct(string $templateName)
    {
        parent::__construct($templateName);
        $this->image = new Image();
    }


    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function index(): void
    {
        //Get all games
        $games = Game::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Home',
            'games' => $games,
            'totalGames' => count($games)
        ]);
    }
    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function detail(): void
    {
        try {
            //Get the records from the db
            $game = Game::getById((int)$_GET['id']);

            //Default page title
            $pageTitle = $game->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = 'Something went wrong retrieving the game as it doesn\'t seem to exist.';
            $pageTitle = 'Game does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'game' => $game ?? null,
            'errors' => $this->errors
        ]);
    }

    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function create(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=games/create');
            exit;
        }

        //Set default empty game & execute POST logic
        $this->game = new Game();
        $this->executePostHandler();

        //Special check for create form only
        if (isset($this->formData) && $_FILES['image']['error'] == 4) {
            $this->errors[] = 'Image cannot be empty';
        }

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Store image & retrieve name for database saving
            $this->game->image = $this->image->save($_FILES['image']);

            //Save the record to the db
            if ($this->game->save()) {
                if ($this->game->saveGenres()) {
                    $success = 'Your new game has been created in the database!';
                } else {
                    Game::delete($this->game->id);
                }
                //Override to see a new empty form
                $this->game = new Game();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the game';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create game',
            'game' => $this->game,
            'developers' => Developer::getAll(),
            'genres' => Genre::getAll(),
            'genreIds' => $this->game->getGenreIds(),
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }


    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function edit(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=games/edit?id='.$_GET['id']);
            exit;
        }
        try {
            //Get the record from the db & execute POST logic
            $this->game = Game::getById((int)$_GET['id']);
            $this->game->setGenreIds(array_map(fn(Genre $genre) => $genre->id, $this->game->getGenres()));
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //If image is not empty, process the new image file
                if ($_FILES['image']['error'] != 4) {
                    //Remove old image
                    $this->image->delete($this->game->image);

                    //Store new image & retrieve name for database saving (override current image name)
                    $this->game->image = $this->image->save($_FILES['image']);
                }

                //Save the record to the db
                if ($this->game->save()) {
                    if ($this->game->saveGenres()) {
                        $success = 'Your game has been updated in the database!';
                    } else {
                        $this->errors[] = 'Whoops, something went wrong updating the genres of the game';
                    }
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the game';
                }
            }

            $pageTitle = 'Edit ' . $this->game->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = 'Something went wrong retrieving the game as it doesn\'t seem to exist.';
            $pageTitle = 'Game does\'t exist';
        }

        $genreIds = null;
        if(isset($this->game)){
            $genreIds = $this->game->getGenreIds();
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'game' => $this->game ?? null,
            'developers' => Developer::getAll(),
            'genres' => Genre::getAll(),
            'genreIds' => $genreIds,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=games/delete?id='.$_GET['id']);
            exit;
        }
        try {
            //Get the record from the db
            $game = Game::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB, and if successful remove image as well
                if (Game::delete((int)$_GET['id'])) {
                    //Remove image
                    $this->image->delete($game->image);

                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'games');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete game',
                'game' => $game,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //We don't want anyone sniffing the delete page for no reason, so without correct parameters, return back
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'games');
            exit;
        }
    }
}