<?php

namespace andrewdanilov\InputImages;

use Yii;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadController extends Controller
{
	public $path = '@webroot/upload/images';
	public $baseUrl = '/upload/images';

	public function init()
	{
		$this->layout = '@andrewdanilov/InputImages/views/layouts/main';
		$this->viewPath = '@andrewdanilov/InputImages/views/upload';
		parent::init();
	}

	/**
	 * @param int $formId
	 * @return string
	 */
	public function actionUploadImage($formId)
	{
		if (Yii::$app->request->isPost) {
			$model = new UploadImage();
			$model->image = UploadedFile::getInstance($model, 'image');

			if ($fileName = $model->upload($this->path)) {

				$headers = Yii::$app->response->headers;
				$headers->set('Content-Type', 'text/html; charset=utf-8');

				$this->view->params['id'] = $formId;
				$this->view->params['response'] = [
					'success' => true,
					'url' => rtrim($this->baseUrl, '/') . '/' . $fileName,
				];

				return $this->render('upload-image');
			}
		}

		throw new BadRequestHttpException();
	}
}