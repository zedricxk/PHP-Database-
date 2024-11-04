<?php

$filename = 'Geryme.txt';


if (file_exists($filename)) {
    $content = file_get_contents($filename);
    echo "File Content (using file_get_contents): <br>";
    echo nl2br($content);
    
   
    echo "<br><br>File Content (using file):<br>";
    $lines = file($filename); 
    foreach ($lines as $line) {
        echo htmlspecialchars($line) . "<br>"; 
    }
} else {
    
    echo "File not found.";
}

?>
