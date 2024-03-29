<?php namespace System\Databases\Objects;

use System\Databases\BaseObject;
use System\Databases\Database;

/**
 * Class User
 * @package System\Databases\Objects
 * @method static User[] getAll()
 * @method static User getById($id)
 */
class User extends BaseObject
{
    protected static string $table = 'users';

    public ?int $id = null;
    public string $name = '';
    public string $email = '';
    public ?string $password = '';

    /**
     * Get a specific user by its email
     *
     * @param string $email
     * @return User
     * @throws \Exception
     */
    public static function getByEmail(string $email): User
    {
        $db = Database::getInstance();
        $statement = $db->prepare('SELECT * FROM users WHERE email = :email');
        $statement->execute([':email' => $email]);

        if (($user = $statement->fetchObject(get_called_class())) === false) {
            throw new \Exception('User email is not available in the database');
        }

        return $user;
    }
}
