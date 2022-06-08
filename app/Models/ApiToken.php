<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;

    public const PAGINATE = 10;

    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
        'name',
    ];

    public function apiPages() {
        return $this->belongsToMany(ApiPage::class, 'api_token_api_page');
    }

}
