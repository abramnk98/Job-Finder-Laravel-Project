@extends('admin.layout.app')

@section('sidebar')
    @include('admin.layout.sidebar')
@endsection

@section('page-title', '| Services')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Services</h1>
        <div class="text-end">
            <a class="btn btn-primary" href="{{route('admin.services.create')}}">Create Service</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @php ($i = 1)
            @foreach($services as $service)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$service->name}}</td>
                    <td>{{$service->description}}</td>
                    <td>
                        <a class="btn btn-success" href="{{route('admin.services.edit', ['service' => $service->id])}}">Edit</a>
                        <form action="{{route('admin.services.destroy', ['service' => $service->id])}}" method="post">
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
