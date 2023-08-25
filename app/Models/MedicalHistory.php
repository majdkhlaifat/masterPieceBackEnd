<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'dob',
        'diabetes',
        'hypertension',
        'heart_disease',
        'smoking',
        'blood_type',
        'allergies',
        'comments',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
