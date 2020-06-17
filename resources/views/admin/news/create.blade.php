@extends('admin.default')

@section('page-header')
	{!! trans('app.'.$name )!!} <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!!
	Form::open([
	'url' => url($url),
	'files' => true
		])
	!!}

	@include($view.'.form')
	<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

@stop
