@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Edit Categories</div>
                    <div class="card-body">

                        <!-- エラーメッセージ -->
                        @include('partials.errors')

                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $category->name }}">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
