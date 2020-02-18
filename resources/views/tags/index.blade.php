@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tag List</div>

                    <div class="card-body">
                        @if($tags->count() > 0)
                            <ul class="list-group">
                                @foreach ($tags as $tag)
                                    <li class="list-group-item">
                                        {{ $tag->name }}
                                        <a onclick="handleDelete({{ $tag->id }})" class="btn btn-danger float-right btn-sm" style="color: white">Delete</a>
                                        <a href= "{{ route('tags.edit', $tag->id) }}" class="btn btn-info mr-2 float-right btn-sm" style="color: white" >Edit</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h3 class="text-center">No Tags Yet.</h3>
                        @endif
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="" method="POST" id="deleteTagForm">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center text-bold">Are you sure you want delete this tag?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
