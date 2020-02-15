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
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
