<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RequestRecord extends Model
{
    use HasFactory;

    protected $fillable = [
    'request_data',
    'response_data',
    'is_valid',
    ];
}
