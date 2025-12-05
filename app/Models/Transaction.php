<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'savings_id',
        'amount',
        'note',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savingRelation()
    {
        return $this->belongsTo(Saving::class, 'savings_id');
    }
}
