<?php


namespace App\Factories\Document;


use App\Interfaces\DocumentInterfaces\DocumentInterface;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class DocxFile implements DocumentInterface
{

    public function create(array $items)
    {
        $html = view('text.view', [
            'items' => $items
        ])->render();
        $html = str_replace('<br>', '<br/>', $html);
        $world = new PhpWord();
        $section = $world->addSection();
        Html::addHtml($section, $html,false);
        if (!\File::isDirectory(storage_path('documents'))) {
            \File::makeDirectory(storage_path('documents'));
        }
        $world->save(storage_path('documents/docx.docx'), "Word2007");
        return $this;
    }

    public function downloadZip(): BinaryFileResponse
    {
        $zip = new ZipArchive();
        $zip->open(storage_path('documents/texts.zip'), ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile(storage_path('documents/docx.docx'), 'docx.docx');
        $zip->close();

        return response()->download(storage_path('documents/texts.zip'));
    }
}
