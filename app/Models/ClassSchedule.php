<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'subject_id', 'day', 'start_time', 'end_time'];

    // A schedule belongs to a class
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    // A schedule belongs to a subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class); // Change ClassModel to your actual model name
    }
}
