<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'uploads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'format', 'value', 'is_primary', 'file_url', 'thumbnail_url', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
