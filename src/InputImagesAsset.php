<?php

namespace andrewdanilov\InputImages;

use yii\web\AssetBundle;

class InputImagesAsset extends AssetBundle
{
	public $sourcePath = '@andrewdanilov/InputImages/web';
	public $css = [
		'css/input-images.css',
	];
	public $js = [
		'js/input-images.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
		'rmrevin\yii\fontawesome\AssetBundle',
	];
}