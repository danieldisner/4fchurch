<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Membros') }}
        </h2>
    </x-slot>
    <div class="py-12 pt-1">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between my-4">
                <div class="flex items-center space-x-4">
                    @if (auth()->user()->hasAnyPermission(['create']))
                        <button
                            class="flex items-center px-4 py-2 mt-4 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                <path fill-rule="evenodd"
                                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                            </svg>
                            <a href="{{ route('members.create') }}" class="ml-2">Cadastrar</a>
                        </button>
                    @endcan
                    <button
                        class="flex items-center px-4 py-2 mt-4 font-bold text-white bg-red-500 rounded-full hover:bg-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <a href="{{ route('members.trash') }}" class="ml-2 text-white">Lixeira</a>
                    </button>
            </div>
            <input type="text" id="search" class="px-4 py-2 border rounded-full"
                placeholder="Buscar membros...">
        </div>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900 bg-white">
                <table class="min-w-full p-4 overflow-x-auto divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" colspan="2"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase align-content-center align-center">
                                Membro
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Whatsapp
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody id="members-list" class="bg-white divide-y divide-gray-200">
                        @foreach ($members as $member)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <a href="{{ route('members.show', $member) }}">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ asset('storage/' . $member->photo) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a
                                                    href="{{ route('members.show', $member->id) }}">{{ $member->name }}</a>
                                            </div>
                                            <div class="inline-flex text-sm text-gray-500">
                                                <div class="inline-flex text-sm text-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="mr-1 bi bi-cake"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="m7.994.013-.595.79a.747.747 0 0 0 .101 1.01V4H5a2 2 0 0 0-2 2v3H2a2 2 0 0 0-2 2v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a2 2 0 0 0-2-2h-1V6a2 2 0 0 0-2-2H8.5V1.806A.747.747 0 0 0 8.592.802zM4 6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v.414a.9.9 0 0 1-.646-.268 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0A.9.9 0 0 1 4 6.414zm0 1.414c.49 0 .98-.187 1.354-.56a.914.914 0 0 1 1.292 0c.748.747 1.96.747 2.708 0a.914.914 0 0 1 1.292 0c.374.373.864.56 1.354.56V9H4zM1 11a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.793l-.354.354a.914.914 0 0 1-1.293 0 1.914 1.914 0 0 0-2.707 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0L1 11.793zm11.646 1.854a1.915 1.915 0 0 0 2.354.279V15H1v-1.867c.737.452 1.715.36 2.354-.28a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.708 0a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.707 0a.914.914 0 0 1 1.293 0Z" />
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
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($member->status->id)
                                        @case(1)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 bg-gray-100 rounded-full text-black-800">
                                                {{ $member->status->name }}
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                                {{ $member->status->name }}
                                            </span>
                                        @break

                                        @case(3)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                {{ $member->status->name }}
                                            </span>
                                        @break

                                        @case(4)
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                {{ $member->status->name }}
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full text-black-800 bg-black-100">
                                                {{ $member->status->name }}
                                            </span>
                                        @break
                                    @endswitch

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span>{{ $member->whatsapp }}</span>
                                </td>
                                <td
                                    class="inline-flex items-center px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <a href="{{ route('members.show', $member) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                    </a>
                                    @if (auth()->user()->hasAnyPermission(['edit']))
                                        <a href="{{ route('members.edit', $member) }}"
                                            class="ml-2 text-indigo-600 hover:text-indigo-900">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </span>
                                        </a>
                                    @endif
                                    @if (auth()->user()->hasAnyPermission(['delete']))
                                        <form class="delete" action="{{ route('members.destroy', $member) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="mt-1 ml-2 text-red-600 hover:text-red-900 ">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value;

            fetch(`{{ route('members.search') }}?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    const membersList = document.getElementById('members-list');
                    membersList.innerHTML = '';

                    data.members.forEach(member => {
                        const birthdate = new Date(member.birthdate).toLocaleDateString(
                            'pt-BR');
                        const baptismDate = new Date(member.baptism_date)
                            .toLocaleDateString('pt-BR');

                        const memberRow = `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <a href="/members/${member.id}">
                                        <img class="w-10 h-10 rounded-full" src="/storage/${member.photo}" alt="">
                                    </a>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="/members/${member.id}">${member.name}</a>
                                    </div>
                                    <div class="text-sm text-gray-500">${birthdate} - ${baptismDate}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${member.profession}</div>
                            <div class="text-sm text-gray-500"> ${member.address_neighborhood}  - ${member.city}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${member.status ? `<span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full ${getStatusClass(member.status)}">${member.status.name}</span>` : ''}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap"><span>${member.whatsapp}</span></td>
                        <td class="inline-flex items-center px-6 py-4 text-sm font-medium whitespace-nowrap">
                            <a href="/members/${member.id}" class="text-blue-600 hover:text-blue-900">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </span>
                            </a>
                            <a href="/members/${member.id}/edit" class="ml-2 text-indigo-600 hover:text-indigo-900">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </span>
                            </a>
                            <form class="delete" action="/members/${member.id}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-1 ml-2 text-red-600 hover:text-red-900">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                    </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                `;
                        membersList.insertAdjacentHTML('beforeend', memberRow);
                    });
                });
        });


        function getStatusClass(status) {
            if (!status) return '';
            switch (status.id) {
                case 1:
                    return 'bg-gray-100 text-black-800';
                case 2:
                    return 'text-blue-800 bg-blue-100';
                case 3:
                    return 'text-green-800 bg-green-100';
                case 4:
                    return 'text-red-800 bg-red-100';
                default:
                    return 'text-black-800 bg-black-100';
            }
        }
    });
</script>
