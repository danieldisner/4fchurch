<x-app-layout>
    <x-slot name="header">
        @vite(['resources/js/export-report.js'])
        <nav x-data="{ open: false }">
            <div class="flex">
                <x-nav-link :href="route('finances.dashboard')" :active="request()->routeIs('finances.dashboard')" class="mr-4 h2">
                    <h2>{{ __('Financeiro') }}</h2>
                </x-nav-link>
                <x-nav-link :href="route('finances.index')" :active="request()->routeIs('finances.index')">
                    {{ __('Lançamentos') }}
                </x-nav-link>
            </div>
        </nav>
    </x-slot>

    <div class="py-12 pt-1">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="my-4">
                <form method="GET" action="{{ route('finances.dashboard') }}">
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Data Inicial</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $startDate }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Data Final</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $endDate }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                class="flex items-center px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Filtrar
                            </button>
                        </div>
                    </div>
                </form>

                <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900 bg-white">
                            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                                <div class="p-4 text-gray-900 bg-white">
                                    <div id="entryChart" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900 bg-white">
                            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                                <div class="p-4 text-gray-900 bg-white">
                                    <div id="exitChart" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="mt-4 overflow-hidden text-center bg-white shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-900 bg-white">
                        <h3 class="text-lg font-semibold">Saldo Total</h3>
                        <p>Banco: R$ {{ formatCurrencyBR($saldoBanco) }}</p>
                        <p>Caixa: R$ {{ formatCurrencyBR($saldoCaixa) }}</p>
                        <p class="font-bold">Total: R$ {{ formatCurrencyBR($saldoBanco + $saldoCaixa) }}</p>
                    </div>
                    <div class="relative items-center inline-block mt-4 mb-4 text-center">
                        <button id="export-button"
                            class="flex items-center justify-center px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                <path
                                    d="M9.293 0H3a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6.707a1 1 0 0 0-.293-.707L10 0.293A1 1 0 0 0 9.293 0zM8.5 0.5v4a1 1 0 0 0 1 1h4l-5-5zM3 9.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 12a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 14.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            <span class="ml-2">Relatório</span>
                        </button>
                        <div id="report-options"
                            class="absolute inset-x-0 flex flex-col items-center hidden w-full mb-2 space-y-2 bottom-full md:flex-row md:justify-center">
                            <a href="#" id="export-csv"
                                class="block px-4 py-2 mt-2 mr-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">CSV</a>
                            <a href="#" id="export-excel"
                                class="block px-4 py-2 mr-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">EXCEL</a>
                            <a href="#" id="export-pdf"
                                class="block px-4 py-2 mr-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">PDF</a>
                            <a href="#" id="print-report"
                                class="block px-4 py-2 mr-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">IMPRIMIR</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Carregar a biblioteca de gráficos do Google -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Carregar a biblioteca de gráficos do Google
    google.charts.load('current', {
        packages: ['corechart']
    });

    // Chamar as funções para desenhar os gráficos quando a página for carregada
    google.charts.setOnLoadCallback(drawEntryChart);
    google.charts.setOnLoadCallback(drawExitChart);

    // Função para desenhar o gráfico de entradas
    function drawEntryChart() {
        var entryData = {!! json_encode($entriesData) !!};
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Título');
        data.addColumn('number', 'Total');
        entryData.forEach(function(entry) {
            data.addRow([entry.title, entry.total]);
        });

        var options = {
            title: 'Entradas',
        };

        var chart = new google.visualization.PieChart(document.getElementById('entryChart'));
        chart.draw(data, options);
    }

    // Função para desenhar o gráfico de saídas
    function drawExitChart() {
        var exitData = {!! json_encode($expensesData) !!};
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Título');
        data.addColumn('number', 'Total');
        exitData.forEach(function(exit) {
            data.addRow([exit.title, exit.total]);
        });

        var options = {
            title: 'Saídas',
        };

        var chart = new google.visualization.PieChart(document.getElementById('exitChart'));
        chart.draw(data, options);
    }
</script>
