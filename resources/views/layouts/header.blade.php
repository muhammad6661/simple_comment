<header id="header">
    <div class="p-0 container-fluid navbar navbar-expand-lg navbar-light">
        <button class="btn navbar-brand d-lg-none d-inline-block p-0 ">
            <svg class="left-nav-open d-md-none d-inline-block" width="22" height="18"
                viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line y1="1" x2="22" y2="1" stroke="#1A73E8" stroke-width="2" />
                <line y1="9" x2="22" y2="9" stroke="#1A73E8" stroke-width="2" />
                <line y1="17" x2="22" y2="17" stroke="#1A73E8" stroke-width="2" />
            </svg>
            <a href="" class="ml-3">
                <img src="/public/frontent/images/logo/logo.svg" alt="">
            </a>
        </button>
        <button class="navbar-toggler border-0 p-0" type="button" data-toggle="collapse"
            data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
            aria-label="Toggle navigation">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M20 6L10 6" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M20 12L4 12" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M20 18L14 18" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <div class=" justify-content-between align-items-center collapse navbar-collapse"id="navbarScroll">
            <nav aria-label="navbar" class="d-flex justify-content-center col-lg-8 mt-lg-0 mt-3">
                <ul class="navbar-nav" >
                    <li class="nav-item active" aria-current="page"><a  class= "@yield('posts')" id="nav-link" href="/posts">Posts and articles</a></li>
                    @if (Auth::check())
                    <li class="nav-item " aria-current="page"><a class= "@yield('myposts')" id="nav-link" href="/myposts">My posts</a></li>
                    @endif
                </ul>
            </nav>

            @if (Auth::check())
                <div class="natification d-flex justify-content-end align-items-center col-lg-4 col-12">
                    <div class="dropdown  mx-3">


                    </div>

                    <div class="profile_header">
                        <button href="" class="btn p-0 log-inf" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="image-avatar">
                                <img src='/public/uploads/users/{{ Auth::user()->avatar != '' ? Auth::user()->avatar : 'default-avatar.jpg' }}'
                                    class="img-fluid" alt="">
                            </div>
                            @if (Auth::check())

                            <h6>{{ Auth::user()->name . ' ' . Auth::user()->surname }}</h6>
                            @endif
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/myprofile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Profile</span>
                            </a>
                            <a class="dropdown-item" href="/logout">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Log out</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="wrapper-links d-flex justify-content-center">
                    <div class="">
                        <a href="/sign-in" class="btn btn-login">Login</a>
                        <a href="/sign-up" class="btn btn-sing-up mt-lg-0">Sign Up</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</header>
<style>
    .navbar-nav li {
       margin-left: 20px;
    }
    a#nav-link {
        font-size: 18px;
line-height: 22px;
color: rgba(0, 0, 0, 0.5);
    }
    a#nav-link.active {
        color: #00B08B
    }
</style>
