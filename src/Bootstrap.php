<?php

namespace andrewdanilov\InputImages;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			[
				'class' => 'andrewdanilov\InputImages\UploadUrlRule',
			],
		]);
		$app->controllerMap['upload'] = [
			'class' => 'andrewdanilov\inputImages\UploadController',
		];
	}
}