<?php declare(strict_types = 1);

namespace app\modules\store;

use Yii;
use yii\base\Module as YiiModule;

class Module extends YiiModule
{
	public $accountClass;
	public $invoiceClass;

	public function init()
	{
		parent::init();

		Yii::$app->i18n->translations['modules/store/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath' => '@app/modules/store/messages',
			'fileMap' => [
				'modules/store/coupon' => 'coupon.php',
				'modules/store/product' => 'product.php',
				'modules/store/shop' => 'shop.php',
			],
		];
	}

	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t("modules/store/{$category}", $message, $params, $language);
	}
}

/*
 * vim: ts=4 sw=4 noet
 */
