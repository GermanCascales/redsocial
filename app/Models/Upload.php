<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Upload extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'file', 'name'];

    public function uploadable() {
        return $this->morphTo();
    }

    public function mimeType() {
        return Storage::mimeType($this->file);
    }

    public function isImage() {
        return Str::startsWith($this->mimeType(), 'image');
    }
}
