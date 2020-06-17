@extends('admin.default')

@section('content')
    <div class="mB-20">
        <a href="{{ url('/admin') }}" class="btn btn-info">
            {{ trans('app.back_button') }}
        </a>
    </div>

    {!! Form::model($item,[
            'url' => url($url.$item->id),
            'files' => true,
            'method' =>'PUT'
        ])
    !!}

    <h3 style="display:none;">{{ $item->type }}</h3>
    @if($item->type == 'Url')
        <h4 id="getTypeData" style="display: none;">{{ $item->content }}</h4>
    @elseif($item->type == 'File')
        <h4 id="getTypeData" style="display: none;">{{ $item->content }}</h4>
    @elseif($item->type == 'ImageFile')
        <h4 id="getTypeData" style="display: none;">{{ $item->content }}</h4>
    @elseif($item->type == 'Content')
        <h4 id="getTypeData" style="display: none;">{{ $item->content }}</h4>
    @endif

    <input type="hidden" name="position" value="{{ $item->position }}">

    {!! Form::myInput('text', 'title', "{{ trans('app.Title') }}") !!}


    <div class="form-group">
        <label for="sel1">{{ trans('app.Type') }} : </label>
        <select class="form-control" id="type1" name="type" onchange="typeChange()">
            <option default>--{{ trans('app.Please Select') }}--</option>
            <option value="File">{{ trans('app.File') }}</option>
            <option value="ImageFile">{{ trans('app.Multiple Image File') }}</option>
            <option value="Content">{{ trans('app.Text') }}</option>
            <option value="Url">{{ trans('app.Youtube Link') }}</option>
        </select>
    </div>

    <div style="display:none;" class="file">
        @if($item->type == 'File')
            <label for="">Pervious File</label>
            <a href="{{ $item->content }}" target="_blank">click here</a>
        @endif
        <hr>
        <label>Select File :</label>
        <input type="file" name="content1">
        <br>
    </div>

    <div style="display:none;" class="Imagefile">
        <label>Select File :</label>
        <input type="file" name="content2[]" multiple>
        <hr>
        @if($item->type == 'ImageFile')
            <label for="">Saved Image</label>
            <div class="row">
                @foreach($item->Imagedetails as $image)
                    <div class="col-md-3">
                        <img class="img-thumbnail" src="{{ $image->file_details }}" />
                    </div>
                @endforeach
            </div>
        @endif
        <br>
    </div>

    <div style="display:none;" class="SectionContent">
        <label for="content1">Text Content :</label>
        <textarea rows="20" id="content1" name="content3" class="form-control">
        </textarea>
        <br>
    </div>

    <div style="display:none;" class="url">
        <label for="content2">Youtube Url :</label>
        <input type="text" id="content2" name="content4" class="form-control"/>
        <hr>
        @if($item->type == 'Url')
            <label for="">Check Saved Url</label>
            <a href="{{ $item->content }}" target="_blank">click here</a>
        @endif
        <hr>

    </div>

    <button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>

    {!! Form::close() !!}

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​

    <script>

        $('select').val($('h3').text());

        typeChange();

        if ($('select').val() == 'Url') {
            $('#content2').text($('#getTypeData').text());
        }
        else if ($('select').val() == 'Content'){
            $('#content1').val($('#getTypeData').text());
        }

        function typeChange(){
            var selection = $('#type1').val();
            console.log(selection);
            switch(selection){
                case "File":
                    $(".file").show();
                    $(".SectionContent").hide();
                    $(".Imagefile").hide();
                    $(".url").hide();
                    break;
                case "Content":
                    $(".SectionContent").show();
                    $(".file").hide();
                    $(".url").hide();
                    $(".Imagefile").hide();
                    break;
                case "Url":
                    $(".url").show();
                    $(".file").hide();
                    $(".Imagefile").hide();
                    $(".SectionContent").hide();
                    break;
                case "ImageFile":
                    $(".Imagefile").show();
                    $(".url").hide();
                    $(".file").hide();
                    $(".SectionContent").hide();
                    break;
                default:
                    $(".url").hide();
                    $(".file").hide();
                    $(".Imagefile").hide();
                    $(".SectionContent").hide();
                    break;
            }
        }
    </script>
@stop
