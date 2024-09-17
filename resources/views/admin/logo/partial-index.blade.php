<div class="panel-body">
    <div class="table-responsive">
        <table id="data-table-default" class="table table-striped table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th width="1%">S.No</th>
                    <th width="1%">Id</th>
                    <th class="text-nowrap">Image</th>
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Priority</th>
                    <th class="text-nowrap">status</th>
                    <th class="text-nowrap">Action</th>
                    {{-- <th class="text-nowrap">Role</th>
                    @if (isset($user) && isset($permissions) && in_array('user-status', $permissions))
                        <th class="text-nowrap">Status</th>
                    @endif --}}
                    {{-- @if (isset($user) && isset($permissions) && (in_array('contactus-edit', $permissions) || in_array('contactus-delete', $permissions)))
                        <th width="1%">Action</th>
                    @endif --}}
                </tr>
            </thead>
            <tbody>
                @if (isset($banners) && count($banners) > 0)
                    @foreach ($banners as $index => $banner)
                        <tr class="odd gradeX">
                            <td width="1%" class="fw-bold text-dark">
                                {{ ($banners->currentPage() - 1) * $banners->perPage() + $index + 1 }}</td>
                            <td>{{ $banner->id ?? 'NA' }}</td>
                            <td>
                                @if ($banner->image)
                                    <img width="50px" height="50px"
                                        src="{{ Storage::url('banner/' . $banner->image) }}"
                                        class="me-2 preview-img" alt="img">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $banner->name ?? 'NA' }}</td>
                            <td>{{ ucwords($banner->priority) ?? 'NA' }}</td>
                            <td>
                                <div class="active-switch">
                                    <label class="switch">
                                        <input type="checkbox" class="status-toggle" data-id="{{ $banner->id }}"
                                        onclick="return confirm('Are you sure want to change status?')"
                                            {{ $banner->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </td>


                            <td nowrap>
                                <a title="Edit" href="{{ route('banner.edit', $banner->id) }}"
                                    class="fa fa-edit w-20px"></a>
                                <a title="Delete"
                                    onclick="confirmDelete('{{ route('banner.destroy', $banner->id) }}')"
                                    class="fa fa-trash-alt w-20px"></a>
                            </td>
                    @endforeach

                @endif
                </tr>
            </tbody>
        </table>
        @forelse ($banners as $user)
        @empty
            <div style="text-align: center;">
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="200"
                    width="200">
            </div>
        @endforelse
        {{--  <div>
            {{ $banners->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-5', ['pageName' => 'page']) }}
        </div>  --}}

        <div>
            {{ $banners->appends(['itemsPerPage' => $itemsPerPage, 'search' => request('search')])->links('pagination::bootstrap-5', ['pageName' => 'page', 'secure' => true]) }}
        </div>


    </div>
</div>
