<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentPlan extends Model
{
    protected $fillable = ['judul_konten', 'platform', 'tanggal_posting', 'status'];
}