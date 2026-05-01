<x-filament::page>
    {{-- <h2 class="text-xl font-bold mb-4">Giving Reports</h2>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-white rounded shadow">
            <h3 class="font-bold">Total Giving</h3>
            <p class="text-2xl font-bold">
                ₱{{ number_format($this->getViewData()['totalGivings'], 2) }}
            </p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">

        {{-- By Type --}}
        {{-- <div class="p-4 bg-white rounded shadow">
            <h3 class="font-bold mb-2">By Giving Type</h3>

            @foreach ($this->getViewData()['byType'] as $item)
                <div class="flex justify-between border-b py-1">
                    <span>{{ $item->givingType->name ?? 'Unknown' }}</span>
                    <span>₱{{ number_format($item->total, 2) }}</span>
                </div>
            @endforeach
        </div> --}}

        {{-- Monthly --}}
        {{-- <div class="p-4 bg-white rounded shadow">
            <h3 class="font-bold mb-2">Monthly Totals</h3>

            @foreach ($this->getViewData()['monthly'] as $item)
                <div class="flex justify-between border-b py-1">
                    <span>Month {{ $item->month }}</span>
                    <span>₱{{ number_format($item->total, 2) }}</span>
                </div>
            @endforeach
        </div> --}}

    {{-- </div>  --}}
        <x-filament::section>
        <x-slot name="heading">
            Giving Reports
        </x-slot>

        <div class="text-2xl font-bold">
            ₱{{ number_format($totalGivings, 2) }}
        </div>
    </x-filament::section>

    <div class="grid grid-cols-2 gap-6 mt-6">

        <x-filament::section>
            <x-slot name="heading">By Giving Type</x-slot>

            @foreach ($byType as $item)
                <div class="flex justify-between border-b py-1 ">
                    <span>{{ $item->givingType->name ?? 'Unknown' }}</span>
                    <span>₱{{ number_format($item->total, 2) }}</span>
                </div>
            @endforeach
        </x-filament::section>

    

    </div>
    <div>
            <x-filament::section>
            <x-slot name="heading">Monthly Totals</x-slot>

            @foreach ($monthly as $item)
                <div class="flex justify-between border-b py-1">
                    <span>Month {{ $item->month }}</span>
                    <span>₱{{ number_format($item->total, 2) }}</span>
                </div>
            @endforeach
        </x-filament::section>
    </div>
</x-filament::page>
