@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">Create Post</div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <lavel for="title">Title</lavel>
                    <input type="text" class="form-control" name="title" id="title">
                </div>

                <div class="form-group">
                    <lavel for="description">Description</lavel>
                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <lavel for="content">Content</lavel>
                    <textarea class="form-control" name="content" id="content" cols="5" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <lavel for="published_at">Published At</lavel>
                    <input type="text" class="form-control" name="published_at" id="published_at">
                </div>

                <div class="form-group">
                    <lavel for="image">Image</lavel>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create Post </button>
                </div>
            </form>
        </div>
    </div>
@endsection
