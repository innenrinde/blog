<?php

/**
 * Class Uploader
 */
class Uploader {

    /**
     * @var array
     */
    public $allowedExtensions = array();

    /**
     * @var null
     */
    public $sizeLimit = null;

    /**
     * @var string
     */
    public $inputName = 'qqfile';

    /**
     * @var string
     */
    public $chunksFolder = 'chunks';

    /**
     * @var float
     */
    public $chunksCleanupProbability = 0.001; // Once in 1000 requests on avg

    /**
     * @var int
     */
    public $chunksExpireIn = 604800; // One week

    /**
     * @var string
     */
    protected $uploadFolder = '';

    /**
     * @var string
     */
    protected $originalFolder = 'original';

    /**
     * @var string
     */
    protected $mediuFolder = 'mediu';

    /**
     * @var string
     */
    protected $thumbFolder = 'thumb';

    /**
     * @var null
     */
    protected $model = null;

    /**
     * @var
     */
    protected $uploadName;

    /**
     * @var
     */
    protected $uploadThumbName;

    /**
     * @var array
     */
    protected $size = [
        'original' => [
            'width' => 0,
            'height' => 0
        ],
        'mediu' => [
            'width' => 0,
            'height' => 0
        ]
    ];

    /**
     * Uploader constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->model = $params['model'];
        $this->uploadFolder = $params['folder'];
        $this->chunksFolder = $params['chunk'];
    }

    /**
     * @return array
     */
    public function upload($post)
    {
        // Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $this->allowedExtensions = array(); // all files types allowed by default

        // Specify max file size in bytes.
        $this->sizeLimit = null;

        // Specify the input name set in the javascript.
        $this->inputName = "qqfile"; // matches Fine Uploader's default inputName value by default

        // If you want to use the chunking/resume feature, specify the folder to temporarily save parts.
        $method = $this->get_request_method();

        if ($post) {
            header("Content-Type: text/plain");
            if (isset($_GET["done"])) {
                $result = $this->combineChunks();
            }
            else {
                $result = $this->handleUpload();
            }
            $result["uploadName"] = $this->getUploadName();
            $result["uploadThumbName"] = $this->getUploadThumbName();

            if($result["uploadName"] !== null) {
                $this->model->insert_image(0, $this->getUploadName(), $this->getUploadThumbName(),$this->size);
            }

            return $result;
        }
        // for delete file requests
        else if ($method == "DELETE") {
            return $this->handleDelete();
        }
        else {
            header("HTTP/1.0 405 Method Not Allowed");
        }
        return [];
    }

    /**
     * @return mixed
     */
    function get_request_method() {
        global $HTTP_RAW_POST_DATA;
        if(isset($HTTP_RAW_POST_DATA)) {
            parse_str($HTTP_RAW_POST_DATA, $_POST);
        }
        if (isset($_POST["_method"]) && $_POST["_method"] != null) {
            return $_POST["_method"];
        }
        return $_SERVER["REQUEST_METHOD"];
    }

    /**
     * Get the original filename
     */
    public function getName()
    {
        $name = '';
        if (isset($_REQUEST['qqfilename'])) {
            $name = $_REQUEST['qqfilename'];
        }

        if (isset($_FILES[$this->inputName])) {
            $name = $_FILES[$this->inputName]['name'];
        }

        return uniqid().'-'.$name;
    }

    /**
     * @return array
     */
    public function getInitialFiles()
    {
        $initialFiles = array();

        for ($i = 0; $i < 5000; $i++) {
            array_push($initialFiles, array("name" => "name" + $i, uuid => "uuid" + $i, thumbnailUrl => "/test/dev/handlers/vendor/fineuploader/php-traditional-server/fu.png"));
        }

        return $initialFiles;
    }

    /**
     * Get the name of the uploaded file
     */
    public function getUploadName()
    {
        return $this->uploadName;
    }

    /**
     * @return mixed
     */
    public function getUploadThumbName()
    {
        return $this->uploadThumbName;
    }

    /**
     * @param null $name
     * @return array
     */
    public function combineChunks($name = null)
    {
        $uuid = $_POST['qquuid'];
        if ($name === null){
            $name = $this->getName();
        }
        $targetFolder = $this->chunksFolder.DIRECTORY_SEPARATOR.$uuid;
        $totalParts = isset($_REQUEST['qqtotalparts']) ? (int)$_REQUEST['qqtotalparts'] : 1;

//        $targetPath = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $uuid, $name));
        $targetPath= join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->originalFolder, $name));

        $this->uploadName = $name;

        if (!file_exists(dirname($targetPath))){
            mkdir(dirname($targetPath), 0777, true);
        }
        $target = fopen($targetPath, 'wb');

        for ($i=0; $i<$totalParts; $i++){
            $chunk = fopen($targetFolder.DIRECTORY_SEPARATOR.$i, "rb");
            stream_copy_to_stream($chunk, $target);
            fclose($chunk);
        }

        $this->processImage($name);

        // Success
        fclose($target);

        for ($i=0; $i<$totalParts; $i++){
            unlink($targetFolder.DIRECTORY_SEPARATOR.$i);
        }

        rmdir($targetFolder);

        if (!is_null($this->sizeLimit) && filesize($targetPath) > $this->sizeLimit) {
            unlink($targetPath);
            http_response_code(413);
            return array("success" => false, "uuid" => $uuid, "preventRetry" => true);
        }

        return array("success" => true, "uuid" => $uuid);
    }

    /**
     * Process the upload.
     *
     * @param null $name
     * @return array
     */
    public function handleUpload($name = null)
    {
        if (is_writable($this->chunksFolder) &&
            1 == mt_rand(1, 1/$this->chunksCleanupProbability)){

            // Run garbage collection
            $this->cleanupChunks();
        }

        // Check that the max upload size specified in class configuration does not
        // exceed size allowed by server config
        if ($this->toBytes(ini_get('post_max_size')) < $this->sizeLimit ||
            $this->toBytes(ini_get('upload_max_filesize')) < $this->sizeLimit){
            $neededRequestSize = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            return array('error'=>"Server error. Increase post_max_size and upload_max_filesize to ".$neededRequestSize);
        }

        if ($this->isInaccessible($this->uploadFolder)){
            return array('error' => "Server error. Uploads directory isn't writable");
        }

        $type = $_SERVER['CONTENT_TYPE'];
        if (isset($_SERVER['HTTP_CONTENT_TYPE'])) {
            $type = $_SERVER['HTTP_CONTENT_TYPE'];
        }

        if(!isset($type)) {
            return array('error' => "No files were uploaded.");
        }
        else if (strpos(strtolower($type), 'multipart/') !== 0){
            return array('error' => "Server error. Not a multipart request. Please set forceMultipart to default value (true).");
        }

        // Get size and name
        $file = $_FILES[$this->inputName];
        $size = $file['size'];
        if (isset($_REQUEST['qqtotalfilesize'])) {
            $size = $_REQUEST['qqtotalfilesize'];
        }

        if ($name === null){
            $name = $this->getName();
        }

        // check file error
        if($file['error']) {
            return array('error' => 'Upload Error #'.$file['error']);
        }

        // Validate name
        if ($name === null || $name === ''){
            return array('error' => 'File name empty.');
        }

        // Validate file size
        if ($size == 0){
            return array('error' => 'File is empty.');
        }

        if (!is_null($this->sizeLimit) && $size > $this->sizeLimit) {
            return array('error' => 'File is too large.', 'preventRetry' => true);
        }

        // Validate file extension
        $pathinfo = pathinfo($name);
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

        if($this->allowedExtensions && !in_array(strtolower($ext), array_map("strtolower", $this->allowedExtensions))){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }

        // Save a chunk
        $totalParts = isset($_REQUEST['qqtotalparts']) ? (int)$_REQUEST['qqtotalparts'] : 1;

        $uuid = $_REQUEST['qquuid'];
        if ($totalParts > 1){
            # chunked upload

            $chunksFolder = $this->chunksFolder;
            $partIndex = (int)$_REQUEST['qqpartindex'];

            if (!is_writable($chunksFolder) && !is_executable($this->uploadFolder)){
                return array('error' => "Server error. Chunks directory isn't writable or executable.");
            }

            $targetFolder = $this->chunksFolder.DIRECTORY_SEPARATOR.$uuid;

            if (!file_exists($targetFolder)){
                mkdir($targetFolder, 0777, true);
            }

            $target = $targetFolder.'/'.$partIndex;
            $success = move_uploaded_file($_FILES[$this->inputName]['tmp_name'], $target);

            return array("success" => true, "uuid" => $uuid);

        }
        else {
            # non-chunked upload

//            $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $uuid, $name));
//            $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $this->uploadFolder, $this->originalFolder, $name));
            $target = join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->originalFolder, $name));

            if ($target){
                $this->uploadName = basename($target);

                if (!is_dir(dirname($target))){
                    mkdir(dirname($target), 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $target)){
                    $this->processImage($name);
                    return array('success'=> true, "uuid" => $uuid);
                }
            }

            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }

    /**
     * Process a delete.
     *
     * @param null $name
     * @return array
     */
    public function handleDelete($name=null)
    {
        if ($this->isInaccessible($this->uploadFolder)) {
            return array('error' => "Server error. Uploads directory isn't writable" . ((!$this->isWindows()) ? " or executable." : "."));
        }

        $targetFolder = $this->uploadFolder;
        $uuid = false;
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method == "DELETE") {
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $tokens = explode('/', $url);
            $uuid = $tokens[sizeof($tokens)-1];
        } else if ($method == "POST") {
            $uuid = $_REQUEST['qquuid'];
        } else {
            return array("success" => false,
                "error" => "Invalid request method! ".$method
            );
        }

        $target = join(DIRECTORY_SEPARATOR, array($targetFolder, $uuid));

        if (is_dir($target)){
            $this->removeDir($target);
            return array("success" => true, "uuid" => $uuid);
        } else {
            return array("success" => false,
                "error" => "File not found! Unable to delete.".$url,
                "path" => $uuid
            );
        }

    }

    /**
     * Returns a path to use with this upload. Check that the name does not exist,
     * and appends a suffix otherwise.
     * @param $uploadDirectory
     * @param $filename
     * @return bool|string
     */
    protected function getUniqueTargetPath($uploadDirectory, $filename)
    {
        // Allow only one process at the time to get a unique file name, otherwise
        // if multiple people would upload a file with the same name at the same time
        // only the latest would be saved.

        if (function_exists('sem_acquire')){
            $lock = sem_get(ftok(__FILE__, 'u'));
            sem_acquire($lock);
        }

        $pathinfo = pathinfo($filename);
        $base = $pathinfo['filename'];
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';
        $ext = $ext == '' ? $ext : '.' . $ext;

        $unique = $base;
        $suffix = 0;

        // Get unique file name for the file, by appending random suffix.

        while (file_exists($this->uploadFolder . DIRECTORY_SEPARATOR . $unique . $ext)){
            $suffix += rand(1, 999);
            $unique = $base.'-'.$suffix;
        }

        $result =  $this->uploadFolder . DIRECTORY_SEPARATOR . $unique . $ext;

        // Create an empty target file
        if (!touch($result)){
            // Failed
            $result = false;
        }

        if (function_exists('sem_acquire')){
            sem_release($lock);
        }

        return $result;
    }

    /**
     * Deletes all file parts in the chunks folder for files uploaded
     * more than chunksExpireIn seconds ago
     */
    protected function cleanupChunks()
    {
        foreach (scandir($this->chunksFolder) as $item){
            if ($item == "." || $item == "..")
                continue;

            $path = $this->chunksFolder.DIRECTORY_SEPARATOR.$item;

            if (!is_dir($path))
                continue;

            if (time() - filemtime($path) > $this->chunksExpireIn){
                $this->removeDir($path);
            }
        }
    }

    /**
     * Removes a directory and all files contained inside
     * @param string $dir
     */
    protected function removeDir($dir)
    {
        foreach (scandir($dir) as $item){
            if ($item == "." || $item == "..")
                continue;

            if (is_dir($item)){
                $this->removeDir($item);
            } else {
                unlink(join(DIRECTORY_SEPARATOR, array($dir, $item)));
            }

        }
        rmdir($dir);
    }

    /**
     * Converts a given size with units to bytes.
     *
     * @param $str
     * @return int|string
     */
    protected function toBytes($str)
    {
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Determines whether a directory can be accessed.
     *
     * is_executable() is not reliable on Windows prior PHP 5.0.0
     *  (http://www.php.net/manual/en/function.is-executable.php)
     * The following tests if the current OS is Windows and if so, merely
     * checks if the folder is writable;
     * otherwise, it checks additionally for executable status (like before).
     *
     * @param string $directory The target directory to test access
     * @return mixed
     */
    protected function isInaccessible($directory)
    {
        $isWin = $this->isWindows();
        $folderInaccessible = ($isWin) ? !is_writable($directory) : ( !is_writable($directory) && !is_executable($directory) );
        return $folderInaccessible;
    }

    /**
     * Determines is the OS is Windows or not
     *
     * @return boolean
     */

    protected function isWindows()
    {
        $isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
        return $isWin;
    }

    /**
     * Create thumb and medium size for an image
     *
     * @param $name
     */
    protected function processImage($name)
    {
        $targetPath= join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->originalFolder, $name));
        $img = getimagesize($targetPath);
        switch ($img[2]) {
            case 1:
                $img = imagecreatefromgif($targetPath);
                break;
            case 2:
                $img = imagecreatefromjpeg($targetPath);
                break;
            case 3:
                $img = imagecreatefrompng($targetPath);
                break;
        }
        $this->uploadThumbName = current(explode('.', $name)) . ".jpg";
        imagejpeg($this->resizeImage($img, 200), join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->thumbFolder, $this->uploadThumbName)));
        imagejpeg($this->resizeImage($img, 600), join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->mediuFolder, $this->uploadThumbName)));
        $this->processImageSize();
    }

    /**
     * Get dimensions for original and mediu image format
     */
    protected function processImageSize()
    {
        $original = getimagesize(join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->originalFolder, $this->uploadName)));
        $mediu = getimagesize(join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->mediuFolder, $this->uploadThumbName)));

        if (count($original) > 2) {
            $this->size = [
                'original' => [
                    'width' => $original[0],
                    'height' => $original[1]
                ],
                'mediu' => [
                    'width' => $mediu[0],
                    'height' => $mediu[1]
                ]
            ];
        }
    }

    /**
     * @param $im
     * @param $img_latime
     * @return resource
     */
    protected function resizeImage($im, $img_latime)
    {
        $rgb_fundal = "";
        $r = 255;
        $g = 255;
        $b = 255;
        if(strlen($rgb_fundal) > 0) {
            $array = explode(",", $rgb_fundal);
            $r = current($array);
            $g = next($array);
            $b = next($array);
        }

        $latime = imagesx($im);
        $inaltime = imagesy($im);
        $img_inaltime = $inaltime*$img_latime/$latime;

        $im_nou = imagecreatetruecolor($img_latime, $img_inaltime);
        $fundal = imagecolorallocate($im_nou, $r, $g, $b);
        imagefilledrectangle($im_nou, 0, 0, $img_latime, $img_inaltime, $fundal);
        imagecopyresampled($im_nou, $im, 0, 0, 0, 0, $img_latime, $img_inaltime, $latime, $inaltime);
        return $im_nou;
    }

    /**
     * @param $id
     */
    public function deleteImage($id)
    {
        $image = current($this->model->get_images(NULL, $id));
        $name = $image['image_name'];
        $thumb_name = $image['thumb_image_name'];
        $this->model->delete_image($id);

        $original = join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->originalFolder, $name));
        $mediu = join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->mediuFolder, $thumb_name));
        $thumb = join(DIRECTORY_SEPARATOR, array($this->uploadFolder, $this->thumbFolder, $thumb_name));

        if(file_exists($original)) {
            unlink($original);
        }
        if(file_exists($mediu)) {
            unlink($mediu);
        }
        if(file_exists($thumb)) {
            unlink($thumb);
        }
    }
}