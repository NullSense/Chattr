<?php

namespace App\Http\Controllers;

use App\Curriculum;
use App\Document;
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
            $newestUsers = User::where('role', 'U')->orderBy('created_at', 'desc')->limit(5)->get();
            $universities = University::orderBy('country_code', 'asc')->get();
            $faculties = Faculty::with(['getUniversity', 'getStudies'])->orderBy('university', 'asc')->get();
            $studies = Studies::with('getFaculty', 'getFaculty.getUniversity', 'curriculum')->get();
            $documents = Document::limit(100)->get();

            return view('adminPanel', \compact('newestUsers', 'universities', 'faculties', 'studies', 'documents'));
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

    public function addNewCurriculum()
    {
        $studies = request('studies');
        $name = request('name');
        $year = request('year');


        $curriculum = new Curriculum();
        $curriculum->name = $name;
        $curriculum->studies = \intval($studies);
        $curriculum->year = \intval($year);
        $curriculum->save();

        return back()->with('success', ['Curriculum successfully added!']);
    }
}
