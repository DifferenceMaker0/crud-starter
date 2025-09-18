<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header"> 
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="/posts">Blog</a></li>
          
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        </ul>

        @guest
        @endguest
        

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">  
            <li><a href="/dashboard">Dashboard</a></li> 
                <li><a href="/posts/create">Create Post</a></li>
            <li> 
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li> 
        </ul>


    @auth  
        Welcome, {{ auth()->user()->name }}! Your ID is {{ auth()->user()->id }}. 
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul> 
            <li class="dropdown"> </li>  
            <!-- Authentication Links -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
                {{ auth()->user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu"></ul> 
        </div>
    @else
        Please log in.
    @endauth

    </div>
</nav>