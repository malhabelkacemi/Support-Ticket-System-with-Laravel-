@include('dashboard.partials.head')

<body>
    <div class="container-scroller">

        @include('dashboard.partials.navbar')

        <div class="container-fluid page-body-wrapper">

            @include('dashboard.partials.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                @include('dashboard.partials.footer')
            </div>

        </div>
    </div>

    @include('dashboard.partials.javascript')
</body>
</html>
