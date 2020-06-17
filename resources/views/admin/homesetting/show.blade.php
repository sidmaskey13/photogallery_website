@extends('admin.default')

@section('page-header')
	{!! $name !!} <small>detail</small>
@stop

@section('content')
	<div class="mB-20">
		<a href="{{ url($url) }}" class="btn btn-info">
			{{ trans('app.back_button') }}
		</a>
	</div>
	<div class="bgc-white bd bdrs-3 p-20 mB-20">
		<table  class="table table-striped table-bordered" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td>Title :</td>
					<td>{{$item->title}}</td>
				</tr>

				<tr>
					<td>Video URL:</td>
					<td>{{$item->url}}</td>
				</tr>
			</tbody>

		</table>
	</div>
@stop
