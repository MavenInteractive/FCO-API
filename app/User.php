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
    protected $fillable = ['first_name', 'last_name', 'name', 'username', 'email', 'password', 'role_id', 'category_id', 'photo', 'reset_password_token', 'reset_password_expiration', 'birth_date', 'gender', 'status'];

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
        return $this->belongsTo('App\Role');
    }

    /**
     * The categories relationship.
     *
     * @return object
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * The countries relationship.
     *
     * @return object
     */
    public function country()
    {
        return $this->belongsTo('App\Countries');
    }

    /**
     * The callouts relationship.
     *
     * @return object
     */
    public function callout()
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
