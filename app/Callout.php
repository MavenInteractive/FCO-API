<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Callout extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The users relationship.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo('App\User');
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
