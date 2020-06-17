<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{url('/')}}">
        <img src="{{url('ntb.png')}}" width="70" height="35" class="d-inline-block align-top" alt="">
        NTB
        <div class="dropdown">
            <a class="dropbtn">Categories</a>
            <div class="dropdown-content">
                @foreach ($categories as $category)
                    <a href="{{URL::to('/categories/'.$category->id)}}">{{$category->name}}</a>
                @endforeach
            </div>
        </div>
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </a>
</nav>