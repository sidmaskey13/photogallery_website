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
					<td>Content :</td>
					<td>{{$item->content}}</td>

				</tr>
				<tr>
					<td>Start Date :</td>
					<td>{{$item->start_date}}</td>
				</tr>
				<tr>
					<td>End Date :</td>
					<td>{{$item->end_date}}</td>
				</tr>
			</tbody>

		</table>
	</div>
@stop
