@include('Backend.Partials.Header')
@include('Backend.Partials.Sidebar')
@include('Backend.Partials.Navbar')

@if(session('success'))
    <div id="alert-message" class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3"
        role="alert" style="z-index: 1050; min-width: 250px;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div id="alert-message" class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3"
        role="alert" style="z-index: 1050; min-width: 250px;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                        
@yield('Content')

@include('Backend.Partials.Footer')