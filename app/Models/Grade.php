<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'subject_id',
        'prelims',
        'midterms',
        'finals',
        'final_grade',
    ];
    protected $table = 'grades';

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function class() {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
    
}

