<?php

namespace andrewdanilov\InputImages;

use Yii;
use yii\web\Controller;

class UploadController extends Controller
{
	public $path = 'upload/images';

	/**
	 * @param int $formId
	 * @return string
	 */
	public function actionUploadImage($formId)
	{
		$headers = Yii::$app->response->headers;
		$headers->set('Content-Type', 'text/html; charset=utf-8');

		$response = [
			'success' => 0,
		];

		// проверим на ошибки
		if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK && $_FILES['file']['size'] !== 0) {

//			$file_path = ROOT . "/tmp";
//			$file_name = Files::uniqFileName($file_path, ".jpg");
//
//			// создаем необходимые директории
//			@mkdir($file_path, 0775, true);
//
//			$images = Images::getInstance();
//
//			$images->resize($_FILES['file']["tmp_name"], $file_path . "/" . $file_name, 800);

			$response['success'] = true;
			$response['url'] = '123';

		}

		$this->layout = '@vendor/andrewdanilov/src/views/layouts/main';
		$this->view->params['id'] = $formId;
		$this->view->params['response'] = $response;
		return $this->render(Yii::getAlias('@vendor') . '/andrewdanilov/src/views/upload/upload');
	}
}