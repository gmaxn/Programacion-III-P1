<?php
require_once __DIR__ . '\..\repos\ClientsRepository.php';
//require_once __DIR__ . '\..\helpers\Validator.php';

class User
{
    public $id;
    public $email;
    public $password;
    public $role;

    public function __construct($id, $email, $password, $role)
    {

        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
}

class Client extends User {

    public function __construct($email, $password, $role = 'user')
    {
        parent::__construct(

            ($id ?? strtotime('now')),
            $email,
            $password,
            $role
        );
    }
    public function save()
    {

        $filename = getenv('CLIENTS_FILENAME');
        $ext = strtoupper(array_reverse(explode('.', $filename))[0]);

        switch ($ext) {
            case 'TXT':
                ClientsRepository::saveSerialized($filename, $this);
                break;

            case 'JSON':
                ClientsRepository::saveJSON($filename, $this->toJSON());
                break;

            case 'CSV':
                ClientsRepository::saveCSV($filename, $this->toCSV());
                break;

            default:
                ClientsRepository::saveSerialized($filename, $this->toJSON());
                break;
        }
    }
    public function toJSON()
    {

        return json_encode($this);
    }
    public function toCSV()
    {

        return $this->id . ',' .
            $this->email . ',' .
            $this->password . ',' .
            $this->role . ',' .
            $this->firstname . ',' .
            $this->lastname . ',' .
            $this->dni . ',' .
            $this->healthInsurance . PHP_EOL;
    }
}

