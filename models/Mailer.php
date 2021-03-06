<?php
namespace app\models;

use Yii;

class Mailer {
    
    const TYPE_REGISTRATION = 1;
    const TYPE_PASSWORD = 2;

    private static $renderFile;
    private static $renderParams = [];
    private static $from = ['dyas.nata.91@gmail.com' => 'Dyasnata W.'];
    private static $to;
    private static $subject;

    public static function validate($type, $model)
    {
        switch ($type) {
            case self::TYPE_REGISTRATION:
                if(empty($model->id) || empty($model->uid || empty($model->username) || empty($model->email))) {
                    return false;
                }
                self::$to = [$model->email];
                self::$subject = Yii::t('app', 'Please activate your account');
                self::$renderFile = 'registration';
                self::$renderParams = ['user' => $model];
                break;

            case self::TYPE_PASSWORD:
                // if(empty($model->id) || empty($model->uid || empty($model->username) || empty($model->email))) {
                //     return false;
                // }
                // self::$to = [$model->email];
                // self::$subject = Yii::t('app', 'Please check your email');
                // self::$renderFile = 'password';
                // self::$renderParams = ['user' => $model];
                break;

            default:
                return false;
        }
        return true;
    }

    public static function send($type, $model) 
    {
        if(!self::validate($type, $model)) {
            return false;
        }
        // send emails
        $message = \Yii::$app->mailer->compose(self::$renderFile, self::$renderParams);
        return $message->setFrom(self::$from)->setTo(self::$to)->setSubject(self::$subject)->send();
    }
}