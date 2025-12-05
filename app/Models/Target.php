<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'savings_id',
        'name',
        'gambar',
        'amount',
        'collected',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateStatus()
    {
        if ($this->collected >= $this->amount) {
            $this->status = 'tercapai';
        } else {
            $this->status = 'belum tercapai';
        }
        $this->save();
    }
}
