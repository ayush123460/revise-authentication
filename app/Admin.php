<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'empno';

    protected $guarded = [];

    /**
     * Get the user associated with this account.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'uuid', 'uuid');
    }
}
