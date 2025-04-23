
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-md-6">
                    <h1>{!! __('label.users') !!}</h1>
                </div> --}}

            </div>
        </div>
    </section>
    <div class="content px-3">

        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">

                @include('account_dashboard.table', ['type' => 'jobseekers'])
            </div>
        </div>
    </div>
