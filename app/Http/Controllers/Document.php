<?php

namespace App\Http\Controllers;

use App\Factories\Document\DocumentDocxFactory;
use App\Factories\Document\DocumentPdfFactory;
use App\Factories\Document\DocumentZipFactory;
use App\Helpers\TextHelper;

/*
 * @mixin \Eloquent
 * */
class Document extends Controller
{

    const FILES = [
        'pdf',
        'docx'
    ];

    public function download($titleId, $type)
    {
        $items = TextHelper::getOneTextArrayByTitleId($titleId);

        switch ($type) {
            case 'pdf':
                $document = new DocumentPdfFactory();
                break;
            case 'docx':
                $document = new DocumentDocxFactory();
                break;
            case 'zip':
                $document = new DocumentZipFactory($items);
                return $document->create(self::FILES)->downloadZip();
            default:
                return;
        }

        return $document->createDocument()->create($items)->downloadZip();
    }
}
