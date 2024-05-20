<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Deleted Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" colspan="2"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase align-content-center align-center">
                                    Membro
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deletedMembers as $member)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ asset('storage/' . $member->photo) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $member->name }}
                                                </div>
                                                <div class="inline-flex text-sm text-gray-500">
                                                    <div class="inline-flex text-sm text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="mr-1 bi bi-cake"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="m7.994.013-.595.79a.747.747 0 0 0 .101 1.01V4H5a2 2 0 0 0-2 2v3H2a2 2 0 0 0-2 2v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a2 2 0 0 0-2-2h-1V6a2 2 0 0 0-2-2H8.5V1.806A.747.747 0 0 0 8.592.802zM4 6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v.414a.9.9 0 0 1-.646-.268 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0A.9.9 0 0 1 4 6.414zm0 1.414c.49 0 .98-.187 1.354-.56a.914.914 0 0 1 1.292 0c.748.747 1.96.747 2.708 0a.914.914 0 0 1 1.292 0c.374.373.864.56 1.354.56V9H4zM1 11a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.793l-.354.354a.914.914 0 0 1-1.293 0 1.914 1.914 0 0 0-2.707 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0L1 11.793zm11.646 1.854a1.915 1.915 0 0 0 2.354.279V15H1v-1.867c.737.452 1.715.36 2.354-.28a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.708 0a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.707 0a.914.914 0 0 1 1.293 0Z" />
                                                        </svg>
                                                        {{ $member->birthdate->format('d/m/Y') }}
                                                    </div>
                                                    <div class="inline-flex ml-4 text-sm text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-droplet-half" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M7.21.8C7.69.295 8 0 8 0q.164.544.371 1.038c.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8m.413 1.021A31 31 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10c0 0 2.5 1.5 5 .5s5-.5 5-.5c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                                                            <path fill-rule="evenodd"
                                                                d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87z" />
                                                        </svg>
                                                        {{ $member->baptism_date->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $member->profession }}</div>
                                        <div class="text-sm text-gray-500">{{ $member->address_street }} ,
                                            {{ $member->address_city }} {{ $member->address_number }} -
                                            {{ $member->uf }}</div>
                                    </td>
                                    <td>
                                        <div class="inline-flex items-center">
                                            @if (auth()->user()->hasAnyPermission(['restore']))
                                                <form id="restoreForm-{{ $member->id }}"
                                                    action="{{ route('members.restore', $member->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 font-bold text-gray-100 bg-green-800 rounded-full hover:bg-green-600">Restaurar</button>
                                                </form>
                                            @endif
                                            @if (auth()->user()->hasAnyPermission(['forceDestroy']))
                                                <button id="destroyButton-{{ $member->id }}"
                                                    class="inline-flex items-center px-4 py-2 font-bold text-gray-100 bg-red-800 rounded-full destroyButton hover:bg-red-600">Apagar</button>
                                                <form id="destroyForm-{{ $member->id }}"
                                                    action="{{ route('members.forceDestroy', $member->id) }}"
                                                    method="POST" class="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nenhum membro deletado</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $deletedMembers->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de confirmação -->
    <div id="confirmDestroyModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg">
                <!-- Modal header -->
                <div class="px-6 py-4 text-white align-middle bg-red-800 rounded-t-lg">
                    <h3 class="text-lg font-semibold">Confirmação de Exclusão</h3>
                </div>
                <!-- Modal content -->
                <div class="p-8">
                    <p class="mb-4">Tem certeza que deseja <b>excluir permanentemente</b> este membro?</p>
                    <div class="flex justify-end">
                        <button id="cancelDestroy"
                            class="px-4 py-2 mr-2 text-white bg-green-700 rounded hover:bg-green-500">Cancelar</button>
                        <button id="confirmDestroy"
                            class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">Sim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenha todos os botões de exclusão
        var destroyButtons = document.querySelectorAll('.destroyButton');

        // Obtenha o modal de confirmação
        var modal = document.getElementById('confirmDestroyModal');

        // Obtenha o botão de cancelamento no modal
        var cancelDestroyButton = document.getElementById('cancelDestroy');

        // Obtenha o botão de confirmação no modal
        var confirmDestroyButton = document.getElementById('confirmDestroy');

        // Variável para armazenar o ID do membro a ser excluído
        var memberIdToDestroy;

        // Adicione evento de clique para cada botão de exclusão
        destroyButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Obtenha o ID do membro a partir do ID do botão
                memberIdToDestroy = this.id.split('-')[1];

                // Mostre o modal
                modal.classList.remove('hidden');
            });
        });

        // Quando o botão de cancelamento no modal for clicado
        cancelDestroyButton.addEventListener('click', function() {
            // Oculte o modal
            modal.classList.add('hidden');
        });

        // Quando o botão de confirmação no modal for clicado
        confirmDestroyButton.addEventListener('click', function() {
            // Envie o formulário de exclusão correspondente
            var form = document.getElementById('destroyForm-' + memberIdToDestroy);
            form.submit();
        });
    });
</script>
