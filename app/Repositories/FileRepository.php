<?php namespace App\Repositories;

use App\Exceptions\ValidationException;
use App\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Repositories
 */
class FileRepository
{

    protected $model;

    public function __construct(File $file)
    {
        $this->model = $file;
    }

    /**
     * @param $id
     * @param array $attributes
     * @return \App\File
     */
    public function findById($id, $attributes = ['*'])
    {
        return $this->model->find($id, $attributes);
    }

    /**
     * @param $name
     * @return mixed|\App\File
     */
    public function findByDiskName($name)
    {
        return $this->model->whereDiskName($name)->first();
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return File|string
     * @throws ValidationException
     * @throws \Exception
     */
    public function upload(UploadedFile $uploadedFile)
    {
        $isImage = in_array($uploadedFile->getClientOriginalExtension(), ['jpg', 'jpeg', 'bmp', 'png', 'gif', 'svg']);

        $validationRules = ['max:' . $this->model->getMaxFilesize()];
        if ($isImage) {
            $validationRules[] = 'mimes:jpg,jpeg,bmp,png,gif,svg';
        }

        $validation = \Validator::make(
            ['file_data' => $uploadedFile],
            ['file_data' => $validationRules]
        );

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        if (!$uploadedFile->isValid()) {
            throw new \Exception('File is not valid');
        }

        $file = $this->model->newInstance();
        $file->data = $uploadedFile;
        $file->is_public = true;
        $file->save();

        $file->thumb = $file->getThumb(150, 150);
        return $file;
    }


}