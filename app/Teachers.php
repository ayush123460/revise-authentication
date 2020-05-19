<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'empno';
    
    /**
     * Get the user associated with this account.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'uuid', 'uuid');
    }
}