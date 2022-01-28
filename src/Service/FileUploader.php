<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Spatie\Dropbox\Client;

class FileUploader
{
    private $targetDirectory;
    private $accessToken;
    private $slugger;

    public function __construct($targetDirectory, $accessToken, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->accessToken = $accessToken;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $date = new \DateTime();
            $file->move($this->getTargetDirectory().$date->format('Y-m-d'), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function uploadOnDropbox(UploadedFile $file)
    {
        $client = new Client($this->accessToken);
        $date = new \DateTime();
        $id = uniqid().'.'.$file->guessExtension();
        $fileName = '/'.$date->format('Y-m-d').'/'.$id;
        $fileData = file_get_contents($file);
        $client->upload($fileName, $fileData);
        $link = $client->getTemporaryLink($fileName);

        return [
            'link' => $link,
            'id' => $id
        ];
    }

    public function deleteOnDropbox(string $path)
    {
        $client = new Client($this->accessToken);
        $client->delete($path);
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}