<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Faculty;
use App\Studies;

class AdminController extends Controller
{
    public function renderAdminView()
    {
        if (Auth::user()->role == 'A') {
            $newestUsers = User::where('role', 'U')->orderBy('created_at', 'desc')->limit(10)->get();
            $universities = University::orderBy('country_code', 'asc')->get();
            $faculties = Faculty::with(['getUniversity', 'getStudies'])->orderBy('university', 'asc')->get();

            return view('adminPanel', \compact('newestUsers', 'universities', 'faculties'));
        } else {
            return back()->with('error', ['Unauthorized access!']);
        }
    }

    public function renderUserView()
    { }

    public function addNewUniversity()
    {
        $country = request('country');
        $name = request('name');

        $university = new University();
        $university->name = $name;
        $university->country_code = \intval($country);
        $university->save();

        return back()->with('success', ['University successfully added!']);
    }

    public function addNewFaculty()
    {
        $faculty = request('faculty');
        $name = request('name');

        $faculty = new Faculty();
        $faculty->name = $name;
        $faculty->university = \intval($faculty);
        $faculty->save();

        return back()->with('success', ['Faculty successfully added!']);
    }

    public function addNewStudies()
    {
        $faculty = request('faculty');
        $name = request('name');

        $studies = new Studies();
        $studies->name = $name;
        $studies->faculty = \intval($faculty);
        $studies->save();

        return back()->with('success', ['Studies successfully added!']);
    }
}
