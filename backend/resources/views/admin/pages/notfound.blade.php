@extends('admin.layouts.master')
@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <section id="advanced-search-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="padding:50px; ">
                        
                        <h1 style="color:red">API not found. Please check API or Login again
                        
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        <i class="mr-50" data-feather="power"></i>
                        {{ __('Logout') }}
                      </a>
            
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                        </h1>
                        
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--/ Advanced Search -->


@endsection
@section('page-script')
@endsection

