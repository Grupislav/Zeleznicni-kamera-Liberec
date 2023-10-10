<?php
    
$dir = "../../../SotoKamera";
    
foreach (scandir($dir,0) as $day) {
if ($day == "." || $day == ".." || $day == "DVRWorkDirectory") {continue;}
$datumslozky=strtotime($day);
if ($datumslozky < (time()-365*24*60*60)) {
					foreach (scandir($dir . '/' . $day . '/001/' . 'jpg',0) as $hour) {
                            if ($hour == "." || $hour == "..") {continue;}
                                foreach (scandir($dir . '/' . $day . '/001/' . 'jpg/' . $hour,0) as $minute) {
                                if ($minute == "." || $minute == "..") {continue;}
                                    foreach (scandir($dir . '/' . $day . '/001/' . 'jpg/' . $hour . '/' . $minute,0) as $file) {
                                    if ($file == "." || $file == ".." || strpos($file,"_thumb")!=0) {continue;}
                                    $pathToImage = $dir . '/' . $day . '/001/' . 'jpg/' . $hour . '/' . $minute . '/' . $file;

                                    if(unlink($pathToImage)) echo($pathToImage . " uspesne smazan<br>");

                                    }
                                }
                    }
}	
else break;
}

?>