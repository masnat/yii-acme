<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $uid
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $status
 * @property int $contact_email
 * @property int $contact_phone
 * @property string $auth_key
 * @property string $created
 * @property string $updated
 *
 * @property Message[] $fromMessages
 * @property Message[] $toMessages
 * @property PhoneNumber[] $phoneNumbers
 * @property Trip[] $trips
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_INSERTED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;
    public $authKey;
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'username', 'email', 'password', 'auth_key'], 'required'],
            [['email'], 'email'],
            [['status', 'contact_email', 'contact_phone'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['uid', 'password', 'auth_key'], 'string', 'max' => 60],
            [['username'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 255],
            [['uid'], 'unique'],
            [['email', 'auth_key'], 'unique'],
        ];
    }

    /**
     * beforeValidate
     */
    public function beforeValidate()
    {
        if($this->isNewRecord) {
            $this->setUid();
            $this->setAuthKey();
        }

        return parent::beforeValidate();
    }

    /**
     * beforeSave
     */
    public function beforeSave($insert)
    {
        if($this->isNewRecord)
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $this->updated = new Expression('NOW()');
        return parent::beforeSave($insert);
    }

    /**
     * setUid
     */
    private function setUid()
    {
        $this->uid = Yii::$app->security->generateRandomString(60);
    }

    /**
     * setAuthKey
     */
    private function setAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString(60);
    }

    /**
     * activate
     */
    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->setUid();
        return $this->save();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'status' => Yii::t('app', 'Status'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_phone' => Yii::t('app', 'Contact Phone'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromMessages()
    {
        return $this->hasMany(Message::className(), ['from_user_id' => 'id']);
    }

    /**
     * Gets query for [[Messages0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToMessages()
    {
        return $this->hasMany(Message::className(), ['to_user_id' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['user_id' => 'id']);
    }

    /**
     * Get user by email
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    /**
     * validate password
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     *
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

}
