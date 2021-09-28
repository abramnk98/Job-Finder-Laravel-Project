@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.sidebar')
@endsection

@section('page-title', '| Team')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Team</h1>
        <div class="text-end">
            <a class="btn btn-primary" href="{{route('admin.team.create')}}">Create Member</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Job</th>
                    <th scope="col">photo</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @php ($i = 1)
            @foreach($team as $member)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td><img src="{{asset('assets/images/team/'.$member['photo'])}}" width="50px"></td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->job}}</td>
                    <td>
                        <a class="btn btn-success" href="{{route('admin.team.edit', ['team' => $member->id])}}">Edit</a>
                        <form action="{{route('admin.team.destroy', ['team' => $member->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
