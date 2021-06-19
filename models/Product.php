<?php declare(strict_types = 1);

namespace app\modules\store\models;

use app\modules\store\Module;
use Ramsey\Uuid\Uuid;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
	public static function tableName()
	{
		return 'product';
	}

	public function rules()
	{
		return [
			['product_id', 'string'],
			['product_id', 'default', 'value' => (string)Uuid::uuid6()],
			['account_id', 'string'],
			['account_id', 'default', 'value' => Yii::$app->user->id],
			['name', 'string'],
			['name', 'required'],
			['description', 'string'],
			['unit_price', 'string'],
			['unit_price', 'required'],
			['data', 'safe'],
		];
	}

	public function attributeLabels()
	{
		return [
			'product_id' => Module::t('product', 'Product ID'),
			'account_id' => Module::t('product', 'Account'),
			'name' => Module::t('product', 'Product'),
			'description' => Module::t('product', 'Description'),
			'unit_price' => Module::t('product', 'Unit Price'),
		];
	}

	public function getAccount()
	{
		$module = Module::getInstance();

		return $this->hasOne($module->accountClass, ['account_id' => 'account_id']);
	}

	public function getInvoices()
	{
		$module = Module::getInstance();

		return $this->hasMany($module->invoiceClass, ['product_id' => 'product_id'])
			->viaTable(InvoiceProduct::tableName(), ['invoice_id' => 'invoice_id']);
	}
}

/*
 * vim: ts=4 sw=4 noet
 */
