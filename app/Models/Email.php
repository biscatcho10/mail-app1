<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $input)
 * @method static find(int $id)
 * @method static findOrFail(int $id)
 */
class Email extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public static $cast = [
        'name' => 'required',
        'email' => 'required|email|unique:emails',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'emails_categories');
    }
}
