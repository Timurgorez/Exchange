<?php
namespace app\models;

class UploadModel
{
    private $typeOfFile = ['png', 'jpg', 'jpeg', 'zip', 'tar.gz', 'rar', '7z', 'tar.bz2', 'tar'];

    private $pattern = '^\S*(?=\S{8,15})(?=\S*[a-z])(?=\S*[A-Z])\S*$^';

    private $uploadPath = '\..\..\upload\/';

    private $files = null;
    private $post = null;

    private $file_path = null;
    private $file_name = null;
    private $password = null;
    private $extension = null;
    private $size = null;
    private $resolution = null;
    private $is_media = null;
    private $once_download = null;
    private $original_name = null;
    private $available = 1;

    private $errors = [];



    public function __construct($post, $files)
    {
        $this->files = $files['user_file'];
        $this->post = $post;

        $this->is_media = $this->isMedia();
        if($this->is_media){
            $this->resolution = getimagesize( $this->files['tmp_name'])[0] . ' x ' . getimagesize( $this->files['tmp_name'])[1];
        }
        $this->size = $this->files['size'];
        $this->password = $this->post['password'];
        $this->once_download = $this->post['once_download'];
    }

    public function validate()
    {
        // validate form in first page
        // validate field with choosing file
        if(!empty($this->files['error'])){
            $this->errors['required'] = 'Choose any file';
        }else{
            foreach ($this->typeOfFile as $type){
                $file_extension = explode('.', $this->files['name']);
                $this->errors['type'] = 'Incorrect type file';
                if($file_extension[count($file_extension) - 1] == $type){
                    $this->extension = $file_extension[count($file_extension) - 1];
                    unset($this->errors['type']);
                    break;
                }
                if($file_extension[count($file_extension) - 2] .'.'. $file_extension[count($file_extension) - 1]  == $type){
                    $this->extension = $file_extension[count($file_extension) - 2] .'.'. $file_extension[count($file_extension) - 1];
                    unset($this->errors['type']);
                    break;
                }

            }
        }
        // validate field with checkbox use password
        if($this->post['use_pass'] && empty($this->password)){
            $this->errors['password'] = 'Password required';
        }
        // validate field with password
        if($this->password && preg_match($this->pattern, $this->password) == 0){
            $this->errors['password'] = 'Password should have at least 8 symbols, at least 1 upper case, at least 1 lowercase';
        }

        if(empty($this->errors)){
            return true;
        }else{
            return $this->errors;
        }
    }

    private function saveFile()
    {
        $this->original_name = $this->files['name'];
        $fileName =  uniqid(rand(), 0);
        $uploadFile = $this->uploadPath . $fileName . '-' . $this->original_name;
        // Копируем файл из каталога для временного хранения файлов:
        if (copy($this->files['tmp_name'], __DIR__ . $uploadFile)){
            $this->file_path = $uploadFile;
            $this->file_name = $fileName;
            return true;
        };
    }

    public function save()
    {
        $this->saveFile();
        $pdo = DB::getInstance()->PDO();

        $pass = $this->password ? crypt($this->password) : null;

        $result = $pdo->prepare("INSERT INTO files (file_name, file_path, password, extension, size,
            resolution, is_media, once_download, original_name, available) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $result->execute([$this->file_name, $this->file_path, $pass, $this->extension, $this->size,
            $this->resolution, $this->is_media, $this->once_download, $this->original_name, $this->available]);

        return $result;
    }

    public static function file($f_name)
    {
        $pdo = DB::getInstance()->PDO();
        $result = $pdo->prepare("SELECT * FROM files WHERE file_name = ?");
        $result->execute([$f_name]);
        $myRow = [];
        while($row = $result->fetch(\PDO::FETCH_ASSOC)){
            $myRow = $row;
        };
        return $myRow;
    }

    public static function notAvailable($id)
    {
        $pdo = DB::getInstance()->PDO();
        $result = $pdo->prepare("UPDATE files SET available = 0 WHERE id = ?");
        return $result->execute([$id]);
    }

    private function isMedia()
    {
        return strripos($this->files['type'], 'image') === false ? 0 : 1;
    }

    public function getFileName()
    {
        return $this->file_name;
    }
}