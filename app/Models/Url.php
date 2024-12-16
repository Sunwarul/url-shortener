<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    /** @use HasFactory<\Database\Factories\UrlFactory> */
    use HasFactory;

    protected $fillable = ['original_url', 'short_code', 'expire_at', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
