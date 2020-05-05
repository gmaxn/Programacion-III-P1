<?php
require_once __DIR__ . '\..\entities\Teacher.php';
require_once __DIR__ . '\..\helpers\Response.php';
require_once __DIR__ . '\..\helpers\Authentication.php';
require_once __DIR__ . '\..\helpers\PhotoUploader.php';
//require_once __DIR__ . '\..\entities\Order.php';
//require_once __DIR__ . '\..\entities\OrderItem.php';


class TeacherController
{
    private $path_info;
    private $request_method;

    function getRoute()
    {

        return $this->request_method . $this->path_info;
    }
    function __construct()
    {

        $this->path_info = $_SERVER['PATH_INFO'] ?? '';
        $this->request_method = $_SERVER['REQUEST_METHOD'] ?? '';
    }
    function start()
    {

        switch ($this->getRoute()) {

            case 'POST/profesor':

                $headers = getallheaders();
                $jwt = $headers['token'];

                $name = $_POST['producto'] ?? false;
                $legajo = $_POST['marca'] ?? false;
                $image = $_FILES['foto'] ?? null;

                echo $this->postTeacherCreate($name, $legajo, $image, $jwt);
                break;

                

            default:
                echo 'Metodo no esperado';
                break;
        }
    }
    // POST/productos/stock
    function postTeacherCreate($name, $legajo, $image, $jwt)
    {
        $validationResult = $this->postTeacherCreateValidation($name, $legajo, $image);
        $response = new Response('failure', $validationResult->errorMessage);

        if (!$validationResult->isValid) {

            try {

                $authorizationResult = Authentication::authorize($jwt);
                $response = new Response('failure', $authorizationResult->errorMessage);

                //if ($authorizationResult->data->userContext->role == 'admin') {

                    $product = new Teacher(
                        $legajo,
                        $name,
                        $image
                    );

                    $product->save('JSON');

                    PhotoUploader::uploadPhoto($image['tmp_name'], $product->image);
                    //PhotoUploader::addWaterMark($product->image, getenv('PHOTO_WATERMARK_DIR'), $product->image, true);
                    //PhotoUploader::crop($product->image, $product->image, 600, 600, true);

                    $response->status = 'succeed';
                    $response->data = $product;
                //}
            } catch (Exception $e) {

                $response = new Response('failure', $e->getMessage());
            }
        }

        return json_encode($response);
    }
    /////////////////////////
    // REQUEST VALIDATIONS //
    /////////////////////////
    private function postTeacherCreateValidation($name, $legajo, $image)
    {
        $validationResults = array(

            Validator::names($name),
            Validator::dnis($legajo)

        );

        foreach ($validationResults as $result) {

            if (!$result->isValid) {

                return $result;
            }
        }

        return new ValidationResult('succeed', 'is valid request', true);
    }

}
