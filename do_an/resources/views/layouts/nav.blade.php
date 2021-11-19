<div class="logo">
  <a class="no-underline" href="{{route('home')}}">
    Bkgram
  </a>
</div>
  @guest
  <div class="navigation-icons">
    @if(Route::has('login'))
      <a href="{{ route('login') }}" class="navigation-link" style = "margin-right: 20px"> {{ __('Login') }}</a>
    @endif
    @if(Route::has('register'))
      <a href="{{ route('register') }}" class="navigation-link"> {{ __('Register') }}</a>
    @endif
</div>
  @else
<div class="navigation-search-container">
  <form action="{{route('search')}}" method="POST">
    @csrf
    <i class="fa fa-search"></i>
    <input class="search-field" name="search" type="text" placeholder="Search">
    <div class="search-container">
      <div class="search-container-box">
        <div class="search-results">
        </div>
      </div>
    </div>
  </form>
</div>
<div class="navigation-icons">
  <a href="{{route('home')}}" class="navigation-link">
    <i class="far fa-compass">
      <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
<path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
</svg>
    </i>
  </a>
  <a class="navigation-link notifica">
    <i class="far fa-heart">
      <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
<path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg>
    </i>
  </a>
  <a href="{{route('user.show', Auth::user()->id)}}" class="navigation-link">
    <i class="far fa-user-circle"> 
      <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
    </i>
  </a>
  <div class="logout">
    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" id="signout" class="navigation-link">   
      <i class="fas fa-sign-out-alt" >
        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
  </svg>
      </i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>
  @endguest
</div>
