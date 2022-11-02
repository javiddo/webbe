<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function workshops()
    {
        return $this->hasMany(Workshop::class, 'event_id', 'id');
    }

    public function future_workshops() {
        return $this->workshops()->where('start','>', date('Y-m-d H:i:s'));
    }
}
