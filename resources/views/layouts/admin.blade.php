<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        <?php
            $navbar =  Navbar::withBrand(config('app.name'), url('/admin/dashboard'))->inverse();
            if(Auth::check()){
                $arrayLinks = [
                    [
                        'link' => route('admin.users.index'),
                        'title' => 'Usuário'
                    ],
                    [
                        'link' => route('admin.categories.index'),
                        'title' => 'Categoria'
                    ],
                    [
                        'link' => route('admin.series.index'),
                        'title' => 'Série'
                    ],
                    [
                        'link' => route('admin.videos.index'),
                        'title' => 'Video'
                    ],

                ];
                $menus = Navigation::links($arrayLinks);
                $menuDireita = Navigation::links([
                    [
                        Auth::user()->name,
                        [
                            [
                                'link' => route('admin.account.edit'),
                                'title' => 'Account',
                            ],
                            [
                                'link' => route('admin.logout'),
                                'title' => 'Logout',
                                'linkAttributes' => [
                                    'onclick' => "event.preventDefault();document.getElementById(\"form-logout\").submit();"
                                ],
                            ]
                        ]
                    ]
                ])->right();
                $navbar->withContent($menus)->withContent($menuDireita);
            }
        ?>
        {!! $navbar !!}
            <?php
            $formLogout = FormBuilder::plain([
                'id' => 'form-logout',
                'route' => ['admin.logout'],
                'method' => 'POST',
                'style' => 'display:none'
            ]);
            ?>
            {!! form($formLogout) !!}
        @if(Session::has('message'))
            <div class="container">
                {!! Alert::success(Session::get('message'))->close() !!}
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
