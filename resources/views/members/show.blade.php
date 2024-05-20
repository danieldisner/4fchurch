<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Member Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="content-center mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">

                    <div class="flex flex-col items-center">
                        <img id="photo-preview" class="w-32 h-32 mt-4 rounded-full"
                            src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('storage/members/default.png') }}"
                            alt="Photo preview" />
                    </div>
                    <div class="self-center mt-4">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Nome</label>
                                <p class="mt-1 text-gray-900">{{ $member->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">CPF</label>
                                <p class="mt-1 text-gray-900">{{ formatCpf($member->cpf) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">RG</label>
                                <p class="mt-1 text-gray-900">{{ formatRg($member->rg) }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Email</label>
                                <p class="mt-1 text-gray-900">{{ $member->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Telefone</label>
                                <p class="mt-1 text-gray-900">{{ formatPhone($member->phone) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">WhatsApp</label>
                                @php
                                    $formattedWhatsApp = formatWhatsApp($member->whatsapp);
                                    $whatsappLink = 'https://wa.me/55' . preg_replace('/\D/', '', $member->whatsapp);
                                @endphp
                                <a href="{{ $whatsappLink }}" target="_blank"
                                    class="inline-flex font-bold text-blue-500 hover:underline">
                                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        height="20" w viewBox="0 0 448 512">
                                        <path
                                            d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                        </path>
                                    </svg>
                                    {{ $formattedWhatsApp }}</a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">CEP</label>
                                <p class="mt-1 text-gray-900">{{ formatCep($member->address_zipcode) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Rua</label>
                                <p class="mt-1 text-gray-900">{{ $member->address_street }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Número</label>
                                <p class="mt-1 text-gray-900">{{ $member->address_number }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Bairro</label>
                                <p class="mt-1 text-gray-900">{{ $member->address_neighborhood }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Cidade</label>
                                <p class="mt-1 text-gray-900">{{ $member->city }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700">Estado</label>
                                <p class="mt-1 text-gray-900">{{ $member->uf }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <div class="inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="mr-1 bi bi-cake" viewBox="0 0 16 16">
                                        <path
                                            d="m7.994.013-.595.79a.747.747 0 0 0 .101 1.01V4H5a2 2 0 0 0-2 2v3H2a2 2 0 0 0-2 2v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a2 2 0 0 0-2-2h-1V6a2 2 0 0 0-2-2H8.5V1.806A.747.747 0 0 0 8.592.802zM4 6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v.414a.9.9 0 0 1-.646-.268 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0A.9.9 0 0 1 4 6.414zm0 1.414c.49 0 .98-.187 1.354-.56a.914.914 0 0 1 1.292 0c.748.747 1.96.747 2.708 0a.914.914 0 0 1 1.292 0c.374.373.864.56 1.354.56V9H4zM1 11a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.793l-.354.354a.914.914 0 0 1-1.293 0 1.914 1.914 0 0 0-2.707 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0 1.914 1.914 0 0 0-2.708 0 .914.914 0 0 1-1.292 0L1 11.793zm11.646 1.854a1.915 1.915 0 0 0 2.354.279V15H1v-1.867c.737.452 1.715.36 2.354-.28a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.708 0a.914.914 0 0 1 1.292 0c.748.748 1.96.748 2.707 0a.914.914 0 0 1 1.293 0Z" />
                                    </svg>
                                    <label class="block text-sm font-bold text-gray-700">Nascimento</label>
                                </div>
                                <p class="mt-1 text-gray-900">{{ $member->birthdate->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <div class="inline-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-droplet-half" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M7.21.8C7.69.295 8 0 8 0q.164.544.371 1.038c.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8m.413 1.021A31 31 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10c0 0 2.5 1.5 5 .5s5-.5 5-.5c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                                        <path fill-rule="evenodd"
                                            d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87z" />
                                    </svg>
                                    <label class="block text-sm font-bold text-gray-700">Batismo</label>
                                </div>
                                <p class="mt-1 text-gray-900">{{ $member->baptism_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <label class="block font-bold text-gray-700 text-md">Status</label>
                                @switch($member->status->id)
                                    @case(1)
                                        <span
                                            class="inline-flex px-2 text-lg font-semibold leading-5 bg-gray-100 rounded-full text-black-800">
                                            {{ $member->status->name }}
                                        </span>
                                    @break

                                    @case(2)
                                        <span
                                            class="inline-flex px-2 text-lg font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                            {{ $member->status->name }}
                                        </span>
                                    @break

                                    @case(3)
                                        <span
                                            class="inline-flex px-2 text-lg font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            {{ $member->status->name }}
                                        </span>
                                    @break

                                    @case(4)
                                        <span
                                            class="inline-flex px-2 text-lg font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                            {{ $member->status->name }}
                                        </span>
                                    @break

                                    @default
                                        <span
                                            class="inline-flex px-2 text-lg font-semibold leading-5 rounded-full text-black-800 bg-black-100">
                                            {{ $member->status->name }}
                                        </span>
                                    @break
                                @endswitch
                            </div>
                        </div>
                        @if (auth()->user()->hasAnyPermission(['edit']))
                            <div class="flex justify-center mt-6">
                                <a href="{{ route('members.edit', $member) }}"
                                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">Editar
                                    Membro</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
