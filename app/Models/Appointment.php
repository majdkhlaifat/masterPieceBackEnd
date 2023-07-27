<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'doctor',
        'date',
        'time',
        'message',
        'status',
        'user_id',
    ];

    // Define any relationships here, if applicable
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
