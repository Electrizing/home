<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTemporaryName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    $fileExtension = explode('.', $fileName);
    $fileActualExtension = strtolower(end($fileExtension));
    
    $allowed = array('jpg', 'jpeg', 'mp4', 'pdf', 'gif', 'png', 'doc', 'docx', 'tiff', 'mp3', 'wav', 'txt', 'obj', 'm4a', 'blend', 'rbxl', 'mkv', 'wmv', );
    
    if (in_array($fileActualExtension, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000) {
                $newFileName = uniqid('', true).".".$fileActualExtension;
                
                $fileDestination = 'files/'.$newFileName;
                
                move_uploaded_file($fileTemporaryName, $fileDestination);
                
                header("Location: ".$fileDestination);
            } else {
                echo "Sorry, max file size is 10mb.";
            }
        } else {
            echo "File error detected.";
        }
    } else {
          echo "Sorry, that file type isn't allowed.";
    }
}
