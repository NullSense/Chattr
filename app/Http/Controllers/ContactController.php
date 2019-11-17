<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Only get users that have a different id than the logged in user
        $contacts = User::where('id', '!=', auth()->id())->get();

        return response()->json($contacts);
    }
}
