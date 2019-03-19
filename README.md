Input Images Widget
===========
Widget building form fields for uploading single or multiple images. It extends and requires extension [MihailDev/yii2-elfinder](https://github.com/MihailDev/yii2-elfinder)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-input-images "dev-master"
```

or add

```
"andrewdanilov/yii2-input-images": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

For frontend

In your config/main.php add:

```php
return [
	...
	'bootstrap' => [
		...
		[
			'class' => 'andrewdanilov\InputImages\Bootstrap',
			'path' => 'upload/images', // path to upload images
		],
	],
];
```

Then in view just add a widget call:

```html
<?php
use andrewdanilov\InputImages\InputImagesFrontend;
?>

<?php $form = ActiveForm::begin(); ?>                              
<?= $form->field($model, 'logo')->widget(InputImagesFrontend::class) ?>
<?php ActiveForm::end(); ?>
```

For backend

In your config/main.php add:

```php
return [
	...
	'controllerMap' => [
		'elfinder' => [
			'class' => 'mihaildev\elfinder\Controller',
			'access' => ['admin'],
			'roots' => [
				[
					'baseUrl' => '',
					'basePath' => '@frontend/web',
					'path' => 'upload/images',
					'name' => 'Изображения',
				],
			],
		],
	],
];
```

And then add form in your view:

```html
<?php
use andrewdanilov\InputImages\InputImages;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'logo')->widget(InputImages::class) ?>
<?php ActiveForm::end(); ?>
```