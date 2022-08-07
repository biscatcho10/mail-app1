<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCategory extends Model
{
    use HasFactory;

    protected $fillable = ["email_id"];

    protected $table = "emails_categories";

    public $timestamps = false;
}
