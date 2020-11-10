<?php
namespace shop\forms\manage\User;
use yii\base\Model;
use yii\web\UploadedFile;
class UserPhotoForm extends Model
{

    public $file;
    public function rules(): array
    {
        return [
            ['file', 'each', 'rule' => ['image']],
        ];
    }
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->file = UploadedFile::getInstances($this, 'file');
            return true;
        }
        return false;
    }
}