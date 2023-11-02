<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;



    public $translatable = ['name'];

    protected $fillable = ['name', 'status', 'grade_id', 'classroom_id'];

    public function classes()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
