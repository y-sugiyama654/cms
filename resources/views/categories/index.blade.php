@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Category List</div>

                    <div class="card-body">

                        <ul class="list-group">
                            @foreach ($categories as $category)
                            <li class="list-group-item">
                                {{ $category->name }}
                                <a href= "/categories/{{ $category->id }}/delete" class="btn btn-danger float-right btn-sm">Delete</a>
                                <a href= "{{ route('categories.edit', $category->id) }}" class="btn btn-info mr-2 float-right btn-sm">Edit</a>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
