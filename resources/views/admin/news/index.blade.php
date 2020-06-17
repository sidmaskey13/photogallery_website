@extends('admin.default')

@section('page-header')
    {{ trans('app.Notice') }}/{{ trans('app.News') }} <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ url($url.'create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>

                <th>सूचना/समाचार</th>
                <th>सुरु मिति</th>
                <th>समाप्ति मिति</th>
                <th>विकल्प</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>सूचना/समाचार</th>
                <th>सुरु मिति</th>
                <th>समाप्ति मिति</th>
                <th>विकल्प</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>

                            @php
                            $string = strip_tags($item->content);
                            if (strlen($string) > 170) {

                            // truncate string
                            $stringCut = substr($string, 0, 100);
                            $endPoint = strrpos($stringCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            }
                            @endphp
                            {{ $string }}
                    </td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->end_date }}</td>
                    <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="{{ url($url.$item->id) }}" title="{{ trans('app.show_title') }}" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ url($url.$item->id."/edit") }}" title="{{ trans('app.edit_title') }}" class="btn btn-warning btn-sm"><span class="ti-pencil"></span></a>
                            </li>
                            <li class="list-inline-item">
                                {!! Form::open([
                                   'class'=>'delete',
                                   'url'  => url($url.$item->id),
                                   'method' => 'DELETE',
                                   ])
                               !!}
                                <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection