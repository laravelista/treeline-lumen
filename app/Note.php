<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Note extends Model {

    /**
     * @var array
     */
    protected $dates = ['stamp'];

    /**
     * @var array
     */
    protected $fillable = ['stamp', 'title', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany('App\Link');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * Convert from 16/3/2015 to 2015-05-25
     *
     * @param $value
     */
    public function setStampAttribute($value)
    {
        $this->attributes['stamp'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

}
