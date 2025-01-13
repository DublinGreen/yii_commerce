<?php
/**
 * main.php
 *
 * This file holds frontend configuration settings.
 */

// Setup some default path aliases. These alias may vary from projects.
Yii::setPathOfAlias('root', __DIR__ . '/../..');
Yii::setPathOfAlias('common', __DIR__ . '/../../common');
Yii::setPathOfAlias('frontend', __DIR__ . '/..');
Yii::setPathOfAlias('logs', __DIR__ .'/../logs');
Yii::setPathOfAlias('www', __DIR__ . '/../www');
Yii::setPathOfAlias('bootstrap',  __DIR__ . '/../../common/extensions/bootstrap');
Yii::setPathOfAlias('yiiwheels',  __DIR__ . '/../../common/extensions/yiiwheels');

return CMap::mergeArray(
	require(__DIR__ . '/../../common/config/main.php'),
	array(
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#basePath-detail
		'basePath' => 'frontend',
		// set parameters
		// preload components required before running applications
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#preload-detail
		'preload' => array('log'),
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#language-detail
		'language' => 'en',
		'timeZone'=>'Africa/Lagos',
		'aliases' => array(
			'yiiwheels', dirname(__FILE__).'/../common/extensions/yiiwheels'
		),
		// uncomment if a theme is used
		/*'theme' => '',*/
		// setup import paths aliases
		// @see http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
		'import' => array(
			// uncomment if behaviors are required
			// you can also import a specific one
			/* 'common.extensions.behaviors.*', */
			// uncomment if validators on common folder are required
			/* 'common.extensions.validators.*', */
			'application.components.*',
			'application.controllers.*',
			'application.models.*',
			'frontend.widgets.*',
			'common.models._base.*',
			'common.models.*',
			'common.extensions.yiiwheels.*',
			'common.extensions.bootstrap.helpers.*',
		),
		/* uncomment and set if required */
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#setModules-detail
		/* 'modules' => array(), */
		'components' => array(
			'errorHandler' => array(
				// @see http://www.yiiframework.com/doc/api/1.1/CErrorHandler#errorAction-detail
				'errorAction'=>'site/error'
			),
			'urlManager' => array(
				'rules' => array(
					'product/<category>/<subcategory>/<product>' => 'product/view',
					'product/<category>/<product>' => 'product/view',
					'category/<category>/<subcategory>' => 'category/all',
					'category/<category>' => 'category/all',
					'<controller:\w+>/<id:\d+>' => '<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
					'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				)
			),
			'bootstrap' => array(
				'class' => 'common.extensions.bootstrap.components.TbApi'
			),
			'yiiwheels' => array(
				'class' => 'common.extensions.yiiwheels.YiiWheels',   
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CPSLiveLogRoute',					
						'levels'=>'error, warning',
						'maxFileSize' => '10240',
						'logPath'=> Yii::getPathOfAlias('logs'),
						'logFile'=>'application.log.'.date('Y-m-d'),
					),
					/*array(
						'class'=>'CWebLogRoute',
						'categories'=>'system.db.*',
					),*/
				),
			),
		),
		'params' => array(
			'storeID'      => 1,
			'site_redirect_url' => 'http://54.200.209.114/yorshop/frontend/www/payment/',
			'salesEmail' => 'sadiqdon35@gmail.com',
			'currency' => '566',
			'interswitchGet' => 'https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json',
			'interswitchURL' => '',
			'MAC_key' => 'FC2B6F88BA0FB42E09A4D2F97976482341A15D3369C927BF38E4BB6E010AF6762888D4095D1DF891CF1774C0601D2E7FB7DC29D1B896229FC7F9AF90CF7718FE',
			//'someOption' => true
		)
	),
	(file_exists(__DIR__ . '/main-env.php') ? require(__DIR__ . '/main-env.php') : array()),
	(file_exists(__DIR__ . '/main-local.php') ? require(__DIR__ . '/main-local.php') : array())
);
