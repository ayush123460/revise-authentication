<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{

    protected $primaryKey = 'regno';

    /**
     * Get the user associated with this account.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
