@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Upload Document</div>
                <form action="upload" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group p-4">
                        <input type="text" name="file_name" id="" class="form-control my-2" placeholder="File Name">
                        <select name="curriculum_id" id="" class="form-control my-2">
                            @foreach ($universities as $university)
                                @foreach ($university->faculty as $faculty)
                                    @foreach ($faculty->getStudies as $studies)
                                        @foreach ($studies->curriculum as $curriculum)
                                            <option value="{{ $curriculum->id }}">{{ $curriculum->name }}| Year {{ $curriculum->year }} | {{ $studies->name }} | {{ $faculty->name }} | {{ $university->name }}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                        <div class="input-group my-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="document">
                                <label class="custom-file-label" for="document">Choose file</label>
                            </div>
                        </div>
                        <input type="submit" value="Submit" class="form-control my-2 btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
