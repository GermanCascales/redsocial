<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function type() {
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function user_liked(User $user) {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->exists();
    }

    public function create_like(User $user) {
        Like::create(['post_id' => $this->id,
                      'user_id' => $user->id]);
    }

    public function delete_like(User $user) {
        Like::where('post_id', $this->id)->where('user_id', $user->id)->first()->delete();
    }
}
