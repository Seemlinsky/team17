<?php namespace System\Handlers;

use System\Databases\Objects\Job;

/**
 * Class JobHandler
 * @package System\Handlers
 * @noinspection PhpUnused
 */
class JobHandler extends BaseHandler
{
    use FillAndValidate\Job;

    private Job $job;

    protected function index(): void
    {
        //Get all genres
        $jobs = Job::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Jobs',
            'jobs' => $jobs,
            'totalJobs' => count($jobs)
        ]);
    }



    /**
     * @noinspection PhpUnused
     */
    protected function detail(): void
    {
        try {
            //Get the records from the db
            $job = Job::getById($_GET['id']);

            //Default page title
            $pageTitle = $job->name;
        } catch (\Exception $e) {
            //Something went wrong on this level
            $this->errors[] = $e->getMessage();
            $pageTitle = 'Job does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'job' => $job ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function create(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=jobs/create');
            exit;
        }

        //Set default empty job & execute POST logic
        $this->job = new Job();
        $this->executePostHandler();

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Save the record to the db
            if ($this->job->save()) {
                $success = 'Your new job has been created in the database!';
                //Override to see a new empty form
                $this->job = new Job();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the job';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create job',
            'job' => $this->job,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=jobs/edit');
            exit;
        }

        try {
            //Get the record from the db & execute POST logic
            $this->job = Job::getById($_GET['id']);
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //Save the record to the db
                if ($this->job->save()) {
                    $success = 'Your job has been updated in the database!';
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the job';
                }
            }

            $pageTitle = 'Edit ' . $this->job->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->job = new Job();
            $this->errors[] = 'Whoops: ' . $e->getMessage();
            $pageTitle = 'Job does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'job' => $this->job,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=jobs/delete');
            exit;
        }
        try {
            //Get the record from the db
            $job = Job::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB
                if (Job::delete((int)$_GET['id'])) {
                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'jobs');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete job',
                'job' => $job,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //There is no delete template, always redirect.
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'jobs');
            exit;
        }
    }
}
