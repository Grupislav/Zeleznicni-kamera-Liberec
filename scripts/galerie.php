<?php
// formular pro den
echo "<form method='GET' action='https://tomaskrupicka.cz/kamera-liberec-pilinkov/#historie'>
          <fieldset>
          <legend>{$lang['zobrazitden']}</legend>
          <input type='hidden' name='ja' value='{$_GET['ja']}'>
          <input type='hidden' name='typ' value='0'>
          <p>
            <label for='den'>{$lang['den']}:</label> <input type='text' name='den' id='den' value='{$_GET['den']}'>
            <input type='submit' class='submit' name='odeslani' value='{$lang['zobrazit']}'>
          </p>
          </fieldset>
      </form>";
    
    $dir = "../../SotoKamera";
    if(isset($_GET['odeslani']) && $_GET['typ'] == 0) {$day = $_GET['den']; $razeni=0;}
    else {$day = date("Y-m-d",time()); $razeni=1;}  

    if (!file_exists($dir . '/' . $day)) {echo "<span class='font25 zelena'>{$lang['chybavyberdata']}</span> 
                                                <br><br> 1. Pokud jde o dnešek, ještě na trati nic neprojelo, nebo je kamera offline.<br>2. Pokud jde o den z minulosti, buď byla úplná výluka, nebo byla kamera mimo provoz (například září 2019 nebo červen 2020).<br>3. Může se jednat o chybu. Máte-li to podezření, dejte mi prosím vědět.";}
    else
    {
    $images = getImages($dir,$day,$razeni);
    foreach ($images as $day => $hourMinutePairs)
    {
        echo "<span class='font25 zelena'>" . formatDnu($day) . " </span>";
        foreach ($hourMinutePairs as $hour => $minuteImagePair)
        {
			echo "<h4> {$hour}:00 </h4>";
            foreach ($minuteImagePair as $minute => $imagePair)
            {
                foreach ($imagePair as $image)
                {
					$label = $day ."-". $hour . ":" . $minute;
          $desc = $hour . ":" . $minute;
          $link =  str_replace("_thumb","",$image);
                echo "<div class='gallery'><a href='".$link."'><img src=".$image." alt=".$label." title=".$label."></a><div class='desc'>".$desc."</div></div>";
				        }
            }
        }

    }
    }
    
    function getImages($dir,$day,$razeni)
    {
		$images = [];
			foreach (getFiles($dir . '/' . $day,0) as $number) {
				foreach (getFiles($dir . '/' . $day . '/' . $number,0) as $type) {
					foreach (getFiles($dir . '/' . $day . '/' . $number . '/' . $type,$razeni) as $hour) {
						foreach (getFiles($dir . '/' . $day . '/' . $number. '/' . $type. '/' . $hour,0) as $minute) {
							foreach (getFiles($dir . '/' . $day . '/' . $number. '/' . $type. '/' . $hour . '/' . $minute,0) as $image) {
                            
								$pathToImage = $dir . '/' . $day . '/' . $number. '/' . $type. '/' . $hour . '/' . $minute . '/' . $image;                
								$pathToImage = str_replace("../..","/domains",$pathToImage);
                
                if(!strpos($pathToImage,"_thumb")) {                
                $thumb = str_replace(".jpg","_thumb.jpg",$pathToImage);
                                               
                if(!file_exists('../../..' . $thumb)) {
                createThumbnail('../../..' . $pathToImage,'../../..' . $thumb,250);
                                                
								$images[$day][$hour][$minute][] =  $thumb;}}                
                else $images[$day][$hour][$minute][] =  $pathToImage;
							}
						}
					}
				}
			}

		return $images;
	} 
  
     function getFiles($dir, $sort)
    {
        $files = [];    
		foreach (scandir($dir, $sort) as $file) {
			if ($file == "." || $file == ".." || $file == "DVRWorkDirectory") {continue;}
			
      $files[] = $file;
		}

		return $files;
    }

?>