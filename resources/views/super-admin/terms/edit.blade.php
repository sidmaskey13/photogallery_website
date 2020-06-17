@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Terms and Condition</h1>
        <form method="POST" action="{{route('terms.update',$terms->id)}}">
            {{@csrf_field()}}
            {{method_field('PUT')}}
            <div class="row">
                <div class="col-md-8">
                    <label for="info">Info:</label>
                    <textarea class="info" name="info" id="info" rows="5">{{$terms->body}}</textarea>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        CKEDITOR.replace( 'info' );
    </script>
@stop
