<?php namespace System\Handlers;

use System\Form\Data;
use System\Form\Validation\LoginValidator;
use System\Databases\Objects\User;

/**
 * Class AccountHandler
 * @package System\Handlers
 * @noinspection PhpUnused
 */
class AccountHandler extends BaseHandler
{
    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function login(): void
    {
        //If already logged in, no need to be here
        if ($this->session->keyExists('user')) {
            if(empty($_GET['location']))
            {
                //send back home
                header('Location: '.BASE_PATH);
                exit;
            }
            //go to the location that was given
            header('Location: '.BASE_PATH .$_GET['location']);
            exit;
        }

        //Check if Post isset, else do nothing
        if (isset($_POST['submit'])) {
            //Set form data
            $formData = new Data($_POST);

            //Set post variables
            $email = $formData->getPostVar('email');
            $password = $formData->getPostVar('password');

            //Get the record from the db
            try {
                $user = User::getByEmail($email);
            } catch (\Exception $e) {
                //Probably should work nicer
                $user = new User();
            }

            //Actual validation
            $validator = new LoginValidator($user, $password);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }

        //When no error, set session variable, redirect & exit script
        if (isset($user) && empty($this->errors)) {
            $this->session->set('user', $user);
            if(empty($_GET['location']))
            {
                header('Location: '.BASE_PATH);
                exit;
            }
            header('Location: '.BASE_PATH.$_GET['location']);
            exit;
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Login',
            'email' => $email ?? false,
            'errors' => $this->errors
        ]);
    }

    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function logout(): void
    {
        $this->session->destroy();
        header('Location: login');
        exit;
    }

    protected function register(): void
    {

        //TEMP script just to add an user.
        //$user = new User();
        //$user->email = '';
        //$user->password = password_hash('', PASSWORD_DEFAULT);
        //$user->save();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Registratie',
            'email' => $email ?? false,
            'errors' => $this->errors
        ]);
    }
}
