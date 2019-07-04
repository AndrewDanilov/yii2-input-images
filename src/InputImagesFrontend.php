<?php

namespace andrewdanilov\InputImages;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

class InputImagesFrontend extends InputWidget
{
	public $buttonName;
	public $buttonOptions = [];
	public $multiple = false;
	public $uploadHandler = 'upload/upload-image';

	private $widgetBody;

	public function init()
	{
		if (!isset($this->buttonName)) {
			if ($this->multiple) {
				$this->buttonName = 'Add';
			} else {
				$this->buttonName = 'Browse';
			}
		}
		if (!isset($this->buttonOptions['class'])) {
			$this->buttonOptions['class'] = 'btn btn-primary';
		}
		parent::init();
	}

	public function run()
	{
		if ($this->hasModel()) {
			$value = Html::getAttributeValue($this->model, $this->attribute);
		} else {
			$value = $this->value;
		}

		if ($this->multiple) {
			if (is_array($value)) {
				foreach ($value as $image) {
					$this->addImage($image);
				}
			}
		} else {
			if (is_string($value)) {
				$this->addImage($value);
			}
		}

		InputImagesAsset::register($this->getView());

		$uploadForm = '\
			<iframe name="upload_frame_' . $this->options['id'] . '" class="hidden-frame"></iframe>\
			<form id="upload_form_' . $this->options['id'] . '" action="' . Url::to([$this->uploadHandler, 'formId' => $this->options['id']]) . '" target="upload_frame_' . $this->options['id'] . '" method="POST" enctype="multipart/form-data" class="hidden-form">\
				<input type="hidden" name="' . Yii::$app->getRequest()->csrfParam . '" value="' . Yii::$app->getRequest()->getCsrfToken() . '" />\
				<input type="file" name="image" id="upload_input_' . $this->options['id'] . '" accept="image/jpeg,image/png,image/gif" />\
			</form>';
		$this->getView()->registerJs("$('body').append('" . $uploadForm . "')");
		$this->getView()->registerJs("$('body').on('change', '#upload_input_" . $this->options['id'] . "', function() { $(this).parent('form').submit(); });");
		if ($this->multiple) {
			$this->getView()->registerJs("andrewdanilov.inputImages.register(" . Json::encode($this->options['id']) . ", InputImagesFrontendHandler);");
		} else {
			$this->getView()->registerJs("andrewdanilov.inputImages.register(" . Json::encode($this->options['id']) . ", InputImageFrontendHandler);");
		}

		return $this->buildWidget();
	}

	/**
	 * @param $image
	 */
	private function addImage($image)
	{
		if (empty($image)) {
			return;
		}

		$img = Html::img($image, ['alt' => '']);
		$preview = Html::tag('div', $img, ['class' => 'input-images-preview']);

		if ($this->hasModel()) {
			$name = Html::getInputName($this->model, $this->attribute);
		} else {
			$name = $this->name;
		}
		if ($this->multiple) {
			$name .= '[]';
		}
		if ($this->hasModel()) {
			$input = Html::activeHiddenInput($this->model, $this->attribute, [
				'name' => $name,
				'value' => $image,
			]);
		} else {
			$input = Html::hiddenInput($name, $image);
		}

		$remove = Html::tag('div', '', ['class' => 'input-images-remove fa fa-times']);
		$item = Html::tag('div', $preview . $input . $remove, ['class' => 'input-images-item']);
		$this->widgetBody .= $item;
	}

	/**
	 * @return string
	 */
	private function buildWidget()
	{
		$widget = Html::tag('div', $this->widgetBody, ['class' => 'input-images-items']);

		$browseBtn = Html::label($this->buttonName, 'upload_input_' . $this->options['id'], $this->buttonOptions);

		$widget .= Html::tag('div', $browseBtn, ['class' => 'input-images-control']);

		return Html::tag('div', $widget, [
			'id' => $this->options['id'] . '_wrapper',
			'class' => 'input-images-wrapper',
			'data' => [
				'form-name' => $this->model->formName(),
				'form-attribute' => $this->attribute,
			]
		]);
	}
}