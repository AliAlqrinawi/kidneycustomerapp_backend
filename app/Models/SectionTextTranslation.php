<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTextTranslation extends Model
{
    use HasFactory;
    public $fillable = ['title', 'text'];

}
