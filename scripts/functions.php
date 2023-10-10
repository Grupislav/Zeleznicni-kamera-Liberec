<?php
/**
 * formatData() vrací datum a čas
 * @param $datum
 * @return string
 */

function formatData($datum)
{

    if(substr($datum, 8, 1) == 0)
    {
        $den = substr($datum, 9, 1);
    }
    else
    {
        $den = substr($datum, 8, 2);
    }
    if(substr($datum, 5, 1) == 0)
    {
        $mesic = substr($datum, 6, 1);
    }
    else
    {
        $mesic = substr($datum, 5, 2);
    }

    return $den . "." . $mesic . "." . substr($datum, 0, 4) . " " . substr($datum, 11, 2) . ":" . substr($datum, 14, 2);
} 

/**
 * formatDnu() vrací datum
 * @param $datum
 * @return string
 */

function formatDnu($datum)
{
    if(substr($datum, 8, 1) == 0)
    {
        $den = substr($datum, 9, 1);
    }
    else
    {
        $den = substr($datum, 8, 2);
    }
    if(substr($datum, 5, 1) == 0)
    {
        $mesic = substr($datum, 6, 1);
    }
    else
    {
        $mesic = substr($datum, 5, 2);
    }

    return $den . ". " . $mesic . ". " . substr($datum, 0, 4);
}

/**
 * jeVikend() - podle date urci typ dne
 * @param date $datum
 * @return int
 */

function jeVikend($datum)
{
    $denVTydnu = date("N", mktime(0, 0, 0, substr($datum, 5, 2), substr($datum, 8, 2), substr($datum, 0, 4)));
    if($denVTydnu == 6 OR $denVTydnu == 7)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

/**
 * @param $jazyky
 * @param $vybranyJazyk
 * @return string
 */

function menuJazyky($jazyky, $vybranyJazyk)
{
    $menu = "<li><a href='#'>" . strtoupper($vybranyJazyk) . "</a>";
    $menu .= "<ul class='jazyk'>";

    foreach($jazyky as $jazyk)
    {

        if($jazyk != $vybranyJazyk)
        {
            $menu .= "<li><a href='{$_SERVER['PHP_SELF']}?ja={$jazyk}'>" . strtoupper($jazyk) . "</a></li>";
        }

    }

    $menu .= "</ul></li>";

    return $menu;
}

function curl_get_file_contents($URL)
{
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
            else return FALSE;
 }
 
/**
 * @param $src - a valid file location
 * @param $dest - a valid file target
 * @param $targetWidth - desired output width
 * @param $targetHeight - desired output height or null
 */

function createThumbnail($src, $dest, $targetWidth, $targetHeight = null) {

    // 1. Load the image from the given $src
    // - see if the file actually exists
    // - check if it's of a valid image type
    // - load the image resource
    
    // load the image with the correct loader
    ini_set("gd.jpeg_ignore_warning", 1);
    error_reporting(E_ALL & ~E_NOTICE);
    $image = imagecreatefromjpeg($src);

    // no image found at supplied location -> exit
    if (!$image) {
        return null;
    } 

    // 2. Create a thumbnail and resize the loaded $image
    // - get the image dimensions
    // - define the output size appropriately
    // - create a thumbnail based on that size
    // - set alpha transparency for GIFs and PNGs
    // - draw the final thumbnail

    // get original image width and height
    $width = imagesx($image);
    $height = imagesy($image);

    // maintain aspect ratio when no height set
    if ($targetHeight == null) {

        // get width to height ratio
        $ratio = $width / $height;

        // if is portrait
        // use ratio to scale height to fit in square
        if ($width > $height) {
            $targetHeight = floor($targetWidth / $ratio);
        }

        // if is landscape
        // use ratio to scale width to fit in square
        else {
            $targetHeight = $targetWidth;
            $targetWidth = floor($targetWidth * $ratio);
        }
    }

    // create duplicate image based on calculated target size
    $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

    // set transparency options for GIFs and PNGs
    if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {

        // make image transparent
        imagecolortransparent(
            $thumbnail,
            imagecolorallocate($thumbnail, 0, 0, 0)
        );

        // additional settings for PNGs
        if ($type == IMAGETYPE_PNG) {
            imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true);
        }
    }

    // copy entire source image to duplicate image and resize
    imagecopyresampled(
        $thumbnail,
        $image,
        0, 0, 0, 0,
        $targetWidth, $targetHeight,
        $width, $height
    );

    // 3. Save the $thumbnail to disk
    // - call the correct save method
    // - set the correct quality level

    // save the duplicate version of the image to disk
    imagejpeg($thumbnail,$dest);    
}