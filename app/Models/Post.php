<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function reports() {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function uploads() {
        return $this->morphMany(Upload::class, 'uploadable');
    }

    public function user_liked(User $user) {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->exists();
    }

    public function create_like(User $user) {
        $this->likes()->syncWithoutDetaching($user); // no devuelve excepción así que no se necesita comprobar antes si ya se añadió
    }

    public function delete_like(User $user) {
        $this->likes()->detach($user); // no devuelve excepción así que no se necesita comprobar antes si ya se eliminó
    }
}
