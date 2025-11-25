<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy as Job;

class JobController extends Controller
{
    // public function index() {
    //     return "Daftar Lowongan kerja";
    // }

    public function store(Request $request) {
        $request->validate([ 
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'logo' => $logoPath
        ]);

        return
        redirect() -> route('jobs.index') -> with('success', 'Lowongan berhasil ditambahkan');
    }

    public function index() {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create() {
        return view('jobs.create');
    }
}
