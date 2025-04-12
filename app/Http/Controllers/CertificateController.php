<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = auth()->user()->applications()
            ->whereHas('certificate')
            ->with('certificate')
            ->paginate(10);

        return view('certificates.index', compact('certificates'));
    }

    public function show(Certificate $certificate)
    {
        $this->authorize('view', $certificate);
        return view('certificates.show', compact('certificate'));
    }
}
