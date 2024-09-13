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
                @if (isset($subcategories) && count($subcategories) > 0)
                    @foreach ($subcategories as $index => $subcategory)
                        <tr class="odd gradeX">
                            <td width="1%" class="fw-bold text-dark">
                                {{ ($subcategories->currentPage() - 1) * $subcategories->perPage() + $index + 1 }}</td>
                            <td>{{ $subcategory->id ?? 'NA' }}</td>
                            <td>
                                @if ($subcategory->image)
                                    <img width="50px" height="50px"
                                        src="{{ Storage::url('subcategory/' . $subcategory->image) }}"
                                        class="me-2 preview-img" alt="img">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $subcategory->name ?? 'NA' }}</td>
                            <td>{{ ucwords($subcategory->priority) ?? 'NA' }}</td>
                            <td>
                                <div class="active-switch">
                                    <label class="switch">
                                        <input type="checkbox" class="status-toggle" data-id="{{ $subcategory->id }}"
                                            {{ $subcategory->status ? 'checked' : '' }}>
                                        <span class="sliders round"></span>
                                    </label>
                                </div>
                            </td>

                            <td nowrap>
                                <a title="Edit" href="{{ route('subcategory.edit', $subcategory->id) }}"
                                    class="fa fa-edit w-20px"></a>
                                <a title="Delete"
                                    onclick="confirmDelete('{{ route('subcategory.destroy', $subcategory->id) }}')"
                                    class="fa fa-trash-alt w-20px"></a>
                            </td>
                    @endforeach

                @endif
                </tr>
            </tbody>
        </table>
        @forelse ($subcategories as $user)
        @empty
            <div style="text-align: center;">
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="200"
                    width="200">
            </div>
        @endforelse
        {{--  <div>
            {{ $subcategories->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-5', ['pageName' => 'page']) }}
        </div>  --}}

        <div>
            {{ $subcategories->appends(['itemsPerPage' => $itemsPerPage, 'search' => request('search')])->links('pagination::bootstrap-5', ['pageName' => 'page', 'secure' => true]) }}
        </div>


    </div>
</div>
