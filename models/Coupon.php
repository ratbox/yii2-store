<?php declare(strict_types = 1);

namespace app\modules\store\models;

use app\modules\store\Module;
use Yii;
use yii\db\ActiveRecord;

class Coupon extends ActiveRecord
{
	public static function tableName()
	{
		return 'coupon';
	}

	public function rules()
	{
		return [
			['shop_id', 'string'],
			['shop_id', 'required'],
			['code', 'match', 'pattern' => '/[A-Za-z0-9_-]{1,32}/'],
			['code', 'default', 'value' => Yii::$app->security->generateRandomString(6)],
			['expires', 'integer'],
			['uses', 'integer', 'min' => 0],
			['subtract', 'string'],
			['subtract', 'default', 'value' => '0'],
			['multiply', 'string'],
			['multiply', 'default', 'value' => '1'],
		];
	}

	public function attributeLabels()
	{
		return [
			'shop_id' => Module::t('code', 'Shop'),
			'code' => Module::t('code', 'Code'),
			'expires' => Module::t('code', 'Expires'),
			'uses' => Module::t('code', 'Charge'),
			'percentage' => Module::t('code', 'Percentage'),
			'subtract' => Module::t('code', 'Subtract'),
		];
	}

	public function getShop()
	{
		return $this->hasOne(Shop::class, ['shop_id' => 'shop_id']);
	}

	public function getValid()
	{
		return (!isset($this->uses) || $this->uses > 0)
			&& (!isset($this->expires) || $this->expires < time());
	}
}

/*
 * vim: ts=4 sw=4 noet
 */
