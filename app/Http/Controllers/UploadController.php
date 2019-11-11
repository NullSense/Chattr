<?php

namespace App\Http\Controllers;

use App\Document;
use App\DocumentType;
use App\University;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class UploadController extends Controller
{
    public function renderUploadView()
    {
        $documentTypes = DocumentType::get();
        $universities = University::with('faculty', 'faculty.getStudies', 'faculty.getStudies.curriculum')->get();

        return view('uploadPanel', \compact('documentTypes', 'universities'));
    }

    public function uploadDocument(Request $request)
    {
        $stored = Storage::put('public', $request->document);
        $document = new Document();
        $document->curriculum = \intval(request('curriculum_id'));
        $document->name = request('file_name');
        $document->saved = $stored;
        //FIXME: document type
        $document->type = pathinfo($request->document->getClientOriginalName(), PATHINFO_EXTENSION);
        $document->save();

        return back()->with('success', ['File stored successfully!']);
    }
}
