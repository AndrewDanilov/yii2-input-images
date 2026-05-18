<?php

namespace andrewdanilov\InputImages;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model
{
	/* @var $image UploadedFile */
	public $image;

	public function formName()
	{
		return '';
	}

	public function rules() {
		return[
			[['image'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
		];
	}

	public function upload($path) {
		if ($this->validate()) {
            $fileName = uniqid() . "." . $this->image->extension;
            $filePath = Yii::getAlias(rtrim($path, '/')) . "/" . $fileName;
			@mkdir(dirname($filePath), 0777, true);
			if ($this->image->saveAs($filePath)) {
				return $fileName;
			}
		}
		return false;
	}
}