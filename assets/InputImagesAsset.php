<?php

namespace andrewdanilov\InputImages\assets;

use yii\web\AssetBundle;

class InputImagesAsset extends AssetBundle
{
	public $sourcePath = '@vendor/andrewdanilov/yii2-input-images/web';
	public $css = [
		'css/input-images.css',
	];
	public $js = [
		'js/input-images.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\jui\JuiAsset',
	];
}