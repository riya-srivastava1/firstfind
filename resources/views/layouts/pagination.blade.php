<select name="itemsPerPage" id="itemsPerPage"
    style="width:100px; padding: 0.4375rem 0.75rem;border-radius: 4px; margin:0 15px;"
    onchange="changeItemsPerPage(this)">
    @php
        $halfItems = ceil($totalItems / 2); // Get half of the total items
        $quarterItems = floor(($totalItems - 1) / 4); // Get quarter of the total items (subtracting 1 if total is odd)
    @endphp
    @if ($totalItems < 10)
        <option value="{{ $totalItems }}" selected>All</option>
    @else
        <option value="{{ $quarterItems }}" {{ $itemsPerPage == $quarterItems ? 'selected' : '' }}>
            {{ $quarterItems }}
        </option>
        <option value="{{ $halfItems }}" {{ $itemsPerPage == $halfItems ? 'selected' : '' }}>
            {{ $halfItems }}
        </option>
        <option value="{{ $totalItems }}" {{ $itemsPerPage == $totalItems ? 'selected' : '' }}>
            {{ $totalItems }}
        </option>
    @endif
</select>
