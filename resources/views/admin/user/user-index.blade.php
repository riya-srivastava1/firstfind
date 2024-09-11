<div class="panel-body">
    <table id="data-table-default" class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th width="1%">S.No</th>
                <th class="text-nowrap">Name</th>
                <th class="text-nowrap">Email</th>
                <th class="text-nowrap">Contact</th>
                <th class="text-nowrap">Role</th>
                <th class="text-nowrap">Status</th>
                <th width="1%">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($users) && count($users) > 0)
                @foreach ($users as $index => $user)
                    <tr class="odd gradeX">
                        <td width="1%" class="fw-bold text-dark">{{ $index + 1 }}</td>
                        <td>{{ $user->name ??'NA' }}</td>
                        <td>{{ $user->email ??'NA' }}</td>
                        <td>{{ $user->contact_number ??'NA' }}</td>
                        <td>{{ $user->getRole->name ?? 'NA' }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input user-checkbox" name="status" onclick="return confirm('are you sure want to change status?')" type="checkbox"
                                    id="{{ $user->id }}" data-user-id="{{ $user->id }}"
                                    {{ $user->is_active == 1 ? 'checked' : '' }} />
                            </div>
                        </td>
                        <td nowrap>
                            <a title="Edit" href="{{ route('user.edit', $user->id) }}"
                                class="fa fa-edit w-20px me-1"></a>
                            <a title="Delete" onclick="confirmDelete('{{ route('user.destroy', $user->id) }}')"
                                class="fa fa-trash-alt w-20px"></a>
                        </td>
                @endforeach
            @endif
            </tr>
        </tbody>
    </table>
    @forelse ($users as $user)
    @empty
        <div style="text-align: center;">
            <img src="{{ URL::asset('assets/img/no_data_available.svg') }}" alt="No data found" height="200"
                width="200">
        </div>
    @endforelse
    <div>
        {{ $users->appends(['itemsPerPage' => $itemsPerPage])->links('pagination::bootstrap-5') }}
    </div>
</div>
