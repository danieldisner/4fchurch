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
                                <label class="block text-sm font-medium text-gray-700">Nome</label>
                                <p class="mt-1 text-gray-900">{{ $member->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CPF</label>
                                <p class="mt-1 text-gray-900">{{ $member->cpf }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">RG</label>
                                <p class="mt-1 text-gray-900">{{ $member->rg }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="mt-1 text-gray-900">{{ $member->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Telefone</label>
                                <p class="mt-1 text-gray-900">{{ $member->phone }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">WhatsApp</label>
                                <p class="mt-1 text-gray-900">{{ $member->whatsapp }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CEP</label>
                                <p class="mt-1 text-gray-900">{{ $member->address_zipcode }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rua</label>
                                <p class="mt-1 text-gray-900">{{ $member->address_street }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Número</label>
                                <p class="mt-1 text-gray-900">{{ $member->address_number }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bairro</label>
                                <p class="mt-1 text-gray-900">{{ $member->address_neighborhood }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cidade</label>
                                <p class="mt-1 text-gray-900">{{ $member->city }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estado</label>
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
                                    <label class="block text-sm font-medium text-gray-700">Nascimento</label>
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
                                    <label class="block text-sm font-medium text-gray-700">Batismo</label>
                                </div>
                                <p class="mt-1 text-gray-900">{{ $member->baptism_date->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
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
                            </div>
                        </div>

                        <div class="flex justify-center mt-6">
                            <a href="{{ route('members.edit', $member) }}"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">Edit
                                Member</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
