<?php

namespace andrewdanilov\InputImages;

use yii\web\AssetBundle;

class InputImagesAsset extends AssetBundle
{
	public $sourcePath = '@vendor/andrewdanilov/yii2-input-images/src/web';
	public $css = [
		'css/input-images.css',
	];
	public $js = [
		'js/input-images.js',
	];
	public $depends = [
		'yii\web\JQueryAsset',
		'rmrevin\yii\fontawesome\AssetBundle',
	];
}