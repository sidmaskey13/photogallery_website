@extends('admin.default')

@section('page-header')
    <h1>परिमार्जन गर्नुहोस्</h1>
@stop

@section('content')
    {!! Form::model($item,[
            'url' => url($url.$item->id),
            'files' => true,
            'method' =>'PUT'
        ])
    !!}

    <div class="row mB-40">
        <div class="col-sm-8">
            <div class="bgc-white p-20 bd">
                <label for="">सूचना/समाचार</label>
                <input type="text" class="form-control" name="content" value="{{ $item->content }}">
                <br>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::myInput('Date', 'start_date', 'सुरु मिति') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::myInput('Date', 'end_date', 'समाप्ति मिति') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('app.Save') }}</button>

    {!! Form::close() !!}

@stop
