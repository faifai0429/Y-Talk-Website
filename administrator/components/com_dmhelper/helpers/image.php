<?php

    /**
     * Helper library for image manipulation (require PHP GD)
     *
     * @copyright		(C)2013 DM Digital S.r.l
     * @author 			DM Digital <support@dmjoomlaextensions.com>
     * @link			http://www.dmjoomlaextensions.com
     * @license 		GNU/LGPL http://www.gnu.org/copyleft/gpl.html
     **/

    defined('_JEXEC') or die('Restricted access');

    class DMImg {

        /**
         * It creates a resized version of the source image (full path / URL)
         * If $pImgTargetDir is empty it returns the image source,
         * in the other side it saves the image in the given directory (full path)
         *
         * @param String $pSourceLocation
         * @param String $pImgTargetDir Full path with file name and extension. If empty it will return the image source instead of success state
         * @param Int $pImgTargetW The required width, set this OR the height, the image will be scaled according to the aspect ratio
         * @param Int $pImgTargetH The required height, set this OR the width, the image will be scaled according to the aspect ratio
         * @return Resource / Boolean
         */
        public static function resizeTo($pSourceLocation, $pImgTargetDir, $pImgTargetW = 0, $pImgTargetH = 0) {

            if (!empty($pSourceLocation) && !empty($pImgTargetDir)) {

                $mySource = self::imgCreateFromFile($pSourceLocation);
                $mySourceW  = imagesx($mySource);
                $mySourceH = imagesy($mySource);

                //get the remaining dimension to maintain the aspect ratio
                if ($pImgTargetW > 0) {
                    $myImgWidth = $pImgTargetW;
                    $myImgHeight = ($pImgTargetW * $mySourceH) / $mySourceW;
                } else {
                    $myImgWidth = ($pImgTargetH * $mySourceW) / $mySourceH;
                    $myImgHeight = $pImgTargetH;
                }

                //create new resized image
                $myImg = imagecreatetruecolor($myImgWidth, $myImgHeight);

                //make it transparent
                imagecolortransparent($myImg, imagecolorallocatealpha($myImg, 0, 0, 0, 127));
                imagealphablending($myImg, false);
                imagesavealpha($myImg, true);

                //copy the source image in the new one scaling to the new size
                imagecopyresampled($myImg, $mySource, 0, 0, 0, 0, $myImgWidth, $myImgHeight, $mySourceW, $mySourceH);

                //save or return the resized image
                if (!empty($pImgTargetDir)) {
                    return self::imgSaveToFile($myImg, $pImgTargetDir);
                } else {
                    return $myImg;
                }
            } else {
                return false;
            }
        }

        /**
         * Returns an image identifier representing the image obtained from the given filename
         * It can be both a local or remote file (url)
         *
         * @param String $pFilename
         * @return Resource
         */
        public static function imgCreateFromFile($pFilename) {

            switch (strtolower(pathinfo($pFilename, PATHINFO_EXTENSION))) {
                case 'jpeg':
                case 'jpg':
                    return imagecreatefromjpeg($pFilename);
                    break;

                case 'png':
                    return imagecreatefrompng($pFilename);
                    break;

                case 'gif':
                    return imagecreatefromgif($pFilename);
                    break;
            }
        }

        /**
         * Saves the resource image in the given directory
         *
         * @param Resource $pImgResource
         * @param String $pImgTargetDir
         * @return Boolean
         */
        public static function imgSaveToFile($pImgResource, $pImgTargetDir) {

            switch (strtolower(pathinfo($pImgTargetDir, PATHINFO_EXTENSION))) {
                case 'jpeg':
                case 'jpg':
                    return imagejpeg($pImgResource, $pImgTargetDir);
                    break;

                case 'png':
                    return imagepng($pImgResource, $pImgTargetDir);
                    break;

                case 'gif':
                    return imagegif($pImgResource, $pImgTargetDir);
                    break;
            }
        }

    }

?>