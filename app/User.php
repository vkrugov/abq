<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = ['name', 'email'];

    private $first_name;
    private $last_name;
    private $email;
    private $role_id;
    private $gender_id;
    private $password;
    private $created_at;
    private $updated_at;

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
