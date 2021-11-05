<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IKBO extends Model
{
    use HasFactory;
    protected $table = 'i_k_b_o_s';
    protected $fillable = [
        'name',
        'email',
        'image',
        'position',
        'facebook',
        'instagram',
        'github',
        'vk',

    ];
}
