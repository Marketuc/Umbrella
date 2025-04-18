<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description', 'teacher_id'];

    /**
     * Get the teacher associated with the subject.
     */
    public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id')->where('user_type', 'teacher');
}
};
