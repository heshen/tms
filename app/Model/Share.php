<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    //
    protected $table = 'shares';
    protected $fillable = ['token','note_id','u_id'];

    public function note()
    {
        return $this->belongsTo('App\Model\notes','id','note_id');
    }
    /**
     * 设置用户的名字
     * @return string
     */
    public function setTokenAttribute($value)
    {
        $this->attributes['token'] = bcrypt($value);
    }
}
