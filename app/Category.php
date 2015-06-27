<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The users relationship.
     *
     * @return object
     */
    public function user()
    {
        return $this->hasMany('App\User');
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

}
