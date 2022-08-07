<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $input)
 * @method static findorfail(int $id)
 * @method static find(int $id)
 * @method static where(string $string, string $string1)
 */
class Mail extends Model
{
    use HasFactory;
    protected $fillable = ['sender','receiver','subject','message', 'sent_time','scheduled', 'is_sent'];
    public static $cast = [
        'receiver' => 'required',
        'subject' => 'required',
        'message' => 'required',
    ];
}
