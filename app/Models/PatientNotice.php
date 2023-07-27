<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\User;

class PatientNotice extends Model
{
    use HasFactory;

    protected $table = 'patient_notices';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'notice',
    ];

    /**
     * Get the user (patient) associated with the notice.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the doctor associated with the notice.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
