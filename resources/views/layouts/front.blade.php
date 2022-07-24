<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

   <!--     Fonts and icons     -->
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" 
    rel="stylesheet">
    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

   {{-- font awesome --}}
   <link rel="stylesheet" href="{{asset('frontend/fontsAwesome/all.min.css')}}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

     {{-- <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}" defer></script>  --}}
  <script  src="https://code.jquery.com/jquery-3.6.0.min.js"
	  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	  crossorigin="anonymous"></script>
      <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" defer></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
     
    
   
</head>
<body >
    @include('layouts.inc.frontnavbar')
   
    <div class="content">
        @yield('content')
    </div>
    <div class="whatsapp">
        <a href="https://wa.me/923028801750" target="_blank">
            <img src="{{asset('assets/images/whatsapp.png')}}" alt="">
        </a>
    </div>
     <!-- Scripts -->
     {{-- <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}" defer></script>  --}}
    
     <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>
     <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" defer></script>
     <script src="{{ asset('frontend/js/custom.js') }}" defer></script>
     <script src="{{ asset('frontend/js/checkout.js') }}" defer></script>
     <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> 
     
    

      <script>
          $.ajax({
            type: "GET",
            url: "/product-list",
         
            success: function (response) {
                // console.log(response);
                complete(response);
            }
          });
          function complete(ava){

          
           $('#product_search').autocomplete({
              source:ava
           });
        }
        
      </script>


    
      <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/62dcfa3254f06e12d88b0743/1g8nj2mai';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
     @if (session('status'))
     <script>swal("{{session('status')}}");</script> 
     @endif
     
     @yield('scripts')
</body>
</html>
