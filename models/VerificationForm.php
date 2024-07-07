<?php 

namespace app\models;

use Yii;
use yii\base\Model;

class VerificationForm extends Model
{
    public $verification_token;

    public function rules()
    {
        return [
            ['verification_token', 'required'],
            ['verification_token', 'string',],
        ];
    }
}
