<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'callout_id', 'details', 'status'];

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
        return $this->belongsTo('App\User');
    }

    /**
     * The callouts relationship.
     *
     * @return object
     */
    public function callout()
    {
        return $this->belongsTo('App\Callout');
    }

}
