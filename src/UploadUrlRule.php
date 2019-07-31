<?php
namespace andrewdanilov\InputImages;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

class UploadUrlRule extends BaseObject implements UrlRuleInterface
{
	public function createUrl($manager, $route, $params)
	{
		if ($route === 'upload/upload-image') {
			if (isset($params['formId'])) {
				return 'upload/upload-image/' . $params['formId'];
			}
		}
		return false;
	}

	/**
	 * @param \yii\web\UrlManager $manager
	 * @param \yii\web\Request $request
	 * @return array|bool
	 * @throws \yii\base\InvalidConfigException
	 */
	public function parseRequest($manager, $request)
	{
		$pathInfo = $request->getPathInfo();
		if (preg_match('%^upload/upload-image/([\w\-_]+)$%', $pathInfo, $matches)) {
			$params['formId'] = $matches[1];
			return ['upload/upload-image', $params];
		}
		return false;
	}
}
