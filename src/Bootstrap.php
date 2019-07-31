<?php
namespace andrewdanilov\InputImages;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
	public $uploadPath;

	/**
	 * @inheritdoc
	 */
	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			[
				'class' => 'andrewdanilov\InputImages\UploadUrlRule',
			],
		]);
	}
}