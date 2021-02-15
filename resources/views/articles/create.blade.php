@extends('app')

@section('content')
    <h1>Write a new article</h1>

    <hr/>

    {{ Form::open(['url' => 'articles']) }}
        @include ('articles.form', ['submitButtonText' => 'Создать статью'])    
    {{ Form::close() }}

    @include ('errors.list')

@stop