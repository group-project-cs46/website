<?php

namespace Core;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Label\Label;

use Models\Qrcode as QrModel;

class Qr
{
    public static function generate($data)
    {
        $writer = new PngWriter();
        $targetDir = base_path('storage/');

        $qrCode = new QrCode(
            data: $data,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255)
        );

        $result = $writer->write($qrCode);


        // Save the QR code to a file
        $fileName = md5(time() . uniqid()) . '.png';
        $filePath = $targetDir . $fileName;

        $result->saveToFile($filePath);
        return QrModel::create(
            $data,
            $fileName
        );
    }
}