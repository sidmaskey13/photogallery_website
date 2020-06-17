@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Add License</h1>

        <form method="POST" action="{{route('add-license')}}">
            {{@csrf_field()}}
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>Add License:<input type="text" class="form-control" name="name"></td>
                        <td>Type: <select name="type" id="" class="form-control">
                                <option value="">Select One</option>
                                <option value="1">Modification</option>
                                <option value="2">Usage</option>
                            </select>
                        </td>

                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>
@endsection
