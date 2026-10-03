@include('dashboard.components.head')

<body>
    <div class="container-scroller">

        @include('dashboard.components.navbar')

        <div class="container-fluid page-body-wrapper">

            @include('dashboard.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                @include('dashboard.components.footer')
            </div>

        </div>
    </div>

    @include('dashboard.components.javascript')
</body>
</html>
