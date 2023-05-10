<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a href="index.html" class="logo">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="navbar brand" class="navbar-brand">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                        aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                    </a>
                    <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="title mb-1">{{__('Languages')}}</span>

                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                            class="dropdown-item">
                                            {{ $properties['native'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                    </a>
                    <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="title mb-1">Quick Actions</span>
                            <span class="subtitle op-8">Shortcuts</span>
                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-6 p-0" href="{{ route('rooms.create') }}">
                                        <div class="quick-actions-item">
                                            <i class="fa fa-bed" aria-hidden="true"></i>
                                            <span class="text">{{ __('New Room') }}</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-6 p-0" href="{{ route('customers.create') }}">
                                        <div class="quick-actions-item">
                                            <i class="fa fa-male" aria-hidden="true"></i>
                                            <span class="text">{{ __('New Customer') }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-6 p-0" href="{{ route('reservations.create') }}">
                                        <div class="quick-actions-item">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            <span class="text">{{ __('New Reservation') }}</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-6 p-0" href="{{ route('reservations.index') }}">
                                        <div class="quick-actions-item">
                                            <i class="fa-solid fa-door-closed"></i>
                                            <span class="text">{{ __('Check Out') }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            @if (isset(Auth::user()->worker->img))
                                <img src="{{ asset('media/workers/' . Auth::user()->worker->img) }}" alt="..."
                                    class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('media/tmp/tmp_avatar.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            @endif

                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if (isset(Auth::user()->worker->img))
                                            <img src="{{ asset('media/workers/' . Auth::user()->worker->img) }}"
                                                alt="..." class="avatar-img rounded-circle">
                                        @else
                                            <img src="{{ asset('media/tmp/tmp_avatar.jpg') }}" alt="..."
                                                class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
