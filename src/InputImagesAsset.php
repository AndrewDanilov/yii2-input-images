<?php
namespace andrewdanilov\InputImages;

use yii\web\AssetBundle;

class InputImagesAsset extends AssetBundle
{
	public $css = [
		'css/input-images.css',
	];
	public $js = [
		'js/input-images.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
		'andrewdanilov\fontawesome\AssetBundle',
	];

	public function init()
	{
		$this->sourcePath = __DIR__ . "/web";
		parent::init();
	}
}