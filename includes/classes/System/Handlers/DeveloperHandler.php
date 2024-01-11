<?php namespace System\Handlers;

use System\Databases\Objects\Developer;
use System\Handlers\BaseHandler;
use System\Handlers\FillAndValidate;

/**
 * Class DeveloperValidator
 * @package MusicCollection\Handlers
 * @noinspection PhpUnused
 */
class DeveloperHandler extends BaseHandler
{
    use FillAndValidate\Developer;

    private Developer $developer;

    protected function index(): void
    {
        //Get all developers
        $developers = Developer::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Developers',
            'developers' => $developers,
            'totalDevelopers' => count($developers)
        ]);
    }

    protected function create(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=developers/create');
            exit;
        }

        //Set default empty developer & execute POST logic
        $this->developer = new Developer();
        $this->executePostHandler();

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {

            //Save the record to the db
            if ($this->developer->save()) {
                $success = 'Your new developer has been created in the database!';
                //Override to see a new empty form
                $this->developer = new Developer();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the developer';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create developer',
            'developer' => $this->developer,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=developers/edit');
            exit;
        }
        try {
            //Get the record from the db & execute POST logic
            $this->developer = Developer::getById($_GET['id']);
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //Save the record to the db
                if ($this->developer->save()) {
                    $success = 'Your developer has been updated in the database!';
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the developer';
                }
            }

            $pageTitle = 'Edit ' . $this->developer->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->developer = new Developer();
            $this->errors[] = 'Whoops: ' . $e->getMessage();
            $pageTitle = 'Developer does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'developer' => $this->developer,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    protected function detail(): void
    {
        try {
            //Get the records from the db
            $developer = Developer::getById($_GET['id']);

            //Default page title
            $pageTitle = $developer->name;
        } catch (\Exception $e) {
            //Something went wrong on this level
            $this->errors[] = $e->getMessage();
            $pageTitle = 'Developer does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'developer' => $developer ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=developers/delete');
            exit;
        }

        try {
            //Get the record from the db
            $developer = Developer::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB, and if successful remove image as well
                if (Developer::delete((int)$_GET['id'])) {
                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'developers');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete developer',
                'developer' => $developer,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //There is no delete template, always redirect.
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'developers');
            exit;
        }
    }
}
