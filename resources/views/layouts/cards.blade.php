<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                @auth
                    <h5 class="text-white op-7 mb-2">Welcome {{ Auth::user()->name }}</h5>
                @endauth
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt-2">
    <div class="row mt--2">
        <div class="col-md text-light">
            <div class="card full-height bg-info">
                <div class="card-body">
                    <div class="card-title ">{{ __('Rooms')}}</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <h1 class="fw-bold mt-3 mb-0">{{ App\Models\Room::count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md text-light">
            <div class="card full-height bg-success">
                <div class="card-body">
                    <div class="card-title ">{{ __('Our Customers') }}</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <h1 class="fw-bold mt-3 mb-0">{{ App\Models\Customer::count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md text-light">
            <div class="card full-height bg-secondary">
                <div class="card-body">
                    <div class="card-title ">{{ __('Reception Registery') }}</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <h1 class="fw-bold mt-2 mb-0">
                            {{ App\Models\Transaction::where('state', 'reception')->sum('bill') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md text-light">
            <div class="card full-height bg-warning">
                <div class="card-body">
                    <div class="card-title ">{{ __('Main Safe') }}</div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <h1 class="fw-bold mt-2 mb-0 text-light">
                            {{ App\Models\Transaction::where('state', 'safe')->sum('bill') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
