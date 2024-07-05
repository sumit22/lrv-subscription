<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSubscriber extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'website_id',
    ];

    public function subscriber()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
