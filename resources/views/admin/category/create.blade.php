@extends('layouts.app')
@section('content')
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">category Listing</a></li>
            <li class="breadcrumb-item active">Add Deliveries</li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-6 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title">Add Deliveries</h4>
                    </div>
                    <!-- END panel-heading -->
                    <!-- BEGIN panel-body -->
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('category.store') }}" data-parsley-validate="true"
                            method="POST" id="categoryForm" enctype= "form-data/multipart">
                            @csrf
                            <div class="row">

                                <div id="tracking_id" class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="col-form-label form-label">Category name <span class="text-danger"
                                                title="field required">*</span></label>
                                        <input class="form-control" type="text" id="tracking_id" name="name"
                                            value="{{ old('name') }}"  placeholder="Enter Category name"
                            >
                                        @if ($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div id="priority" class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="col-form-label form-label" for="modeoftransport">Priority
                                            <span class="text-danger" title="field required">*</span></label>
                                        <select name="priority" id="modeoftransport" class="form-select mb-1">
                                            <option value="" disabled selected>Select</option>
                                            <option value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                        @if ($errors->has('priority'))
                                            <div class="text-danger">{{ $errors->first('priority') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="col-form-label form-label" for="email">image<span
                                                class="text-danger" title="field required">*</span></label>
                                        <div>
                                            <input class="form-control" type="file" id="image" name="image"
                                                value="{{ old('image') }}" placeholder="Enter Vehicle Type">
                                            @if ($errors->has('image'))
                                                <div class="text-danger">{{ $errors->first('image') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <label class="col-form-label form-label">&nbsp;</label>
                                        <div>
                                            <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
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
