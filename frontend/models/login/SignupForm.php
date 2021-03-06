<?php
namespace frontend\models\login;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $easyparking;
    public $easyexit;
    public $myhistory;
    public $permit;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            [['easyparking','easyexit','myhistory','permit'],'safe']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
           
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($user->username === 'admin'){
            $user->level = User::ADMIN_LEVEL;
        }else{
            $user->level = User::USER_LEVEL;    
        }
        
        if(!$user->save()) return null;
        
        /*
        * assign a role to log-in user.
        */
        $auth = \Yii::$app->authManager;      
        
            if($user->level === User::USER_LEVEL){
                try{
                    $auth->assign($auth->getRole('user'), $user->getId());
                }catch(InvalidParamException $e){
                    
                }

            }else if($user->level === User::ADMIN_LEVEL){
                $auth->assign($auth->getRole('admin'), $user->getId());                    
            }
        return $user; 
    }
}
