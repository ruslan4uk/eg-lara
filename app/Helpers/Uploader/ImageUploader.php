<?php

namespace App\Helpers\Uploader;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploader
{
    /**
     * @var string
     */
    protected $path;
    /**
     * @var array
     */
    protected $file;
    /**
     * @var bool
     */
    protected $errors;
    /**
     * @var string
     */
    protected $fileName;

    /**
     * ImageUploader constructor.
     * @param $path
     * @param $file
     * @param bool $errors
     */
    public function __construct($path, $file, $errors = true)
    {
        $this->path = $path;
        $this->file = $file;
        $this->errors = $errors;

        $this->fileName = $this->getFilename();
    }

    /**
     * В зависимости от типа выбирвем функцию
     * @param $type
     * @return bool
     */
    public function apply($type)
    {
        if(method_exists($this, $type))
        {
            return $this->$type();
        }
        return $this->errors ? $this->returnErrors() : false;
    }


    /**
     * Загрузка аватара
     * @return mixed
     */
    public function avatar()
    {
        // Создаем изображение из реквеста
        $image = Image::make($this->file)
            ->fit(320, 320)
            ->encode('jpg', 90);

        // Сохраняем изображение на AWS S3
        Storage::disk('s3')->put($this->path .  $this->fileName . '.jpg', $image);

        // Получаем и возвращаем путь до изображения
        return Storage::disk('s3')->url($this->path . $this->fileName . '.jpg', $image);
    }

    /**
     * Загрузка оригинала и кропа
     * @return array
     */
    public function originalAndCrop()
    {
        $image = Image::make($this->file)
            ->resize(1200, null, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg', 90);

        $crop = Image::make($this->file)->fit(320, 320)->encode('jpg', 90);

        Storage::disk('s3')->put($this->path .  $this->fileName . '.jpg', $image);
        Storage::disk('s3')->put($this->path .  $this->fileName . '_crop.jpg', $crop);

        return [
            'image' => Storage::disk('s3')->url($this->path .  $this->fileName . '.jpg', $image),
            'image_crop' => Storage::disk('s3')->url($this->path .  $this->fileName . '_crop.jpg', $crop)
        ];

    }

    /**
     * Создаем уникальное имя
     * @return string
     */
    public function getFilename()
    {
        return \Illuminate\Support\Str::random(16);
    }

    /**
     * Возвращем ошибку если надо
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnErrors()
    {
        return response()->json([
            'errors' => [
                'uploader' => 'Ошибка сервера'
            ]
        ], 422);
    }
}
