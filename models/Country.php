<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property int|null $phonecode
 * @property string $lat
 * @property string $lng
 *
 * @property PhoneNumber[] $phoneNumbers
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phonecode'], 'integer'],
            [['lat', 'lng'], 'required'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 80],
            [['lat', 'lng'], 'string', 'max' => 45],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'phonecode' => 'Phonecode',
            'lat' => 'Lat',
            'lng' => 'Lng',
        ];
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::className(), ['country_id' => 'id']);
    }
}
