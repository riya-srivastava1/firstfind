@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb float-xl-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <h1 class="page-header">Edit User</h1>
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit User</h4>
                    </div>
                    <!-- END panel-heading -->
                    <!-- BEGIN panel-body -->
                    <div class="panel-body p-0">
                        <form class="form-horizontal form-bordered" action="{{ route('user.update', $users->id) }}"
                            data-parsley-validate="true" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label" for="name">Full Name <span
                                        class="text-danger">*</span> </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $users->name ?? '') }}"
                                             placeholder="Required"
                                        data-parsley-required="true" />
                                    @if ($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label" for="email">Email <span
                                        class="text-danger">*</span> </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ old('email', $users->email ?? '') }}" data-parsley-type="email"
                                        placeholder="Email" data-parsley-required="true" />
                                    @if ($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label" for="contact_number">contact_number
                                    :</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="tel" id="contact_number" name="contact_number"
                                        value="{{ old('contact_number', $users->contact_number ?? '') }}"
                                        data-parsley-type="contact_number" placeholder="contact_number"
                                        oninput="this.value = this.value.replace(/[^0-9+()]/g, '');" pattern=".{8,10}"
                                        maxlength="10" />
                                    @if ($errors->has('contact_number'))
                                        <div class="text-danger">{{ $errors->first('contact_number') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label form-label" for="role">Role</label>
                                <div class="col-lg-8">
                                    <select class="form-select" id="select-required" name="role"
                                        data-parsley-required="true">
                                        <option value="">Please Role</option>
                                        @if (isset($role_values) && count($role_values) > 0)
                                            @foreach ($role_values as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $role->id == $users->role ? 'selected' : '' }}>{{ $role->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('role'))
                                        <div class="text-danger">{{ $errors->first('role') }}</div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-lg-4 offset-lg-4">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END panel-body -->
                </div>
                <!-- END panel -->
            </div>
            <!-- END col-6 -->

        </div>
        <!-- END row -->
    </div>
@endsection

