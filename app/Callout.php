<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Callout extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'callouts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'fighter_a', 'fighter_b', 'photo', 'video', 'match_type', 'details_date', 'details_time', 'details_venue', 'total_comments', 'total_views', 'total_votes', 'status', 'latitude', 'longitude', 'broadcast_url', 'ticket_url'];

    /**
     * The attributes that are custom.
     *
     * @var array
     */
    protected $appends = ['down', 'up'];

    /**
     * The # of down votes
     *
     * @return integer
     */
    public function getDownAttribute()
    {
        return $this->vote()->where('tally', '<', 0)->count();
    }

    /**
     * The # of up votes
     *
     * @return integer
     */
    public function getUpAttribute()
    {
        return $this->vote()->where('tally', '>', 0)->count();
    }

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
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * The views relationship.
     *
     * @return object
     */
    public function view()
    {
        return $this->hasMany('App\View');
    }

    /**
     * The votes relationship.
     *
     * @return object
     */
    public function vote()
    {
        return $this->hasMany('App\Vote');
    }

}
