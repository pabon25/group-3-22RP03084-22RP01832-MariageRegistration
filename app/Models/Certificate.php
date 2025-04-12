<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'certificate_number',
        'issue_date',
        'certificate_file',
        'issued_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
