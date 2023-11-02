<?php


namespace App\Interfaces\DocumentInterfaces;


use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface DocumentInterface
{
    public function create(array $items);
    public function downloadZip(): BinaryFileResponse;
}
