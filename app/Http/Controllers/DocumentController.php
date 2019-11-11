<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function downloadDocument($id)
    {
        $document = Document::find($id);
        return Storage::download($document->saved, \str_replace(' ', '_', $document->name) . '.' . $document->type, []);
    }
}
