<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id', 'username', 'photo', 'app_key', 'status', 'first_name', 'last_name', 'reset_password_token', 'reset_password_expiration', 'upload_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The roles relationship.
     *
     * @return object
     */
    public function role()
    {
        return $this->hasOne('App\Role');
    }

    /**
     * The categories relationship.
     *
     * @return object
     */
    public function category()
    {
        return $this->hasOne('App\Category');
    }

    /**
     * The callouts relationship.
     *
     * @return object
     */
    public function callouts()
    {
        return $this->hasMany('App\Callout');
    }

    /**
     * The comments relationship.
     *
     * @return object
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * The views relationship.
     *
     * @return object
     */
    public function views()
    {
        return $this->hasMany('App\View');
    }

    /**
     * The votes relationship.
     *
     * @return object
     */
    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

}
