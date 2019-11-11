@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card my-2">
                <div class="card-header">Newest Users</div>
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Registered On</th>
                    </thead>
                    <tbody>
                        @foreach ($newestUsers ?? '' as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card my-2">
                <div class="card-header">Add Curriculum</div>
                <form action="admin/addCurriculum" method="POST" class="form-group">
                    @csrf
                    <div class="form-group m-2">
                        <input class="form-control my-1" type="text" name="name" id="curriculum-name" placeholder="Curriculum Name">
                        <select class="form-control my-1" name="studies" id="studies-name">
                            @foreach ($studies ?? '' as $studie)
                                <option value="{{ $studie->id }}">{{ $studie->name }} | {{ $studie->getFaculty->name }} | {{ $studie->getFaculty->getUniversity->name }}</option>
                            @endforeach
                        </select>
                        <label for="year" class="mt-1">Year:</label>
                        <select name="year" id="" class="form-control mb-1">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <input class="form-control my-1 btn btn-dark text-white" type="submit" value="Submit">
                    </div>
                </form>
            </div>
            <div class="card my-2">
                <div class="card-header">Add Studies</div>
                <form action="admin/addStudies" method="POST" class="form-group">
                    @csrf
                    <div class="form-group m-2">
                        <input class="form-control my-1" type="text" name="name" id="studies-name" placeholder="Studies Name">
                        <select class="form-control my-1" name="faculty" id="faculty-name">
                            @foreach ($faculties ?? '' as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->getUniversity->name }} | {{ $faculty->name }}</option>
                            @endforeach
                        </select>
                        <input class="form-control my-1 btn btn-dark text-white" type="submit" value="Submit">
                    </div>
                </form>
            </div>
            <div class="card my-2">
                <div class="card-header">Add Faculty</div>
                <form action="admin/addFaculty" method="POST" class="form-group">
                    @csrf
                    <div class="form-group m-2">
                        <input class="form-control my-1" type="text" name="name" id="faculty-name" placeholder="Faculty Name">
                        <select class="form-control my-1" name="university" id="">
                            @foreach ($universities ?? '' as $uni)
                                <option value="{{ $uni->id }}"> {{ $uni->name }}</option>
                            @endforeach
                        </select>
                        <input class="form-control my-1 btn btn-dark text-white" type="submit" value="Submit">
                    </div>
                </form>
            </div>
            <div class="card my-2">
                <div class="card-header">Add University</div>
                <form action="admin/addUniversity" method="POST" class="form-group">
                    @csrf
                    <div class="form-group m-2">
                        <input class="form-control my-1" type="text" name="name" id="university-name" placeholder="University Name">
                        <select class="form-control my-1" name="country" id="university-country">
                            <option value="440">Lithuania</option>
                        </select>
                        <input class="form-control my-1 btn btn-dark text-white" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card my-2">
                <div class="card-header">List of Studies</div>
                <div>
                    <table class="table table-striped my-2">
                        @foreach ($faculties as $faculty)
                            <thead class="thead-dark">
                                <th>{{ $faculty->id }}</th>
                                <th>{{ $faculty->getUniversity->name }}</th>
                                <th>{{ $faculty->name }}</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($faculty->getStudies as $studies)
                                    <tr>
                                        <td></td>
                                        <td>{{ $studies->id }}</td>
                                        <td>{{ $studies->name }}</td>
                                        <td>Year</td>
                                    </tr>
                                    @foreach ($studies->curriculum as $curriculum)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $curriculum->name }}</td>
                                            <td>{{ $curriculum->year }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card my-2">
                    <div class="card-header">Recent Uploads</div>
                    <div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <th>ID</th>
                                <th>Name</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($documents as $doc)
                                    <tr>
                                        <th>{{ $doc->id }}</th>
                                        <th>{{ $doc->name }}</th>
                                        <th>{{ $doc->user_id ?? '-' }}</th>
                                        <th>{{ $doc->type }}</th>
                                        <th>
                                            <a href="/document/{{ $doc->id }}" class="btn btn-pill btn-primary float-right">Download</a>
                                        </th>
                                        <th>
                                            <a href="/document/delete/{{ $doc->id }}" class="btn btn-pill btn-danger float-right">Delete</a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
