<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Membros') }}
        </h2>
    </x-slot>
    <div class="py-12 pt-1">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col my-4 sm:flex-row sm:items-center sm:justify-between">
                <input type="text" id="search" class="px-4 py-2 mb-2 rounded-full sm:mt-0"
                    placeholder="Buscar membros...">
                <div class="flex flex-col space-y-2 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-4">
                    @if (auth()->user()->hasAnyPermission(['create']))
                        <a href="{{ route('members.create') }}"
                            class="flex items-center px-4 py-2 font-bold text-center text-white bg-blue-500 rounded-full hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                <path fill-rule="evenodd"
                                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                            </svg>
                            <span class="ml-2">Cadastrar</span>
                        </a>
                    @endcan
                    <a href="{{ route('members.trash') }}"
                        class="flex items-center px-4 py-2 font-bold text-white bg-red-500 rounded-full mt- hover:bg-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span class="ml-2">Lixeira</span>
                    </a>
            </div>
        </div>
        <div class="w-full overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="w-full p-4 text-gray-900 bg-white">
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
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap no-hide">
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
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 {{ $member->status->tailwind_classes }} rounded-full">
                                        {{ $member->status->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-bold">
                                    @php
                                        $formattedWhatsApp = formatWhatsApp($member->whatsapp);
                                        $whatsappLink =
                                            'https://wa.me/55' . preg_replace('/\D/', '', $member->whatsapp);
                                    @endphp
                                    <a href="{{ $whatsappLink }}" target="_blank"
                                        class="inline-flex text-sm text-blue-500 hover:underline">
                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            height="15" w viewBox="0 0 448 512">
                                            <path
                                                d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                            </path>
                                        </svg>
                                        {{ $formattedWhatsApp }}</a>
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
@vite(['resources/js/member-form.js'])
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
                        const formattedWhatsApp = formatWhatsApp(member.whatsapp);
                        const whatsappLink =
                            `https://wa.me/55${member.whatsapp.replace(/\D/g, '')}`;

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
                            ${member.status ? `<span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full ${member.status.tailwind_classes}">${member.status.name}</span>` : ''}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                            <a href="${whatsappLink}" target="_blank" class="inline-flex text-blue-500 hover:underline">
                                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    height="15" w viewBox="0 0 448 512">
                                    <path
                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                    </path>
                                </svg>
                                ${formattedWhatsApp}</a>
                        </td>
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

        function formatWhatsApp(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
    });
</script>
