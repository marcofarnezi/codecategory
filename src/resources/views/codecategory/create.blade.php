@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Create Category</h3>

        {!! Form::open(['method' => 'post', 'route' => 'admin.categories.store']) !!}
            <div class="form-group">
                {!! Form::label('Parent', 'Parent:') !!}
                <select name="parent_id" class="form-control">
                    <option value="">-None-</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                {!! Form::label('Name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => "form-control"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Active', 'Active:') !!}
                {!! Form::checkbox('active', null, ['class' => "form-control"]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit("Submit", ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection