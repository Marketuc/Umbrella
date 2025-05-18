<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'dob', 'gender', 'username', 'password', 'phone', 'photo', 'user_type','program',
    ];

    protected $attributes = [
        'user_type' => 'student',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'dob' => 'date',
        'password' => 'hashed',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // Scope to get only teachers
    public function scopeTeachers($query)
    {
        return $query->where('user_type', 'teacher');
    }
    
    public function classes()
{
    return $this->hasMany(Classroom::class, 'teacher_id');
}

public function grade()
{
    return $this->hasOne(Grade::class, 'student_id', 'id');
}


}
