<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    /**
     * Get the user associated with this account.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
