@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item active">Manage Users</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">
            <!-- BEGIN panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">Users Listing</h4>
                <div class="panel-heading-btn">
                    <a href={{ route('user.create') }} class="fas fa-lg fa-fw me-10px fa-plus" title="Add Users"
                        style="text-decoration: none; color:white;"></a>
                </div>
            </div>
            <br>
            <div style="display: flex; align-items: center; justify-content: space-between;">

                @include('layouts.pagination')

                <div class="navbar-item navbar-form" style="margin-right: 20px;margin-left: 60%">
                    <div class="form-group search">
                        <input type="text" name="search" class="form-control" id="searchInput"
                            placeholder="Search Here..">
                    </div>
                </div>
            </div>
            <div id="searchResults">
                @include('users::user-index')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/pagination.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.user-checkbox').change(function() {
                const updateStatusUrl = "user/status/";
                const userId = $(this).data('user-id');
                $.ajax({
                    type: 'GET',
                    url: updateStatusUrl + userId,
                    success: function(response) {
                        console.log('Status updated successfully.');
                    },
                    error: function(error) {
                        console.error('Error updating status:', error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#searchInput').keyup(function(e) {
                var searchTerm = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.search') }}',
                    data: {
                        search: searchTerm,
                        _token: '{{ csrf_token() }}'
                    },

                    success: function(response) {

                        $('#searchResults').html(response);
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
