<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url','position', 'movie_id'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function setUrlAttribute($value){  //es un muttador trasforma antes de asignarle un valor a un atributo
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));//base 64 es pocos caracters
        $imageName = Str::random().'.gif';
        Storage::disk('public')->put('images/'.$imageName,$imageData);
        $this->attributes['url'] = asset('storage/images/'.$imageName); //significa que url le coloco el nombre de la imagen

    }
}
