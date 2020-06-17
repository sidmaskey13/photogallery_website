@extends('admin.default')

@section('page-header')
    {!! $name !!} <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
    {!! Form::model($item,[
            'url' => url($url.$item->id),
            'files' => true,
            'method' =>'PUT'
        ])
    !!}

    @include($view.'.form')

    <button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

    {!! Form::close() !!}

@stop
