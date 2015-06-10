<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    /**
     * @var array
     */
    protected $fillable = ['name', 'href'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function note()
    {
        return $this->belongsTo('App\Note');
    }

}
