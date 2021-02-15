<div class="form-group">
    {{ Form::label('title', 'Title:') }}
    {{ Form::text('title', null, ['class' => 'form-control']) }}
</div>

<div class="form-group mb-3">
    {{ Form::label('body', 'Body:') }}
    {{ Form::textarea('body', null, ['class' => 'form-control']) }}
</div>

<div class="form-group mb-3">
    {{ Form::label('tags', 'Tags:') }}
    {{ Form::select('tags[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) }}
</div>

<div class="form-group mb-3">
    {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) }}
</div>

@section('footer');

    <script>
        $('#tag_list').select2({
            placeholder: 'Choose a tag',
        });
    </script>
@endsection