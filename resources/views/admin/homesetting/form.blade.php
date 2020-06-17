<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">

			{!! Form::myInput('text', 'key', 'Key') !!}
			{{--{!! Form::select('Type', array('Image ,Doc,Pdf'=>'file','For Video'=>'video','For Content'=>'content')) !!}--}}

			<div class="form-group">
				<label for="sel1">Type :</label>
				<select class="form-control" id="type1" name="type">
					<option default>--Please Select--</option>
					<option value="Text">Text</option>
					<option value="Image">Image</option>
				</select>
			</div>

			<div style="display:none;" id="Image">
				<label>Select File :</label>
				<input type="file" name="content">
			</div>

			<div style="display:none;" id="Text">
				<label for="content1">Content :</label>
				<textarea id="content1" name="value" class="form-control">
				</textarea>
			</div>

		</div>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​
<script>
    $('#type1').change(function(){
        var selection = $(this).val();
        switch(selection){
            case "Image":
                $("#Image").show();
                $("#Text").hide();
                break;
            case "Text":
                $("#Text").show();
                $("#Image").hide();
                break;
			default:
                $("#Image").hide();
                $("#Text").hide();
        }
    });
</script>