<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
				<label for="">Office name and Address</label>
				{!! Form::text('ofc', $ofc,array('class' => 'form-control')); !!}

				{!! Form::myInput('text', 'name', 'Username') !!}
		
				{!! Form::myInput('email', 'email', 'Email') !!}
		
				{!! Form::myInput('password', 'password', 'Password') !!}
		
				{!! Form::myInput('password', 'password_confirmation', 'Password again') !!}
		
{{--				{!! Form::mySelect('role', 'Role', config('variables.role'), null, ['class' => 'form-control select2']) !!}--}}
					{!! Form::myFile('avatar', 'User Icon') !!}
				{{-- {{ dd(file_exists(public_path().$item->avatar)) }} --}}
					@if(file_exists(public_path().$item->avatar))
					<label>Avatar logo</label>
					<a href="{{ $item->avatar }}" target="_blank"> Click to view Saved Icon</a>
				@endif
		</div>  
	</div>
</div>