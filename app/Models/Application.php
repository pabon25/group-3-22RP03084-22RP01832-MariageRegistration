<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'spouse_name',
        'spouse_gender',
        'spouse_dob',
        'spouse_email',
        'spouse_phone',
        'spouse_address',
        'witness_name',
        'witness_contact',
        'marriage_date',
        'marriage_location',
        'groom_id_card',
        'groom_passport_photo',
        'bride_id_card',
        'bride_passport_photo',
        'status',
        'admin_remarks',
        'approval_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'spouse_dob' => 'date',
        'marriage_date' => 'date',
        'approval_date' => 'datetime',
    ];

    /**
     * Get the user that owns the application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
}
