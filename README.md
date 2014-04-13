thememanager
============

Theme manager for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist singrana/thememanager "*"
```

or add

```
"singrana/thememanager": "*"
```

to the require section of your `composer.json` file.

Usage
-------

Change your application config
```
'view'=>
[

	'theme'	=>
	[
			'class'	=>	'singrana\thememanager\components\ThemeManager',
			'current'	=>	'site',

			'themes'	=>
			[
				'site'	=>
				[
					'pathMap'	=>
					[
						'@app/views'	=>	'@app/themes/site/views',
						'@app/views/layouts'	=>	'@app/themes/site/layouts',
					],
				],

			...
			],
			...
],
```

If you need to change theme, use:
```
\Yii::$app->view->theme->changeTheme('themeName');
```

For dynamic create new theme:
```
\Yii::$app->view->theme->createTheme('newTheme',
[
	'pathMap'			=>
	[
		'@app/views'			=>	'@app/themes/admin/views',
		'@app/views/layouts'	=>	'@app/themes/admin/layouts',
	],
]);

```

and use new theme:
```
\Yii::$app->view->theme->changeTheme('newTheme');
```
