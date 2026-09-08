<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class EducationController extends Controller
{
    /**
     * Tampilkan halaman edukasi perundungan (bullying).
     */
    public function index(): View
    {
        return view('education.index');
    }
}
