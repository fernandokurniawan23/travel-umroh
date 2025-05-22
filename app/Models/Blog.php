<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function incrementReadCount() {
        $this->reads++;
        return $this->save();
    }

    /**
     * Get all of the images for the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogImages(): HasMany // Ubah nama method menjadi blogImages
    {
        return $this->hasMany(BlogImage::class);
    }
}