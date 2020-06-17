<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li>
                    <a href="{{url('/home')}}">
                        <i class="fa fa-user-shield"></i>
                        <span> Home </span>
                    </a>
                </li>


                {{--Superadmin sidebar--}}
                @role('super-admin')
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-user-shield"></i>
                            <span> Admins </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('/admin/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Admin</a>
                            </li>
                                <li>
                                    <a href="{{url('/admin')}}"><i class="far fa-eye"></i>&nbsp;Show Admins</a>
                                </li>


                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-clipboard-list"></i>
                            <span> Categories </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('/category/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Categories</a>
                            </li>
                                <li>
                                    <a href="{{url('/category')}}"><i class="far fa-eye"></i>&nbsp;Show Categories</a>
                                </li>


                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-lock"></i>
                            <span> Licenses </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('/license/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Licenses</a>
                            </li>
                                <li>
                                    <a href="{{url('/license')}}"><i class="far fa-eye"></i>&nbsp;Show Licenses</a>
                                </li>


                        </ul>
                    </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-lock"></i>
                        <span> Branches </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('/branch/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Branches</a>
                            </li>
                            <li>
                                <a href="{{url('/branch')}}"><i class="far fa-eye"></i>&nbsp;Show Branches</a>
                            </li>


                    </ul>
                </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-unlock"></i>
                            <span> Permissions </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('/permission/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Permissions</a>
                            </li>
                                <li>
                                    <a href="{{url('/permission')}}"><i class="far fa-eye"></i>&nbsp;Show Permissions</a>
                                </li>


                        </ul>
                    </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-lock"></i>
                        <span> Terms and Conditions </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{url('/terms/1')}}"><i class="fas fa-plus-circle"></i> Change Terms</a>
                        </li>


                    </ul>
                </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-user-lock"></i>
                            <span> Roles </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('/role/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Roles</a>
                            </li>
                                <li>
                                    <a href="{{url('/role')}}"><i class="far fa-eye"></i>&nbsp;Show Roles</a>
                                </li>


                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="fa fa-users"></i>
                            <span> Users </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('/users')}}"><i class="far fa-eye"></i>&nbsp;All Users</a>
                            </li>
                                                  </ul>
                    </li>
@endrole


{{--Admin Sidebar--}}
                @role('admin')
                    <li>
                        <a href="javascript: void(0);">
                             <i class="far fa-images"></i>
                            <span> Users Images </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            @if(Auth::user()->branches()->where('branches.id',1)->count() > 0 )
                            <li>
                                <a href="{{url('/branch-select')}}"><i class="fas fa-spinner"></i>&nbsp;New Images Branch</a>
                            </li>
                            @endif

                                <li>
                                    <a href="{{url('/pending-image')}}"><i class="fas fa-spinner"></i>&nbsp;Pending Images</a>
                                </li>
                            <li>
                                <a href="{{url('/approved-image')}}"><i class="fas fa-check"></i>&nbsp;Approved Images</a>
                            </li>
                        </ul>
                    </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="far fa-images"></i>
                        <span> Admin Images </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                        <li>
                            <a href="{{url('/add-image/create')}}"><i class="fas fa-image"></i> Add Images</a>
                        </li>
                        <li>
                            <a href="{{url('/add-image')}}"><i class="fas fa-images"></i> All Admin Images</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="far fa-file"></i>
                        <span> Department </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{url('/branch-image')}}"><i class="fas fa-images"></i>Branch Images</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-video"></i>
                        <span> Videos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        @if(Auth::user()->branches()->where('branches.id',1)->count() > 0 )
                            <li>
                                <a href="{{url('/branch-select-video')}}"><i class="fas fa-spinner"></i>&nbsp;New Videos Branch</a>
                            </li>
                        @endif
                            <li>
                                <a href="{{url('/pending-video')}}"><i class="fas fa-spinner"></i>&nbsp;Pending Videos</a>
                            </li>
                            <li>
                                <a href="{{url('/approved-video')}}"><i class="fas fa-check"></i>&nbsp;Approved Videos</a>
                            </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-pocket"></i>
                        <span> Home Page </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                        <li>
                            <a href="{{url('/homepage')}}">Add to Welcome</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('/verify-users')}}">
                        <i class="fe-pocket"></i>
                        <span> Verify Users </span>
                    </a>
                </li>
@endrole



{{--User Sidebar--}}
                @role('uploader')
                    <li>
                        <a href="javascript: void(0);">
                            <i class="far fa-images"></i>
                            <span> Images </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="{{url('media/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Images</a>
                            </li>
                            <li>
                                <a href="{{url('media')}}">My Image Uploads</a>
                            </li>

                        </ul>
                    </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-video"></i>
                        <span> Videos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{url('video/create')}}"><i class="fas fa-plus-circle"></i>&nbsp;Add Video</a>
                        </li>
                        <li>
                            <a href="{{url('video')}}">My Video Uploads</a>
                        </li>

                    </ul>
                </li>
@endrole



            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
