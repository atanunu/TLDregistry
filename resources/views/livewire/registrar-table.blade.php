<div class="p-4">

    <input wire:model.debounce.300ms="search"
           type="text"
           placeholder="Search registrars…"
           class="border rounded px-2 py-1 mb-3 w-64">

    <table class="table-auto w-full text-sm">
        <thead class="bg-gray-100">
        <tr>
            <th class="p-2 text-left">Name</th>
            <th>Email</th>
            <th class="text-right">Balance</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($rows as $row)
            <tr class="border-b">
                <td class="p-2">{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td class="text-right">{{ number_format($row->balance, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $rows->links() }}
    </div>
</div>
