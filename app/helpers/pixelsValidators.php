<?php


function validateNumericValue($inputPixel)
{
    return is_numeric($inputPixel);
}


function inputNotEmpty($inputField)
{
    return $inputField !== '';

}

function validatePixelCoordinates($postData, $allPixels, $currentPix = null)
{
    $inputPixelX = (int)$postData['x'];
    $inputPixelY = (int)$postData['y'];
    $inputPixelSize = (int)$postData['size'];

    foreach ($allPixels as $pixel) {
        if ($pixel->pixelId !== $currentPix) {
            $dbPixelX = $pixel->coordinateX;
            $dbPixelY = $pixel->coordinateY;
            $dbPixelSize = $pixel->size;

            if (($inputPixelX + $inputPixelSize > $dbPixelX && $inputPixelX < $dbPixelX + $dbPixelSize) && ($inputPixelY + $inputPixelSize > $dbPixelY && $inputPixelY < $dbPixelY + $dbPixelSize)) {
                return false;
            }

        } else {
            continue;
        }
    }
    return true;
}
