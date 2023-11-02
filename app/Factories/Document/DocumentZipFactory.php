<?php


namespace App\Factories\Document;


use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

final class DocumentZipFactory
{
    const DOCX_EXTENSION_FILE = 'docx';
    const PDF_EXTENSION_FILE = 'pdf';

    const DOCX_FILE_NAME = 'docx.docx';
    const PDF_FILE_NAME = 'pdf.pdf';

    const LIST_FILE_NAME = [
        self::DOCX_EXTENSION_FILE => self::DOCX_FILE_NAME,
        self::PDF_EXTENSION_FILE => self::PDF_FILE_NAME
    ];

    public function __construct($items)
    {
        (new DocumentPdfFactory())->createDocument()->create($items);
        (new DocumentDocxFactory())->createDocument()->create($items);
    }

    public function create(array $files)
    {
        $zip = new ZipArchive();
        $zip->open(storage_path('documents/texts.zip'), ZipArchive::CREATE | ZipArchive::OVERWRITE);
        foreach ($files as $item) {
            $zip->addFile(storage_path("documents/" . self::LIST_FILE_NAME[$item]), self::LIST_FILE_NAME[$item]);
        }
        $zip->close();
        return $this;
    }

    public function downloadZip(): BinaryFileResponse
    {
        return response()->download(storage_path('documents/texts.zip'));
    }
}
