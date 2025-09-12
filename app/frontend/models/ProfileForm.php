<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class ProfileForm extends Model
{
    public $username;
    public $email;
    public $first_name;
    public $last_name;
    public $phone;

    /** @var User */
    private $user;

    public function __construct(User $user, $config = [])
    {
        $this->user = $user;
        $this->username   = $user->username;
        $this->email      = $user->email;
        $this->first_name = $user->first_name;
        $this->last_name  = $user->last_name;
        $this->phone      = $user->phone;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['username', 'first_name', 'last_name'], 'trim'],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 64],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            // unique username/email (ignore current user)
            ['username', 'unique', 'targetClass' => User::class, 'filter' => ['not', ['id' => $this->user->id]], 'message' => 'This username is already taken.'],
            ['email', 'unique', 'targetClass' => User::class, 'filter' => ['not', ['id' => $this->user->id]], 'message' => 'This email is already in use.'],
            // simple phone validation (optional; customize as needed)
            ['phone', 'match', 'pattern' => '/^\+?[0-9 \-\(\)]{7,20}$/', 'message' => 'Enter a valid phone number.'],
            ['phone', 'string', 'max' => 32],
            [['first_name','last_name','phone'], 'default', 'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => 'First name',
            'last_name'  => 'Last name',
        ];
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }
        $u = $this->user;
        $u->username   = $this->username;
        $u->email      = $this->email;
        $u->first_name = $this->first_name;
        $u->last_name  = $this->last_name;
        $u->phone      = $this->phone;

        // touch updated_at if present
        if ($u->hasAttribute('updated_at')) {
            $u->updated_at = time();
        }
        return $u->save(false);
    }
}
