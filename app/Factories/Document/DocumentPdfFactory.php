<?php


namespace App\Factories\Document;


use App\Interfaces\DocumentInterfaces\DocumentCreateInterface;
use App\Interfaces\DocumentInterfaces\DocumentInterface;
use JetBrains\PhpStorm\Pure;

class DocumentPdfFactory implements DocumentCreateInterface
{

    #[Pure] public static function createDocument(): DocumentInterface
    {
        return new PdfFile();
    }
}
