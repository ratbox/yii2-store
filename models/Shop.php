<?php declare(strict_types = 1);
/*
 *  Copyright (C) 2019-2021 by Comsign
 */

namespace app\modules\store\models;

use app\modules\store\Module;
use Ramsey\Uuid\Uuid;
use yii\db\ActiveRecord;

class Shop extends ActiveRecord
{
	public static function tableName()
	{
		return 'shop';
	}

	public function rules()
	{
		return [
			['shop_id', 'string'],
			['shop_id', 'default', 'value' => (string)Uuid::uuid6()],
			['account_id', 'string'],
			['account_id', 'default', 'value' => Yii::$app->user->id],
			['slug', 'string'],
			['name', 'string'],
			['name', 'required'],
			['description', 'string'],
		];
	}

	public function attributeLabels()
	{
		return [
			'shop_id' => Module::t('shop', 'Shop ID'),
			'account_id' => Module::t('shop', 'Account'),
			'slug' => Module::t('slug', 'URL Slug'),
			'name' => Module::t('shop', 'Shop Name'),
			'description' => Module::t('shop', 'Description'),
		];
	}

	public function getAccount()
	{
		$module = Module::getInstance();

		return $this->hasOne($module->accountClass, ['account_id' => 'account_id']);
	}

	public function getProducts()
	{
		return $this->hasMany(Product::class, ['account_id' => 'account_id']);
	}

	public function getCoupons()
	{
		return $this->hasMany(Coupon::class, ['shop_id' => 'shop_id']);
	}
}

/*
 * vim: ts=4 sw=4 noet
 */
