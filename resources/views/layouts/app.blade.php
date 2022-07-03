<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="manufacturing web app-system" />
        <title>Fleximapp</title>
        <link rel="shortcut icon" href="{{ asset('favicon/fleximapp.ico')}}">
    	<link rel="icon" sizes="16x16 32x32 64x64" href="{{ asset('favicon/fleximapp.ico')}}">
    	<link rel="icon" type="image/png" sizes="196x196" href="{{ asset('favicon/fleximapp-192.png')}}">
    	<link rel="icon" type="image/png" sizes="160x160" href="{{ asset('favicon/fleximapp-160.png')}}">
    	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/fleximapp-96.png')}}">
    	<link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon/fleximapp-64.png')}}">
    	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/fleximapp-32.png')}}">
    	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/fleximapp-16.png')}}">
    	<link rel="apple-touch-icon" href="{{ asset('favicon/fleximapp-57.png')}}">
    	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/fleximapp-114.png')}}">
    	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/fleximapp-72.png')}}">
    	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/fleximapp-144.png')}}">
    	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/fleximapp-60.png')}}">
    	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/fleximapp-120.png')}}">
	    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/fleximapp-76.png')}}">
    	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/fleximapp-152.png')}}">
	    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/fleximapp-180.png')}}">
	    <meta name="msapplication-TileColor" content="#FFFFFF">
	    <meta name="msapplication-TileImage" content="{{ asset('favicon/fleximapp-144.png')}}">
	    <meta name="msapplication-config" content="{{ asset('favicon/browserconfig.xml')}}">
        <link href="{{ asset('css/styles.css')}}" rel="stylesheet" />
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>




        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <div class="navbar-brand ps-3"><a href="{{route('home')}}"><img src="{{ asset('img/Fleximapp.png')}}"></a></div>
            <!-- Sidebar Toggle-->
            @guest
            @else
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
                <i class="fas fa-grip-lines-vertical"></i>
            </button>
            @endguest
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control form-control-sm bg-light border border-secondary border-1 rounded-start" type="text" placeholder="" aria-label=".form-control-sm example" aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-outline-secondary border border-secondary border-1 border-start-0" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                @guest
                @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-light" href="{{ route('login') }}">{{ __('Zaloguj') }}</a>
                                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                        <li><a class="dropdown-item" href="{{ route('profile')}}"><i class="fas fa-user-circle"></i> Mój profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('password.change')}}"><i class="fas fa-key"></i> Zmień hasło</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        {{-- <li>
                            <a class="dropdown-item small" href="#"><h6 class="rediconcolor"><i class="fas fa-bug rediconcolor"></i> Raport błędu</h6></a>
                            {{-- &nbsp;&nbsp;&nbsp;
                            <a href="#"><i class="fas fa-user-secret"></i> privacy</a>
                        </li> --}}

                        @can ('admin')
                        <li><a class="dropdown-item" href="{{ route('panel')}}"><i class="fas fa-users"></i> Panel adm.</a></li>
                        @endcan

                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-share-square"></i> Wyloguj</a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>  
                    </ul>
                </li>
                @endguest
            </ul>
        </nav>
        <div id="layoutSidenav">
        @guest
        @else 
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark sidenav-bg-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">


                            
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#articles" aria-expanded="false" aria-controls="articles">
                                
                                <i class="fas fa-cogs"></i>&nbsp;&nbsp;Technologia
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="articles" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    
                                    
                                    
                                    <a class="nav-link" href="{{route('element.list')}}">
                                        <i class="fas fa-layer-group"></i>&nbsp;&nbsp;Elementy
                                    </a>

                                    <a class="nav-link" href="{{route('article.list')}}">
                                        <i class="fas fa-clone"></i>&nbsp;&nbsp;Artykuły
                                    </a>
                                    <a class="nav-link" href="{{route('product.list')}}">
                                        <i class="fas fa-archive"></i>&nbsp;&nbsp;Produkty
                                    </a>

                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#elements" aria-expanded="false" aria-controls="elements">
                                        <i class="fas fa-tools"></i>&nbsp;&nbsp;Zasoby
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="elements" aria-labelledby="headingOne" data-bs-parent="#elements">
                                        <nav class="sb-sidenav-menu-nested nav">

                                            <a class="nav-link" href="{{route('job.group.list')}}">
                                                <i class="far fa-paper-plane"></i>&nbsp;&nbsp;Grupy zleceń
                                            </a>
                                            <a class="nav-link" href="{{route('machine.list')}}">
                                                <i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Maszyny
                                            </a>

                                        </nav>
                                    </div>
                                    
                                    {{-- <br />
                                    <div class="small bg-primary mt-2 mb-1 grey600color">&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-down grey600color"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-business-time grey600color"></i>&nbsp;&nbsp;Optymalizacja</div>
                                    <br />
                                    <a class="nav-link" href="{{route('job.group.list')}}">
                                        <i class="fas fa-suitcase"></i>&nbsp;&nbsp;Zlecenia
                                    </a>
                                    <a class="nav-link" href="{{route('machine.list')}}">
                                        <i class="fas fa-luggage-cart"></i>&nbsp;&nbsp;Maszyny
                                    </a> --}}
                                    
                                    
                                </nav>

                               


                            </div>

                            
                            {{-- <a class="nav-link" href="{{route('element.new')}}">
                                Dodaj element
                            </a> --}}
                            
                            {{-- <a class="nav-link" href="{{route('article.new')}}">
                                Dodaj artykuł
                            </a> --}}
                            
                            {{-- <a class="nav-link" href="{{route('product.new')}}">
                                Dodaj produkt
                            </a> --}}
                            
                            {{-- <a class="nav-link" href="{{route('order.list')}}">
                                <i class="fas fa-cube"></i>&nbsp;&nbsp;Magazyn
                            </a> --}}
                            <a class="nav-link" href="{{route('order.list')}}">
                                <i class="fas fa-warehouse"></i>&nbsp;&nbsp;Magazyn
                            </a>
                            <a class="nav-link" href="{{route('order.list')}}">
                                <i class="fas fa-shopping-basket"></i>&nbsp;&nbsp;Zamówienia
                            </a>
                            {{-- <a class="nav-link" href="{{route('order.new')}}">
                                Dodaj zamówienie
                            </a> --}}
                            <a class="nav-link" href="{{route('production.index')}}">
                                <i class="fas fa-toolbox"></i>&nbsp;&nbsp;Produkcja
                            </a>
                            <a class="nav-link" href="{{route('production.planning')}}">
                                <i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;Planowanie
                            </a>
                            <a class="nav-link" href="{{route('job.index')}}">
                                <i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Zlecenia
                            </a>
                            {{-- <a class="nav-link" href="{{route('home')}}">
                                <i class="fas fa-arrows-alt"></i>&nbsp;&nbsp;Logistyka
                            </a> --}}
                            


                            {{-- <a class="nav-link" href="{{route('home')}}">    
                                <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Wydajność
                            </a> --}}

                            

                            {{-- <div class="sb-sidenav-menu-heading">ZAMÓWIENIA</div>
                            <a class="nav-link" href="">
                                Dodaj
                            </a>
                            <a class="nav-link" href="tables.html">
                                Przeglądaj
                            </a> --}}
                        
                            



                            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#elements" aria-expanded="false" aria-controls="elements">
                                
                                Elementy
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="elements" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('element.list')}}">Lista elementów</a>
                                    <a class="nav-link" href="{{route('element.new')}}">Dodaj element</a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#articles" aria-expanded="false" aria-controls="articles">
                                
                                Artykuły
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="articles" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('article.list')}}">Lista artykułów</a>
                                    <a class="nav-link" href="{{route('article.new')}}">Dodaj artykuł</a>
                                </nav>
                            </div>
                            
                            
                            <div class="sb-sidenav-menu-heading">ZAMÓWIENIA</div>
                            <a class="nav-link" href="{{route('articles.elements')}}">
                                Dodaj
                            </a>
                            <a class="nav-link" href="tables.html">
                                Przeglądaj
                            </a>
 --}}



                            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> --}}





                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">

                            {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->name }}
                           </div>
                           {{Auth::user()->tag_user}}
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            @yield('content')
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Fleximapp 2022</div>
                            {{-- <div class="small">
                                <a href="#"><i class="fas fa-user-secret"></i> privacy</a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="#"><i class="fas fa-user-secret"></i> privacy</a>
                            </div> --}}
                        </div>
                    </div>
                </footer>
            </div>
            @endguest
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
          </svg>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js')}}"></script>



        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    </body>
</html>
