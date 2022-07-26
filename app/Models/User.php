<?php

namespace App\Models;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
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

    protected static function boot()
    // This gets called when we are booting up this model
    {
        parent::boot();

        static::created(function ($user) { // Gets called when a new user gets created
            $user->profile()->create([
                'title' => $user->username,
            ]);

            Mail::to($user->email)->send(new NewUserWelcomeMail());
            // Send an email to the user's email ($user gets passed to us when this event occurs) sending the NewUserWelcomeMail


        });
    }

    public function posts() // plural - one to many relation - this user has many posts
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function following()
    {
    // A user can follow many profiles: following many profiles
        return $this->belongsToMany(Profile::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
