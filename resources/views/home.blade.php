@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12" id="app">
                <chat :user="{{ auth()->user() }}"></chat>
        </div>
    </div>
</div>
@endsection
