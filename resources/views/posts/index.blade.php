@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ asset('storage/'.$post->image) }}" width="100px" height="100px" alt=""></td>
                            <td class="align-middle">{{ $post->title }}</td>
                            <td class="align-middle">
                                <a href="" class="btn btn-info btn-sm">Edit</a>
                                <a href="" class="btn btn-danger btn-sm">Trash</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
