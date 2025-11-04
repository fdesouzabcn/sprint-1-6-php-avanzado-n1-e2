<?php
declare(strict_types=1);
session_start();


class PhotoUploader 
{
    private string $uploadDir;
    private array $magicConstants = [];

    // Constructor - Setup upload directory
    public function __construct() 
    {   
        // Store magic constants
        $this->magicConstants['class'] = __CLASS__;
        $this->magicConstants['method'] = __METHOD__;
        $this->magicConstants['function'] = __FUNCTION__;
        $this->magicConstants['file'] = __FILE__;
        $this->magicConstants['dir'] = __DIR__;
        
        // Set upload directory using __DIR__ magic constant
        $this->uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        
        // Create directory if it doesn't exist
        $this->createDirectory();
    }

    //Method to create "uploads" directory
    private function createDirectory(): void 
    {
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }
    // Upload a photo file
    public function upload(array $file): array {
        $fileName = basename($file['name']);
        $targetPath = $this->uploadDir . $fileName;
        
        $result = [
            'success' => false,
            'message' => '',
            'fileName' => $fileName,
            'path' => $targetPath,
            'method' => __METHOD__
        ];
        
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $result['success'] = true;
            $result['message'] = 'Photo uploaded successfully!';
        } else {
            $result['message'] = 'Upload failed!';
        }
        return $result;
    }
    // Get magic constants information
    public function getMagicConstants(): array {
        return $this->magicConstants;
    }
}

// Create UPLOADER Instance
$uploader = new PhotoUploader();

// Handle UPLOAD (Display)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    
    $result = $uploader->upload($_FILES['photo']);

    if ($result['success']) {
        echo "<h4>✅ {$result['message']}</h4>";          
        } else {
        echo "❌ {$result['message']}";
        }
        
} else {
    echo "<h4>❌ No file was uploaded. Please go back to <a href='index_upload.php'>upload page </a> and try again.</h4>";
}

?>





