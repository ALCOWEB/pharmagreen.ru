<?php
namespace shop\entities\behaviors;

use yiidreamteam\upload\ImageUploadBehavior;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yiidreamteam\upload\exceptions\FileUploadException;

class CustomImageUploadBehavior extends ImageUploadBehavior
{
    public $deleteTempFile;


    public function afterSave()
    {
        if ($this->file instanceof UploadedFile !== true) {
            return;
        }

        $path = $this->getUploadedFilePath($this->attribute);

        FileHelper::createDirectory(pathinfo($path, PATHINFO_DIRNAME), 0775, true);

        if (!$this->file->saveAs($path, $this->deleteTempFile)) {
            throw new FileUploadException($this->file->error, 'File saving error.');
        }

        $this->owner->trigger(static::EVENT_AFTER_FILE_SAVE);
    }
}