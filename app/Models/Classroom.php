<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'teacher_id'];
    protected $table = 'classes';
    // A class belongs to a teacher (who is a user)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // A class has many students
    public function students()
    {
        return $this->belongsToMany(User::class, 'class_students', 'class_id', 'student_id');
    }

    // A class has many subjects
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'class_id', 'subject_id');
    }

    // A class has multiple schedules
    public function schedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }
}
