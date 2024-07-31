<x-app-layout>
    <x-slot name="header">
        @vite(['resources/css/finances-form.css', 'resources/js/finances-form.js', 'resources/js/export-report.js'])
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
                @if (auth()->user()->hasAnyPermission(['create']))
                    <form id="finance-form" class="grid grid-cols-1 gap-4 mb-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                            <div>
                                <label for="transaction_type"
                                    class="block text-sm font-medium text-gray-700">Lançamento</label>
                                <select name="transaction_type" id="transaction_type"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saída">Saída</option>
                                </select>
                            </div>
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                                <input type="text" name="title" id="title" required
                                    placeholder="Oferta/Dízimo/Pagamento..."
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="source" class="block text-sm font-medium text-gray-700">Fonte</label>
                                <select name="source" id="source"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="Banco">Banco</option>
                                    <option value="Caixa">Caixa</option>
                                </select>
                            </div>
                            <div>
                                <label for="date_transfer" class="block text-sm font-medium text-gray-700">Data</label>
                                <input type="date" name="date_transfer" id="date_transfer" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label for="value" class="block text-sm font-medium text-gray-700">Valor</label>
                                <input type="number" name="value" id="value" required placeholder="150,00"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm number-input placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                            <div class="col-span-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Descrição
                                    (opcional)</label>
                                <textarea name="description" id="description"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            </div>
                            <div class="flex items-center justify-center mt-4 md:mt-0">
                                <button type="submit"
                                    class="flex items-center px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    <span class="ml-2">Adicionar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="mb-4 text-center">
                        <label for="date_transfer" class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="date_transfer" id="date_transfer" required
                            class="block w-48 mx-auto mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="{{ date('Y-m-d') }}">
                    </div>
                @endif
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-2 text-gray-900 bg-white">
                        <div class="flex justify-between">
                            <fieldset class="container w-1/2 mb-4 mr-2 border border-gray-200">
                                <legend class="text-lg font-medium leading-6 text-center text-gray-500">
                                    Entradas
                                </legend>
                                <table id="entradas-table" class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-1 py-1 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            </th>
                                            <th scope="col"
                                                class="px-1 py-1 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Título</th>
                                            <th scope="col"
                                                class="px-2 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Data</th>
                                            <th scope="col"
                                                class="px-2 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Fonte</th>
                                            <th scope="col"
                                                class="px-2 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- Entradas Data -->
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="5"
                                                class="px-6 py-4 text-sm font-medium text-right text-gray-900">
                                                Total: R$
                                                <span id="total-entradas">0,00</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </fieldset>

                            <fieldset class="w-1/2 mb-4 ml-2 border border-gray-200">
                                <legend class="text-lg font-medium leading-6 text-center text-gray-500">
                                    Saídas
                                </legend>
                                <table id="saidas-table" class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-1 py-1 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            </th>
                                            <th scope="col"
                                                class="px-1 py-1 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Título</th>
                                            <th scope="col"
                                                class="px-2 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Data</th>
                                            <th scope="col"
                                                class="px-2 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Fonte</th>
                                            <th scope="col"
                                                class="px-2 py-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- Saídas Data -->
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="5"
                                                class="px-6 py-4 text-sm font-medium text-right text-gray-900">
                                                Total:
                                                R$
                                                <span id="total-saidas">0,00</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </fieldset>
                        </div>
                        <footer class="mt-4 text-center">
                            <div class="p-4 px-6 py-5 text-center text-gray-800 bg-gray-200 border">
                                <span class="inline-flex px-2 font-semibold leading-5 text-md">Saldo: R$ <span
                                        id="saldo-total">0,00</span></span>
                            </div>
                            <div class="relative items-center inline-block mt-4 text-center">
                                <button id="export-button"
                                    class="flex items-center justify-center px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
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
        </div>
</x-app-layout>
