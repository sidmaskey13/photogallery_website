
{!! Form::myInput('text', 'title', "{{ trans('app.Title') }}") !!}


<div class="form-group">
	<label for="sel1">{{ trans('app.Type') }} : </label>
	<select class="form-control" id="AddType" name="type" onchange="typeChange()">
		<option default>--{{ trans('app.Please Select') }}--</option>
		<option value="File">{{ trans('app.File') }}</option>
        <option value="ImageFile">{{ trans('app.Multiple Image File') }}</option>
		<option value="Content">{{ trans('app.Text') }}</option>
		<option value="Url">{{ trans('app.Youtube Link') }}</option>
	</select>
</div>

<div class="AllContent">

</div>
‌​
<script src="{{ asset('js/jquery-1.8.2.min.js') }}"></script>
<script>

    var urlDiv ='<label for="content2">Youtube Url :</label>\n' +
        '\t<textarea id="addItem4" name="content" class="form-control">\n' +
        '</textarea>\n' +
        '<br>';
    var fileDiv ='<label>Select PDF File :</label>\n' +
                '\t<input id="addItem1" type="file" name="content">\n' +
                '<br>';
    var textDiv = '<label for="content1">Text Content :</label>\n' +
                    '\t<textarea id="addItem3" name="content" class="form-control">\n' +
                    '</textarea>\n' +
                    '<br>';
    var imageDiv = '<label>Select Multiple Image File:</label>\n' +
                    '<input id="addItem2" type="file" name="content[]" multiple>\n' +
                    '<br>';

        function typeChange(){
        var selection = $('#AddType').val();
        switch(selection){
            case "File":
                $(".AllContent").children().remove();
                $(".AllContent").html(fileDiv);
                break;
            case "Content":
                $(".AllContent").children().remove();
                $(".AllContent").html(textDiv);
				break;
            case "Url":
                $(".AllContent").children().remove();
                $(".AllContent").html(urlDiv);
                break;
            case "ImageFile":
                $(".AllContent").children().remove();
                $(".AllContent").html(imageDiv);
                break;
            default:
                $(".AllContent").children().remove();
                break;
        }
    }
</script>
