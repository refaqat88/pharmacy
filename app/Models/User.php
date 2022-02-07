<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'status'
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

    public function photo()
    {
        if (file_exists( public_path('img/upload/logo/').$this->user_image) && $this->user_image!='') {

            return asset('img/upload/logo/'.$this->user_image);
        } else {
            return asset('img/upload/logo/default-logo.jpg');
        }

    }


    public function kata()
    {
        return $this->hasOne(Kata::class)->orderBy('id', 'desc');
    }

    public function permanentKata()
    {
        return $this->hasOne(PermanentKata::class)->orderBy('id', 'desc');
    }

    public function role()
    {
        $this->belongsTo('App\Role');
    }


}
