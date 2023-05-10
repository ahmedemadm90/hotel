<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (isset(Auth::user()->worker->img))
                        <img src="{{ asset('media/workers/' . Auth::user()->worker->img) }}" alt="..."
                            class="avatar-img rounded-circle mt--2">
                    @else
                        <img src="{{ asset('media/tmp/tmp_avatar.jpg') }} alt=" ..." class="avatar-img rounded-circle">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span class="text-capitalize">
                            {{ Auth::user()->name }}
                            {{-- <span class="caret"></span> --}}
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('home') }}">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Basic Settings</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Basic Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('roles.index') }}">
                                    <span class="sub-item">{{ __('Roles') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('workers.index') }}">
                                    <span class="sub-item">{{ __('Workers') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <span class="sub-item">{{ __('Users') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rooms.index') }}">
                                    <span class="sub-item">{{ __('Rooms') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customers.index') }}">
                                    <span class="sub-item">{{ __('Customers') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('reservations.index') }}">
                                    <span class="sub-item">{{ __('Reservations') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('menu.categories.index') }}">
                                    <span class="sub-item">{{ __('Menu Categories') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('menu.types.index') }}">
                                    <span class="sub-item">{{ __('Menu Types') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('orders.index') }}">
                                    <span class="sub-item">{{ __('Order') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('room.services.index') }}">
                                    <span class="sub-item">{{ __('Room Services') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('reception.index') }}">
                                    <span class="sub-item">{{ __('Reception') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('transactions.index') }}">
                                    <span class="sub-item">{{ __('Transactions') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
