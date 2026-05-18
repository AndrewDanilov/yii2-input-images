Input Images Widget
===========
Widget building form fields for uploading single or multiple images. It extends and requires extension [MihailDev/yii2-elfinder](https://github.com/MihailDev/yii2-elfinder)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-input-images "~1.0.0"
```

or add

```
"andrewdanilov/yii2-input-images": "~1.0.0"
```

to the require section of your `composer.json` file.


Usage
-----

__For use without a file manager__

In your config/main.php add:

```php
return [
	// ...
	'controllerMap' => [
		'uploader' => [
			'class' => 'andrewdanilov\InputImages\UploadController',
			'path' => '@frontend/web/upload/post/images', // writable path to upload images to, default is '@webroot/upload/images'
            'baseUrl' => '/upload/post/images', // base url to uploaded images, default is '/upload/images'
		],
	],
];
```

Then in view just add a widget call:

```html
<?php
use andrewdanilov\InputImages\InputImagesSimple;
?>

<?php $form = ActiveForm::begin(); ?>                              
<?= $form->field($model, 'logo')->widget(InputImagesSimple::class) ?>
<?php ActiveForm::end(); ?>
```

__For use with the file manager__

In your config/main.php add:

```php
return [
	// ...
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
