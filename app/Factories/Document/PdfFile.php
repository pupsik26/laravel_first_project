<?php


namespace App\Factories\Document;


use App\Interfaces\DocumentInterfaces\DocumentInterface;
use ZipArchive;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PdfFile implements DocumentInterface
{

    public function create(array $items)
    {
        \PDF::loadView('text.view', ['items' => $items])
            ->save('pdf.pdf', 'documents');
        return $this;
    }

    /* @todo вообще можно в трейт вынести */
    public function downloadZip(): BinaryFileResponse
    {
        $zip = new ZipArchive();
        $zip->open(storage_path('documents/texts.zip'), ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile(storage_path('documents/pdf.pdf'), 'pdf.pdf');
        $zip->close();

        return response()->download(storage_path('documents/texts.zip'));
    }
}
