<link rel="stylesheet" href="{{ asset('css/pagelayoutcss.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<style>
    #resizable {
        float: left;
        width: @if($width)
             {{$width}}%;
        @else
        400px;
        @endif
        background: #efecec;
        height: 400px;
    }

    #sec2 {
        height: @if($height)
                    {{$height}}%;
                @else
                    125px;
                @endif

    #sec3 {
        height:{{ $sec3 }}%;
        max-height:100%;
    }

</style>

<div style="margin-left:100px">
        <div class="container">
            <div id="page" class="row">
                <div id="wrapper" class="col-lg">
                    <div id="resizable">
                        <button id="1" style="margin-top: 150px;" class="btn btn-info postion1">{{ trans('app.Add New Content') }}</button>
                    </div>
                    <div id="content">
                        <div id="sec2" class="row bdwn">
                            <button id="2" style="margin: auto;width:145px;" class="btn btn-info postion1">{{ trans('app.Add New Content') }}</button>
                        </div>
                        <div id="sec3" style="text-align: center;" class="row">
                            <button id="3" style="margin-top: 50px;margin-left: 108px;width:145px;" class="btn btn-info postion1">{{ trans('app.Add New Content') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--dialog box--}}
<div id="dialog-form"  title="{{ trans('app.Add New Content') }}">
    <p class="validateTips">{{ trans('app.All Field') }}</p>

    <div id="addForm">
     {{--{!! Form::open([--}}
        {{--'url' => url($urlSetting),--}}
        {{--'files' => true--}}
            {{--])--}}
        {{--!!}--}}
        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
        <form id="formAdd" class="form-horizontal" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input id="inputPosition" type="hidden" name="position" value="1">
            @include($viewSetting.'.form')
            <button type="submit" class="btn btn-primary add-model">{{ trans('app.Add') }}</button>
        </form>
        {{--{!! Form::close() !!}--}}
    </div>


    <hr>
    {{--///--}}

    {{--all data--}}
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
        </tfoot>
        <tbody>
        <div style="display:none" class="text-center" id='loadingDiv'>
            Please wait...
            <br>
            <img id="loading-image" src='{{ asset('images/ajax-loader.gif') }}' />
        </div>
        @foreach ($items as $item)
            <tr id="item-{{$item->id}}">
                <td style="display:none" class="ccol">{{ config('custom.positions')[$item->position ]}}</td>
                <td>
                    @php
                        $string = strip_tags($item->title);
                        if (strlen($string) > 50)
                        {
                            // truncate string
                            $stringCut = substr($string, 0, 35);
                            $endPoint = strrpos($stringCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                        }
                    @endphp
                    {{ $string }}
                </td>
                <td>{{ $item->type }}</td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{ url($urlSetting.$item->id) }}" title="{{ trans('app.show_title') }}" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
                        </li>
                        <li class="list-inline-item">
                            <button class="edit-modal btn btn-info" data-id="{{$item->id}}">
                                <span class="ti-pencil"></span>
                            </button>

{{--                            <a href="{{ url($urlSetting.$item->id."/edit") }}" title="{{ trans('app.edit_title') }}" class="btn btn-warning btn-sm"><span class="ti-pencil"></span></a>--}}
                        </li>
                        <li class="list-inline-item">
                            <button class="btn btn-danger btn-sm delete-model" title="{{ trans('app.delete_title') }}" data-name="{{$item->title}}" data-id="{{$item->id}}"><i class="ti-trash"></i></button>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    </div>
</div>

    {{--edit model --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <form id="formEdit" class="form-horizontal" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                        <input type="hidden" class="form-control" id="fid" disabled>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">{{ trans('app.Title') }}</label>
                                <input type="name" name="title" class="form-control" id="n">
                            </div>
                            <div class="form-group">
                                <label for="sel1">{{ trans('app.Type') }} :</label>
                                <select class="type form-control" id="typeEdit" name="type" onchange="typeEditChange()">
                                    <option default>--{{ trans('app.Please Select') }}--</option>
                                    <option value="File">{{ trans('app.File') }}</option>
                                    <option value="Content">{{ trans('app.Text') }}</option>
                                    <option value="Url">{{ trans('app.Youtube Link') }}</option>
                                    <option value="ImageFile">{{ trans('app.Multiple Image File') }}</option>
                                </select>
                            </div>

                            <div class="AllEditContent">
                                {{--//content according combo box--}}
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn actionBtn">
                                <span id="footer_action_button" class='glyphicon'> </span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        /* {{--for  sec 1 resize--}} */
        $(function () {
            $("#resizable").resizable({
                handles: "e"
            }, {
                resize:function(event, ui){
                    var parent = ui.element.parent();
                    var per =Math.round(ui.size.width/ parent.width() * 100);
                    if(per < 20){
                        console.log('hide');
                        $('#btn1').css({
                            display: 'none'
                        });
                    }else{
                        $('#btn1').css({
                            display: 'block'
                        });
                        $('#resizable').css({
                            backgroundColor:'#efecec'
                        });
                    }
                }
            },{
                maxWidth: 900,
                minWidth: 10
            }, {
                containment: "#wrapper"
            }, {
                stop: function (event, ui) {
                    var parent = ui.element.parent();
                    var per =Math.round(ui.size.width / parent.width() * 100);
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/setscreen') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            'section':1,
                            'sendWidth': per,
                        }
                    });
                }
            });
        });

        //for sec 2 resize
        $(function () {
            $("#sec2").resizable({
                resize:function(event, ui){
                    var parent = ui.element.parent();
                    var per =Math.round(ui.size.height/ parent.height() * 100);
                    if(per < 20){
                        console.log('hide');
                        $('#btn2').css({
                            display: 'none'
                        });
                    }else{
                        $('#btn2').css({
                            display: 'block'
                        });
                        $('#sec2').css({
                            backgroundColor:'#efecec'
                        });
                    }
                }
            },{
                handles: "s"
            }, {
                maxHeight: 380,
                minHeight: 0,
            },{
                stop: function (event, ui) {
                    var parent = ui.element.parent();
                    var per =Math.round(ui.size.height/ parent.height() * 100);
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/setscreen') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            'section':2,
                            'sendHeight': per
                        }
                    });
                }
            });
        });

        {{--//for dialog form--}}
        $( function() {
            dialog2 = $("#dialog-form").dialog({
                autoOpen: false,
                height: 500,
                width: 900,
            });
            $(".postion1").on("click", function () {
                var getvalue = $(this).attr("id");
                var filtervalue = "Position " + $(this).attr("id");
                $('#inputPosition').val('' + getvalue);
                $("#dataTable td.ccol:contains('" + filtervalue + "')").parent().show();
                $("#dataTable td.ccol:not(:contains('" + filtervalue + "'))").parent().hide();
                dialog2.dialog("open");
            });
        });

        //Add
        var show_Title = "{{ trans('app.show_title') }}";
        var delete_Title = "{{ trans('app.delete_title') }}";
        var urlSection = "{{ url('admin/sections/') }}";

        $('form#formAdd').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type:'POST',
                url: "{{ url('admin/addItem') }}",
                data: formData,
                contentType : false,
                processData : false,
                success: function (data){
                    document.getElementById("formAdd").reset();
                    typeChange();
                    $('table#dataTable > tbody').prepend(
                        '<tr id="item-'+data.id+'">'+
                        '<td style="display:none" class="ccol">Position '+data.position+'</td>'+
                        '<td>'+data.title.substring(0, 35).trim(this) + "..."+'</td>'+
                        '<td>'+data.type+'</td>'+
                        '<td>'+
                        '<ul class="list-inline">'+
                        '<li class="list-inline-item">'+
                        '<a href="'+urlSection+'/'+data.id+'" title="'+show_Title+'" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>' +
                        '</li>' +
                        '<li class="list-inline-item">' +
                        '<button class="edit-modal btn btn-info" data-id="'+data.id+'">' +
                        '<span class="ti-pencil"></span>' +
                        '</button>' +
                        '</li>' +
                        '<li class="list-inline-item">' +
                        '<button class="btn btn-danger btn-sm delete-model" title="'+delete_Title+'" data-name="'+data.title+'" data-id="'+data.id+'">' +
                        '<i class="ti-trash"></i>' +
                        '</button>' +
                        '</li>' +
                        '</ul>'+
                        '</td>'
                        +'</tr>'
                    );
                },
                beforeSend: function(){
                    $('#loadingDiv').show();
                    $('#formAdd').hide();
                    $('table#dataTable > tbody').hide();
                },
                complete: function(){
                    $('#loadingDiv').hide();
                    $('#formAdd').show();
                    $('table#dataTable > tbody').show();
                },error:function(data){
                    if(data.status == 422){
                        printErrorMsg(data.responseJSON);
                        document.getElementById("formAdd").reset();
                    }
                }
            });
        });

        //error message
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg.errors, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        //ajax for delete
        $(document).on('click','.delete-model',function(){
            var id = $(this).data('id');
            $.ajax({
                type:'DELETE',
                url: "{{ url('admin/deleteItem') }}"+"/"+id,
                data:{
                    _token: "{{ csrf_token() }}",
                },
                success: function (data){
                    $('#item-'+data).remove();
                },
                beforeSend: function(data){
                    $('#loadingDiv').show();
                    $('table#dataTable > tbody').hide();
                    $('#formAdd').hide();
                },
                complete: function(data){
                    $('#loadingDiv').hide();
                    $('table#dataTable > tbody').show();
                    $('#formAdd').show();
                },
            });
        });


        $(document).on('click', '.edit-modal', function() {
            $('#footer_action_button').text(" Update");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Edit');
            $('.deleteContent').hide();
            $('.form-horizontal').show();

            $.ajax({
                url: '{{ url('admin/getItem/') }}'+'/'+$(this).data('id')+'/edit',
                data: { id : $(this).data('id') ,},
                success : function(data){
                    $('#fid').val(data[0].id);
                    $('#n').val(data[0].title);
                    $('select#typeEdit').val(data[0].type);
                    typeEditChange();
                    if (data[0].type == 'Url') {
                        $('#EditUrl').val(data[0].content);
                        $('#showUrlEdit').attr('href',data[0].content);
                    } else if (data[0].type == 'Content'){
                        $('#EditText').val(data[0].content);
                    } else if (data[0].type == 'File'){
                        $('#showPdfEdit').attr('href',data[0].content);
                    } else if (data[0].type == 'ImageFile') {
                        var getImage = data[0].imagedetails;
                        getImage.forEach(function(n){
                            $('#showMultipleImage').append('' +
                                '<div class="col-md-3">\n' +
                                '<a href='+n.file_details+' target="_blank"><img class="img-thumbnail" src='+n.file_details+'/></a>\n' +
                                '</div>');
                        });
                    }
                    $('#myModal').modal('show');
                },
            });

        });

        //update
        $('form#formEdit').on('click', '.edit', function(event) {
            event.preventDefault();
            var ids= $("#fid").val();
            var formData = new FormData($('form#formEdit')[0]);
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{ url('admin/updateSec')}}"+"/"+ids,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#myModal').modal('hide');
                    $('#loadingDiv').show();
                    $('table#dataTable > tbody').hide();
                    $('#formAdd').hide();
                },
                complete: function(data){
                    $('tr#item-'+data.responseJSON.id+' td:nth-child(2)').text(data.responseJSON.title.substring(0, 35).trim(this) + "...");
                    $('tr#item-'+data.responseJSON.id+' td:nth-child(3)').text(data.responseJSON.type);
                    $('#loadingDiv').hide();
                    $('table#dataTable > tbody').show();
                    $('#formAdd').show();
                    $('tr#item-'+data.responseJSON.id).fadeOut(800, function(){
                        $('tr#item-'+data.responseJSON.id).fadeIn().delay(1000);
                    });
                },
            });
        });

        //edit
        var urlEditDiv ='<label for="content2">Youtube Url :</label>\n' +
            '\t<textarea id="EditUrl" name="content" class="form-control">\n' +
            '</textarea>\n' +
            '<br>' +
            '<label for="">Check Saved Url</label>\n' +
            '<a id="showUrlEdit" href="" target="_blank">click here</a><br>';

        var fileEditDiv ='<label>Select PDF File :</label>\n' +
            '\t<input id="EditPdf" type="file" name="content">\n' +
            '<br>' +
            '<label for="">Pervious File</label>'+
            '<a id="showPdfEdit" href="" target="_blank">click here</a>';

        var textEditDiv = '<label for="content1">Text Content :</label>\n' +
            '\t<textarea id="EditText" name="content" class="form-control">\n' +
            '</textarea>\n' +
            '<br>';

        var imageEditDiv = '<label>Select Multiple Image File:</label>\n' +
            '<input id="editImageFile" type="file" name="content[]" multiple>\n' +
            '<br>'+
            '<div id="showMultipleImage" class="row"></div>';

        function typeEditChange(){
            var selection = $('#typeEdit').val();
            switch(selection){
                case "File":
                    $(".AllEditContent").children().remove();
                    $(".AllEditContent").html(fileEditDiv);
                    break;
                case "Content":
                    $(".AllEditContent").children().remove();
                    $(".AllEditContent").html(textEditDiv);
                    break;
                case "Url":
                    $(".AllEditContent").children().remove();
                    $(".AllEditContent").html(urlEditDiv);
                    break;
                case "ImageFile":
                    $(".AllEditContent").children().remove();
                    $(".AllEditContent").html(imageEditDiv);
                    break;
                default:
                    $(".AllEditContent").children().remove();
                    break;
            }
        }
    </script>


