<?php

$fileList = glob('./192.168.100.*');
foreach($fileList as $filename){
        if(is_file($filename)){
                echo '<b>', $filename, ':</b>';
                $lines = fopen($filename,'r');
                while ($line = fgets($lines)) {
                        echo($line);
                }
        fclose($fh);
        echo '<br>';
    }
}

?>
