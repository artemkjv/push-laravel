<?php

namespace App\Models;

use App\Libraries\Decoration\UserInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements UserInterface
{
    use HasApiTokens, HasFactory, Notifiable;

    public const PAGINATE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_ip',
        'last_login_at',
        'tariff_id',
        'role',
        'admin_id',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function apps()
    {
        return $this->hasMany(App::class);
    }

    public function segments()
    {
        return $this->hasMany(Segment::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    public function autoPushes()
    {
        return $this->hasMany(AutoPush::class);
    }

    public function customPushes()
    {
        return $this->hasMany(CustomPush::class);
    }

    public function weeklyPushes()
    {
        return $this->hasMany(WeeklyPush::class);
    }

    public function moderators()
    {
        return $this->hasMany(User::class, 'admin_id');
    }

    public function sentPushes()
    {
        return $this->hasMany(SentPush::class);
    }

    public function managedUsers()
    {
        return $this->user->morphedByMany(User::class, 'entityable');
    }
}
