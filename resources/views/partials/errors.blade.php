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
