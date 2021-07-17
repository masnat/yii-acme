<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $plane_id
 * @property string $lat
 * @property string $lng
 * @property string $country_code
 * @property int $is_contry
 *
 * @property PlaceLang[] $placeLangs
 * @property Trip[] $toTrips
 * @property Trip[] $fromTrips
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plane_id', 'lat', 'lng', 'country_code', 'is_contry'], 'required'],
            [['is_contry'], 'integer'],
            [['plane_id', 'lat', 'lng'], 'string', 'max' => 45],
            [['country_code'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plane_id' => 'Plane ID',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'country_code' => 'Country Code',
            'is_contry' => 'Is Contry',
        ];
    }

    /**
     * Gets query for [[PlaceLangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceLangs()
    {
        return $this->hasMany(PlaceLang::className(), ['place_id' => 'id']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromTrips()
    {
        return $this->hasMany(Trip::className(), ['from' => 'id']);
    }

    /**
     * Gets query for [[Trips0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToTrips()
    {
        return $this->hasMany(Trip::className(), ['to' => 'id']);
    }
}
