<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'callout_id', 'tally', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The callouts relationship.
     *
     * @return object
     */
    public function callouts()
    {
        return $this->belongsTo('App\Callout');
    }

}
