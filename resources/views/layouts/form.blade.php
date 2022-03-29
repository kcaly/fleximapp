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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
            <div id="layoutAuthentication">
                <div id="layoutAuthentication_content">
                    <main>
                        <div class="container">
                            <div class="row justify-content-center">
                                @yield('content')
                            </div>
                        </div>
                    </main>
                </div>
                <div id="layoutAuthentication_footer">
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Fleximapp 2022</div>
                                <div>
                                    <a href="#">Regulamin</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="#">Kontakt</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="{{ asset('js/scripts.js')}}"></script>
        </body>
</html>
