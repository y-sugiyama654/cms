@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Edit Categories</div>
                    <div class="card-body">

                        <!-- エラーメッセージ -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <div class="list-group">
                                    @foreach ($errors->all() as $error)
                                        <div class="list-group-item">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <form action="/categories/{{ $category->id }}/update" method="POST">
                            @csrf
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
