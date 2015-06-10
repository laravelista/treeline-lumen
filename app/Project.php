<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    /**
     * @var array
     */
    protected $fillable = ['name', 'url', 'description', 'repository'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }

}
