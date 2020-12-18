<?php
namespace andrewdanilov\InputImages;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use mihaildev\elfinder\AssetsCallBack;
use mihaildev\elfinder\InputFile;

/**
 * Class InputImages
 *
 * Do not use widget param $template - it will be ignored
 * Other params:
 * @property string $language - 'ru' by default
 * @property boolean $multiple - if true, several images can be selected
 * @property string $buttonTag - input/button type of browse button tag
 * @property string $buttonName - text on browse button
 * @property array $buttonOptions - options of browse button
 * @property array $options - widget options, i.e. ['id' => 'form_input_id']
 * @property string $name - name and id of input field
 */
class InputImages extends InputFile
{
	public $buttonName;
	public $controller;

	private $widgetBody = '';

	public function init()
	{
		$this->filter = 'image';
		if (!isset($this->language)) {
			$this->language = 'ru';
		}
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
		if (empty($this->controller)) {
			$path = 'elfinder';
			$module = Yii::$app->controller->module;
			while ($module->module !== null) {
				$path = $module->id . '/' . $path;
				$module = $module->module;
			}
			$this->controller = $path;
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

		AssetsCallBack::register($this->getView());
		InputImagesAsset::register($this->getView());

		if ($this->multiple) {
			$this->getView()->registerJs("mihaildev.elFinder.register(" . Json::encode($this->options['id']) . ", InputImagesHandler); $(document).on('click', '#" . $this->buttonOptions['id'] . "', function(){mihaildev.elFinder.openManager(" . Json::encode($this->_managerOptions) . ");});");
		} else {
			$this->getView()->registerJs("mihaildev.elFinder.register(" . Json::encode($this->options['id']) . ", InputImageHandler); $(document).on('click', '#" . $this->buttonOptions['id'] . "', function(){mihaildev.elFinder.openManager(" . Json::encode($this->_managerOptions) . ");});");
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

		$browseBtn = Html::tag($this->buttonTag, $this->buttonName, $this->buttonOptions);
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