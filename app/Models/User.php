<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Rolandstarke\Thumbnail\Facades\Thumbnail;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function likes() {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function favoriteCategories() {
        return $this->belongsToMany(Team::class, 'favorite_categories');
    }

    public function follows() {
        return $this->belongsToMany(User::class, 'follows', 'following_user', 'followed_user')->withTimestamps();
    }

    public function isFollowing(User $user) {
        return Follow::where('following_user', $this->id)->where('followed_user', $user->id)->exists();
    }

    public function followers() {
        return Follow::where('followed_user', $this->id)->count();
    }

    public function profilePhotoThumbnail($width) {
        if ($this->profile_photo_path) {
            return Thumbnail::src(public_path('storage/' . $this->profile_photo_path))->widen($width)->url();
        } else {
            return $this->profile_photo_url;
        }
    }

    public function lastActivity() {
        $query = DB::table('sessions')->select('last_activity')->where('user_id', '=', $this->id)->latest('last_activity')->get();

        if ($query->isEmpty()) {
            return "última conexión desconocida";
        }

        return "última conexión " . Carbon::createFromTimestamp($query->first()->last_activity)->diffForHumans();
    }
}
