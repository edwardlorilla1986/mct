<?php 

namespace App\Classes;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGeneratorClass {

    public function get_data($text, $image_size, $logo_size, $logo_url)
    {
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create( $text )
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize($image_size)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        if ( !empty($logo_size) && !empty($logo_url) ) {

                // Create generic logo
                $logo = Logo::create( $logo_url )->setResizeToWidth($logo_size);

                $result = $writer->write($qrCode, $logo);

        } else $result = $writer->write($qrCode);

        header('Content-Type: '.$result->getMimeType());

        $result->saveToFile( storage_path('app/livewire-tmp/') . time() . '.png' );

        $data['thumbnail'] = $result->getDataUri();

        return $data;

    }
}