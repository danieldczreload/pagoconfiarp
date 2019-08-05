<?php

require "Image.php";

/**
 * Class for rendering the barcode as image
 */
class Zend_Barcode_Renderer_Base64 extends Zend_Barcode_Renderer_Image
{

    /**
     * Draw and render the barcode with correct headers
     *
     * @return mixed
     */
    public function render()
    {
        $this->render();

        ob_start();
        /**
         * fazendo o crop da imagem para que seja removido os números abaixo do
         * código de barras
         */
        $width = imagesx($this->resource);
        
        $cropped = imagecreatetruecolor($width, 52);
        imagecopyresampled($cropped, $this->resource, 0, 0, 0, 0, $width, 52, $width, 52);
        
        $functionName = 'image' . $this->imageType;
        $functionName($cropped);
        $contents = ob_get_contents();
        ob_end_clean();

        return 'data:image/' . $this->imageType . ';base64,' . base64_encode($contents);
        
        imagedestroy($this->resource);
        imagedestroy($cropped);
        
    }

}
