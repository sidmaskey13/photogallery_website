@extends('admin.default')

@section('page-header')
	{!! $name !!} <small>detail</small>
@stop

@section('content')
	<div class="mB-20">
		<a href="{{ url('/admin') }}" class="btn btn-info">
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
					<td>Type :</td>
					<td>{{$item->type}}</td>
				</tr>

				<tr>
					<td>content :</td>
					<td>
						@if($item->type != "Content" && $item->type != "ImageFile")
							<a href="{{$item->content}}" target="_blank">Click here</a>
						@elseif($item->type == "Content")
							<textarea cols="150" rows="10" disabled>{{$item->content}}</textarea>
						@elseif($item->type == "ImageFile")
							<div class="row">
							@foreach($item->Imagedetails as $image)
								<div class="col-md-3">
									<img class="img-thumbnail" src="{{ $image->file_details }}" />
								</div>
							@endforeach
							</div>
						@endif
					</td>
				</tr>
			</tbody>

		</table>
	</div>
@stop
