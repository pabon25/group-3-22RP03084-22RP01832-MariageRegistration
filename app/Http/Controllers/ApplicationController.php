<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the applications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $applications = Auth::user()->applications()->latest()->paginate(10);
        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new application.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created application in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Log the request data for debugging
        Log::info('Application form data:', $request->all());

        // For testing, let's make the validation more lenient
        $validated = $request->validate([
            'spouse_name' => 'required|string|max:255',
            'spouse_gender' => 'required|in:Male,Female',
            'spouse_dob' => 'required|date',
            'spouse_email' => 'required|email',
            'spouse_phone' => 'required|string|max:20',
            'spouse_address' => 'required|string',
            'witness_name' => 'required|string|max:255',
            'witness_contact' => 'required|string|max:20',
            'marriage_date' => 'required|date',
            'marriage_location' => 'required|string',
            'groom_id_card' => 'required|file',
            'groom_passport_photo' => 'required|file',
            'bride_id_card' => 'required|file',
            'bride_passport_photo' => 'required|file',
        ]);

        // Log the validated data
        Log::info('Validated application data:', $validated);

        try {
            // Handle file uploads
            $validated['groom_id_card'] = $request->file('groom_id_card')->store('documents/id_cards', 'public');
            $validated['groom_passport_photo'] = $request->file('groom_passport_photo')->store('documents/passport_photos', 'public');
            $validated['bride_id_card'] = $request->file('bride_id_card')->store('documents/id_cards', 'public');
            $validated['bride_passport_photo'] = $request->file('bride_passport_photo')->store('documents/passport_photos', 'public');

            // Log the file paths
            Log::info('File paths:', [
                'groom_id_card' => $validated['groom_id_card'],
                'groom_passport_photo' => $validated['groom_passport_photo'],
                'bride_id_card' => $validated['bride_id_card'],
                'bride_passport_photo' => $validated['bride_passport_photo'],
            ]);

            // Create application
            $application = Auth::user()->applications()->create($validated);

            // Log the created application
            Log::info('Application created:', $application->toArray());

            return redirect()->route('applications.show', $application)
                ->with('success', 'Application submitted successfully! Please wait for admin verification.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating application: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return back()->withInput()->with('error', 'An error occurred while submitting your application. Please try again.');
        }
    }

    /**
     * Display the specified application.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\View\View
     */
    public function show(Application $application)
    {
        $this->authorize('view', $application);
        return view('applications.show', compact('application'));
    }

    public function downloadCertificate(Application $application)
    {
        $this->authorize('view', $application);

        if ($application->status !== 'Approved' || !$application->certificate) {
            return back()->with('error', 'Certificate is not available for download.');
        }

        return Storage::disk('public')->download($application->certificate->certificate_file);
    }
}
