<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 bg-white">
                    <h1>Bem Vindo!</h1>
                    <div class="mt-4">
                        <h2 class="mb-2 text-lg font-semibold">Total de Membros {{ $totalMembers }}</h2>
                        <ul class="space-y-2">
                            @foreach ($membersByStatus as $statusData)
                                @php
                                    $status = $statusData->status;
                                    $total = $statusData->total;
                                @endphp
                                <li class="flex items-center space-x-2">
                                    @switch($status->id)
                                        @case(1)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 bg-gray-100 rounded-full text-black-800">
                                                {{ $status->name }}
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                                {{ $status->name }}
                                            </span>
                                        @break

                                        @case(3)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                {{ $status->name }}
                                            </span>
                                        @break

                                        @case(4)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                {{ $status->name }}
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full text-black-800 bg-black-100">
                                                {{ $status->name }}
                                            </span>
                                        @break
                                    @endswitch
                                    <span>{{ $total }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
