@extends('layouts.app')
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb justify-content-end">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Category Listing</li>
    </ol>
    <!-- END breadcrumb -->

    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <!-- BEGIN panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">Category Listing</h4>
            <div class="panel-heading-btn">
                {{-- @if (isset($user) && isset($permissions) && in_array('delivery-create', $permissions)) --}}
                <a href={{ route('category.create') }} class="fas fa-lg fa-fw me-10px fa-plus" title="Add Category"
                    style="text-decoration: none; color:white;"></a>
                    {{-- @endif --}}
            </div>
        </div>
        <br>
        <div style="display: flex; align-items: center; justify-content: space-between;">

            @include('layouts.pagination')

            <div class="navbar-item navbar-form" style="margin-right: 20px;margin-left: 60%">
                <div class="form-group search">
                    <input type="text" name="search" class="form-control" id="searchInput" placeholder="Search Here..">
                </div>
            </div>
        </div>
        <!-- END panel-heading -->
        <!-- BEGIN panel-body -->
        <div id="searchResults">
            @include('admin.category.partial-index')

        </div>

        <!-- END panel-body -->
    </div>
    @endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var statusRoute = `{{ route('category.status') }}`;
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/status-update.js') }}"></script>
@endsection
