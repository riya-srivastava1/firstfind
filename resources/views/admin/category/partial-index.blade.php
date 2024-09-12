<div class="panel-body">
    <div class="table-responsive">
        <table id="data-table-default" class="table table-striped table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th width="1%">S.No</th>
                    <th width="1%">Id</th>
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Priority</th>
                    <th class="text-nowrap">status</th>
                    <th class="text-nowrap">Action</th>
                    {{-- <th class="text-nowrap">Role</th>
                    @if (isset($user) && isset($permissions) && in_array('user-status', $permissions))
                        <th class="text-nowrap">Status</th>
                    @endif --}}
                    {{-- @if (isset($user) &&
                            isset($permissions) &&
                            (in_array('contactus-edit', $permissions) || in_array('contactus-delete', $permissions)))
                        <th width="1%">Action</th>
                    @endif --}}
                </tr>
            </thead>
            <tbody>
                @if (isset($categories) && count($categories) > 0)
                    @foreach ($categories as $index => $user)
                        <tr class="odd gradeX">
                            <td width="1%" class="fw-bold text-dark">
                                {{ ($categories->currentPage() - 1) * $categories->perPage() + $index + 1 }}</td>
                            <td>{{ $user->id ?? 'NA' }}</td>
                            <td>{{ $user->name ?? 'NA' }}</td>
                            <td>{{ ucwords($user->priority) ?? 'NA' }}</td>
                            <td>{{ $user->status ?? 'NA' }}</td>

                                    <td nowrap>
                                        <a title="Delete"
                                            onclick="confirmDelete('{{ route('category.destroy', $user->id) }}')"
                                            class="fa fa-trash-alt w-20px"></a>
                                    </td>

                    @endforeach

                @endif
                </tr>
            </tbody>
        </table>
        @forelse ($categories as $user)
        @empty
            <div style="text-align: center;">
                <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="200"
                    width="200">
            </div>
        @endforelse
        {{--  <div>
            {{ $categories->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-5', ['pageName' => 'page']) }}
        </div>  --}}

        <div>
            {{ $categories->appends(['itemsPerPage' => $itemsPerPage, 'search' => request('search')])->links('pagination::bootstrap-5', ['pageName' => 'page','secure' => true]) }}
        </div>


    </div>
</div>
