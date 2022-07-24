<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a href="" class="navbar-brand">
            E-shop
        </a>
        <div class="search-bar">
            <div class="input-group ">
                <input type="search" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
              </div>
              
        </div>
     
          
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNav" class="collapse navbar-collapse">
           <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                 <a href="" class="nav-link">Home</a>
              </li> 
             
              <li class="nav-item">
                 <a href="{{url('category')}}" class="nav-link">Category</a>
              </li> 
              <li class="nav-item">
                 <a href="{{url('cart')}}" class="nav-link">Cart <i class="fa fa-shopping-cart"><sup class="badge badge-pill bg-primary cart-count">0</sup></i>
                
                </a>
              </li> 
              <li class="nav-item">
                 <a href="{{url('wishlist')}}" class="nav-link">Wishlist <i class="fa fa-heart"><sup class="badge badge-pill bg-success wishlist-count">0</sup></i>
                    
                </a>
              </li> 
              <li class="nav-item">
                 <a href="" class="nav-link">about</a>
              </li>
              @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>    
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="" class="dropdown-item">
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{url('my-order')}}" class="dropdown-item">
                                    My Orders
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"  href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">  {{ __('Logout') }}
                                </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                      @csrf
                                 </form>
                            </li>
                    
                           
                        </ul>
                     
              </li> 
              @endguest
           </ul>  
         
        </div>

    </div>
</div>