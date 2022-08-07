<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static find(mixed $category_id)
 * @method static pluck(string $string, string $string1)
 * @method static firstOrCreate(array $array)
 * @method static where(string $string, mixed $name)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static $cast = [
        'name' => 'required|unique:categories',
    ];

    /**
     * @return BelongsToMany
     */
    public function emails(): BelongsToMany
    {
        return $this->belongsToMany(Email::class, 'emails_categories');
    }
}
