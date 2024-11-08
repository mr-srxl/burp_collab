<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
// Function to delete a directory and its contents
function deleteDirectory($dir) {
    // Check if the directory exists
    if (!is_dir($dir)) {
        echo "Directory '{$dir}' does not exist.\n";
        return;
    }
 // Scan the directory and get all files and subdirectories
    $items = scandir($dir);
    foreach ($items as $item) {
        // Skip the current and parent directory entries
        if ($item === '.' || $item === '..') {
            continue;
        }

        // Full path of the item
        $itemPath = $dir . DIRECTORY_SEPARATOR . $item;

        // Recursively delete if it's a directory, otherwise delete the file
        if (is_dir($itemPath)) {
            deleteDirectory($itemPath);
        } else {
            unlink($itemPath); // Delete the file
            echo "Deleted file: {$itemPath}\n";
        }
    }

    // Finally, remove the directory itseld
    rmdir($dir);
    echo "Deleted directory: {$dir}\n";
}

// Read the file 'dir.txt'
$filename = 'dir.txt';
if (!file_exists($filename)) {
    die("The file '{$filename}' does not exist.\n");
}

$handle = fopen($filename, 'r');
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // Trim whitespace and new line characters
        $dirName = trim($line);
        if (!empty($dirName)) {
            deleteDirectory($dirName);
        }
    }
    fclose($handle);
} else {
    die("Error opening the file '{$filename}'.\n");
}
unlink('dir.txt');
?>