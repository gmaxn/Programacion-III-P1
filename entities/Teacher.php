<?php
require_once __DIR__ . '\..\repos\TeachersRepository.php';

class Teacher
{
    public $legajo;
    public $name;
    public $image;

    public function getImageName($image)
    {

        if ($image != null) {

            return getenv('DEFAULT_TEACHER_IMAGE') . $this->toFilename('.jpeg');
        }

        return getenv('DEFAULT_IMAGE_DIR') . '\default_product.png';
    }
    public function __construct($legajo, $name, $image, $id = null)
    {

        $this->legajo = $legajo;
        $this->type = $name;
        $this->image = $this->getImageName($image);
    }
    public function save()
    {

        $filename = getenv('TEACHERS_FILENAME');
        $ext = strtoupper(array_reverse(explode('.', $filename))[0]);

        switch ($ext) {
            case 'TXT':
                TeachersRepository::saveSerialized($filename, $this);
                break;

            case 'JSON':
                TeachersRepository::saveJSON($filename, $this->toJSON());
                break;

            case 'CSV':
                TeachersRepository::saveCSV($filename, $this->toCSV());
                break;

            default:
                throw new Exception('Incompatible save type exception');
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
            $this->type . ',' .
            $this->brand . ',' .
            $this->price . ',' .
            $this->stock . ',' .
            $this->image . PHP_EOL;
    }
    public function toFilename($ext)
    {
        return '\\' .
            $this->legajo . '-' .
            $this->name . '-' .
            date("dmY_gia") . $ext;
    }
}