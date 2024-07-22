<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['latitude', 'longitude'];

    protected $hidden = ['delted_at'];
}
