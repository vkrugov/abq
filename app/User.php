<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $phone
 * @property integer $role_id
 * @property integer $gender_id
 * @property string $password
 * @property integer birthday_at
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = ['name', 'email'];

    public static function boot()
    {
        parent::boot();

        self::updated(function($model){
            $model->updated_at = time();
        });
        self::saving(function($model){
            if (!isset($model->attributes['created_at'])) {
                $model->attributes['created_at'] = !empty($model->attributes['created_at']) ? $model->attributes['created_at'] : time();
                $model->attributes['updated_at'] = time();
            }
        });
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
