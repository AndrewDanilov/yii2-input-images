<?php

namespace andrewdanilov\InputImages;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
	public $uploadPath;

	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			[
				'class' => 'andrewdanilov\InputImages\UploadUrlRule',
			],
		]);

		$uploadControllerConfig = [
			'class' => 'andrewdanilov\InputImages\UploadController',
		];
		if (isset($this->uploadPath)) {
			$uploadControllerConfig['path'] = $this->uploadPath;
		}
		$app->controllerMap['upload'] = $uploadControllerConfig;
	}
}