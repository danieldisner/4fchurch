<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawPierChartMembersPerStatus);

    function drawPierChartMembersPerStatus() {
        var statusData = {!! json_encode($membersByStatus) !!};
        var dataArray = [];
        statusData.forEach(function(status) {
            dataArray.push([status.status.name, status.total]);
        });
        var colors = ['#6b7280', '#3b82f6', '#10b981', '#ef4444'];
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Total');

        data.addRows(dataArray);
        var options = {
            colors: colors
        };
        var chart = new google.visualization.PieChart(document.getElementById('pieChartMembersPerStatus'));
        chart.draw(data, options);
    }
</script>
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
                    <div class="flex">
                        <div class="mt-4 d-block">
                            <h2 class="mb-2 text-lg font-semibold">Total de Membros: {{ $totalMembers }}</h2>
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
                        <div id="pieChartMembersPerStatus" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
