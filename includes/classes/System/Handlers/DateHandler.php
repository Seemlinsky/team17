<?php namespace System\Handlers;

use DateTime;
use System\Databases\Objects\Date;
use System\Databases\Objects\Job;
use System\Form\Data;

class DateHandler extends BaseHandler
{
    use FillAndValidate\Date;
    private Date $date;
    private Data $formData;

    public function __construct(string $templateName)
    {
        parent::__construct($templateName);
    }


    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function index(): void
    {
        //Get all Dates
        $dates = Date::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Home',
            'dates' => $dates,
            'totalDates' => count($dates)
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
            $date = Date::getById((int)$_GET['id']);

            //Default page title
            $pageTitle = $date->location;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = 'Something went wrong retrieving the date as it doesn\'t seem to exist.';
            $pageTitle = 'Date does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'date' => $date ?? null,
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
            header('Location: ' . BASE_PATH . 'user/login?location=dates/create');
            exit;
        }

        //Set default empty date & execute POST logic
        $this->date = new Date();
        $user = $this->session->get('user');
        $this->date->user_id = $user->id;
        $this->executePostHandler();

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Save the record to the db
            if ($this->date->save()) {
                if ($this->date->saveJobs()) {
                    $success = 'Your new date has been created in the database!';
                } else {
                    Date::delete($this->date->id);
                    $this->errors[] = 'Whoops, something went wrong saving the Job';
                }
                //Override to see a new empty form
                $this->date = new Date();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the date';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create date',
            'date' => $this->date,
            'jobs' => Job::getAll(),
            'jobIds' => $this->date->getJobIds(),
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
            header('Location: ' . BASE_PATH . 'user/login?location=dates/edit?id='.$_GET['id']);
            exit;
        }
        try {
            //Get the record from the db & execute POST logic
            $this->date = Date::getById((int)$_GET['id']);
            $this->date->user_id = $this->session->get('user')->id;
            $this->date->setJobIds(array_map(fn(Job $job) => $job->id, $this->date->getJobs()));
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //Save the record to the db
                if ($this->date->save()) {
                    if ($this->date->saveJobs()) {
                        $success = 'Your date has been updated in the database!';
                    } else {
                        $this->errors[] = 'Whoops, something went wrong updating the jobs of the date';
                    }
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the date';
                }
            }

            $pageTitle = 'Edit ' . $this->date->location;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = 'Something went wrong retrieving the date as it doesn\'t seem to exist.';
            $pageTitle = 'Date does\'t exist';
        }

        $jobIds = null;
        if(isset($this->date)){
            $jobIds = $this->date->getJobIds();
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'date' => $this->date ?? null,
            'jobs' => Job::getAll(),
            'jobIds' => $jobIds,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=dates/delete?id='.$_GET['id']);
            exit;
        }
        try {
            //Get the record from the db
            $date = Date::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB, and if successful remove image as well
                if (Date::delete((int)$_GET['id'])) {

                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'dates');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete date',
                'date' => $date,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //We don't want anyone sniffing the delete page for no reason, so without correct parameters, return back
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'dates');
            exit;
        }
    }
}