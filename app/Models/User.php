<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Services\AvatarService;
use JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean'
    ];

    public function stalls()
    {
        $this->hasMany(Stall::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setDefaultAvatar ($user)
    {

        $avatar = new AvatarService;

        $user->avatar = $avatar->generate($user);

        $user->save();
    }

    public function googleCallback($user)
    {

        $name           = $user->getName();
        $avatar         = $user->getAvatar();
        $email          = $user->getEmail();


        $this->user = User::where([
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ])->first();


        $user = User::firstOrCreate([
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'access_token'   => $token,
            'name'           => $name,
            'email'          => $email,
            'avatar'         => $avatar,
        ];
    }

}
