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

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nascimento</label>
                                <p class="mt-1 text-gray-900">{{ $member->birthdate->format('d/m/Y') }}</p>
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
