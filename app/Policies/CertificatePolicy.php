<?php

namespace App\Policies;

use App\Models\Certificate;
use App\Models\User;

class CertificatePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Certificate $certificate)
    {
        return $user->id === $certificate->application->user_id;
    }
}