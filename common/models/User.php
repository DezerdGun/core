<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $mobile_number
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $role
 * @property string $email
 * @property string $confirm_code
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */


class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETED = 0;
    const STATUS_EMPTY = '';
    const SUB_BROKER = 'Sub broker';
    const MASTER_BROKER = 'Master broker';
    const CARRIER = 'Carrier';
    const DISABLED = 'Disabled';


    use Template;

    public static function tableName()
    {
        return '{{%user}}';
    }



    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED,self::STATUS_EMPTY]],
            // the name, email, subject and body attributes are required
            [['username','name', 'email','mobile_number','role'], 'safe'],

            // the email attribute should be a valid email address
            ['email', 'email'],
//            [['id', 'page', 'block', 'text'], 'safe'],
//            ['page', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByRoleMaster($role)
    {
        return static::findOne(['id' => $role, 'role' => self::MASTER_BROKER ]);
    }

    public static function findByRoleBroker($role)
    {
        return static::findOne(['id' => $role, 'role' => self::SUB_BROKER]);
    }

    public static function findByRoleCarrier($role)
    {
        return static::findOne(['id' => $role, 'role' => self::CARRIER ]);
    }

    public static function findByRoleEmpty($role)
    {
        return static::findOne(['id' => $role, 'role' => self::STATUS_EMPTY ]);
    }


    /**
     * Finds user by email
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function findByMobileNumber($mobile_number, $status)
    {
        return static::findOne([
            'mobile_number' => $mobile_number,
            'status' => $status
        ]);
    }

    //Inquiry
    public function search($params)
    {
        //First, we get an activequery
        $query = self::find();
        //Then create an activedataprovider object
        $provider = new ActiveDataProvider([
            //Provides a query object for the activedataprovider object
            'query' => $query,
            //Setting paging parameters
            'pagination' => [
                //Page size
                'pageSize' => 3,
                //Set the name of the current page number parameter in the address bar
                'pageParam' => 'p',
                //Setting the name of the address bar paging size parameter
                'pageSizeParam' => 'pageSize',
            ],
            //Set sort
            'sort' => [
                //Default sort method
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
                //Fields involved in sorting
                'attributes' => [
                    'id', 'page', 'block', 'text'
                ],
            ],
        ]);

        //If the verification fails, return directly
        if (!($this->load($params) && $this->validate())) {
            return $provider;
        }

        //Add filtering conditions
        $query->andFilterWhere(['id' => $this->id]);
//            ->andFilterWhere(['page' => $this->page])
//            ->andFilterWhere(['block' => $this->block])
//            ->andFilterWhere(['text' => $this->text]);

        return $provider;
    }


}
