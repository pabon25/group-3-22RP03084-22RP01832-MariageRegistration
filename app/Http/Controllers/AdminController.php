<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $approvedApplications = Application::where('status', 'approved')->count();
        $rejectedApplications = Application::where('status', 'rejected')->count();
        $totalCertificates = Certificate::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'totalCertificates'
        ));
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function userDetails(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Display a listing of applications.
     *
     * @return \Illuminate\View\View
     */
    public function applications()
    {
        $applications = Application::with('user')->latest()->paginate(10);
        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Display the specified application.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\View\View
     */
    public function applicationDetails(Application $application)
    {
        return view('admin.applications.show', compact('application'));
    }

    /**
     * Update the application status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApplicationStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_remarks' => 'required|string',
        ]);

        $application->update([
            'status' => $validated['status'],
            'admin_remarks' => $validated['admin_remarks'],
            'approval_date' => $validated['status'] === 'approved' ? now() : null,
        ]);

        // Generate certificate if application is approved
        if ($validated['status'] === 'approved') {
            // Check if certificate already exists
            if (!$application->certificate) {
                // Generate a unique certificate number
                $certificateNumber = 'MC-' . date('Y') . '-' . str_pad($application->id, 5, '0', STR_PAD_LEFT);

                // Create certificate
                $certificate = Certificate::create([
                    'application_id' => $application->id,
                    'certificate_number' => $certificateNumber,
                    'issue_date' => now(),
                    'issued_by' => auth()->user()->full_name,
                ]);

                // Generate PDF certificate
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('certificates.marriage', [
                    'application' => $application,
                    'certificate' => $certificate,
                ]);

                // Save the PDF to storage
                $pdfPath = 'certificates/' . $certificateNumber . '.pdf';
                Storage::disk('public')->put($pdfPath, $pdf->output());

                // Update certificate with file path
                $certificate->update([
                    'certificate_file' => $pdfPath,
                ]);
            }
        }

        return redirect()->route('admin.applications.show', $application)
            ->with('success', 'Application status updated successfully.');
    }

    /**
     * Display a listing of certificates.
     *
     * @return \Illuminate\View\View
     */
    public function certificates()
    {
        $certificates = Certificate::with('application')->latest()->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Display the specified certificate.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\View\View
     */
    public function certificateDetails(Certificate $certificate)
    {
        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Generate a new certificate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateCertificate(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'certificate_number' => 'required|string|unique:certificates,certificate_number',
            'issue_date' => 'required|date',
        ]);

        $application = Application::findOrFail($validated['application_id']);

        // Check if application is approved
        if ($application->status !== 'approved') {
            return back()->with('error', 'Cannot generate certificate for an unapproved application.');
        }

        $certificate = Certificate::create([
            'application_id' => $validated['application_id'],
            'certificate_number' => $validated['certificate_number'],
            'issue_date' => $validated['issue_date'],
        ]);

        return redirect()->route('admin.certificates.show', $certificate)
            ->with('success', 'Certificate generated successfully.');
    }
}
