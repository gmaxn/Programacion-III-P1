<?php
require_once __DIR__ . '\..\entities\Client.php';
require_once __DIR__ . '\..\helpers\Validator.php';
require_once __DIR__ . '\..\helpers\Response.php';
require_once __DIR__ . '\..\helpers\Authentication.php';
require_once __DIR__ . '\..\config\environment.php';

class ClientController
{
    private $path_info;
    private $request_method;

    function __construct()
    {
        $this->path_info = $_SERVER['PATH_INFO'] ?? '';
        $this->request_method = $_SERVER['REQUEST_METHOD'] ?? '';
    }
    function getRoute()
    {
        return $this->request_method . $this->path_info;
    }
    function start()
    {
        switch ($this->getRoute()) 
        {
            case 'POST/usuario':

                $email = $_POST['email'] ?? null;
                $password = $_POST['clave'] ?? null;

                echo $this->postClientCreate($email, $password);
                break;



            default:
                echo 'Metodo no esperado';
                break;
        }
    }
    // POST/user/
    function postClientCreate($email, $password)
    {
        $validationResult = $this->clientCreateValidation($email, $password);
        $response = new Response('failure', $validationResult->errorMessage);

        if ($validationResult->isValid) {

            $client = new Client(
                $email,
                password_hash($password, PASSWORD_DEFAULT)
            );

            $client->save();

            $response = new Response();
            $response->status = 'succeed';
            $response->data = $client;
        }

        return json_encode($response);
    }
     /////////////////////////
    // REQUEST VALIDATIONS //
    /////////////////////////
    private function clientCreateValidation($email, $password)
    {
        $validationResults = array(

            Validator::emails($email),
            Validator::passwords($password)
        );

        foreach ($validationResults as $result) {
            if (!$result->isValid) {
                return $result;
            }
        }

        return new ValidationResult('succeed', 'is valid request', true);
    }
}