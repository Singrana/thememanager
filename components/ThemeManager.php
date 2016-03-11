<?php
/**
 * @author: Singrana
 * @email : singrana@singrana.com
 * Date: 12.04.2014
 */

namespace singrana\thememanager\components;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;


class ThemeManager extends \yii\base\Theme
{
	/**
	 * @var property for current theme
	 */
	public $current;

	/**
	 * @var property for themes array
	 */
	public $themes;

	/**
	 * @var property for setup default layout
	 */
	public $defaultLayout;

	/**
	 * @var storage current theme
	 */
	private $_currentTheme;


	/**
	 * @throws InvalidConfigException
	 */
	public function init()
	{
		if (!empty($this->current))
		{
			if (empty($this->themes))
			{
				throw new InvalidConfigException('The "themes" property must be set.');
			}

			$this->defaultLayout = null;
			$this->validateTheme($this->current);
			$this->changeTheme($this->current);
		}
		else
		{
			$this->setBasePath('@app');
		}

		parent::init();
	}

	/**
	 * @param $theme - theme for validate
	 *
	 * @throws InvalidConfigException
	 */
	public function validateTheme($theme)
	{

		if (!isset($this->themes[$theme]) || empty($this->themes[$theme]))
		{
			throw new InvalidConfigException('Select theme not found.');
		}

		/*
		if (!isset($this->themes[ $theme ][ 'pathMap' ]) || empty($this->themes[ $theme ][ 'pathMap' ]))
		{
			throw new InvalidConfigException('The "pathMap" property in selected theme must be set.');
		}
		*/
	}

	/**
	 * @param $theme - theme for switching
	 */
	public function changeTheme($theme)
	{
		$this->validateTheme($theme);
		$this->current = $theme;

		$this->_currentTheme = $this->themes[$this->current];

		if (!empty($this->_currentTheme['pathMap']))
		{
			$this->pathMap = $this->_currentTheme['pathMap'];
		}

		if (!empty($this->_currentTheme['basePath']))
		{
			$this->setBasePath($this->_currentTheme['basePath']);
		}

		if (!empty($this->_currentTheme['baseUrl']))
		{
			$this->setBaseUrl($this->_currentTheme['baseUrl']);
		}

		if (!empty($this->_currentTheme['defaultLayout']))
		{
			$this->defaultLayout = $this->_currentTheme['defaultLayout'];
		}
		else
		{
			$this->defaultLayout = null;
		}

		\Yii::setAlias('@theme', '@app/themes/'.$this->current);

	}

	public function createTheme($theme, $themeArray)
	{
		$this->themes[$theme] = $themeArray;
	}
}