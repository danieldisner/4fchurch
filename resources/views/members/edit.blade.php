<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar Membro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('members.update', $member) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2">
                            <div class="flex flex-col items-center">
                                <img id="photo-preview" class="w-32 h-32 mt-4 rounded-full"
                                    src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('storage/members/default.png') }}"
                                    alt="Photo preview" />
                                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                                <input type="file" name="photo" id="photo"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $member->name) }}" required
                                    placeholder="Ex: Joaquim Teixeira..."
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                                <input type="text" name="cpf" id="cpf"
                                    value="{{ old('cpf', formatCpf($member->cpf)) }}" required placeholder="CPF"
                                    placeholder="Ex: 123.456.789-10"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="rg" class="block text-sm font-medium text-gray-700">RG</label>
                                <input type="text" name="rg" id="rg"
                                    value="{{ old('rg', formatRg($member->rg)) }}" required
                                    placeholder="Ex: 123.456.789-10"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $member->email) }}" required
                                    placeholder="Ex: joaquim@example.com"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="profession"
                                    class="block text-sm font-medium text-gray-700">Profissão</label>
                                <input type="text" name="profession" id="profession"
                                    value="{{ old('profession', $member->profession) }}" required placeholder="Mecânico"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                                <input type="text" name="phone" id="phone"
                                    value="{{ old('phone', formatPhone($member->phone)) }}"
                                    placeholder="(11) 99999-9999"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                                <input type="text" name="whatsapp" id="whatsapp"
                                    value="{{ old('whatsapp', formatWhatsapp($member->whatsapp)) }}"
                                    placeholder="(11) 99999-9999"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label for="address_zipcode" class="block text-sm font-medium text-gray-700">CEP</label>
                                <input type="text" name="address_zipcode" id="address_zipcode"
                                    value="{{ old('address_zipcode', formatCep($member->address_zipcode)) }}"
                                    placeholder="99999-999"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="address_street" class="block text-sm font-medium text-gray-700">Rua</label>
                                <input type="text" name="address_street" id="address_street"
                                    value="{{ old('address_street', $member->address_street) }}"
                                    placeholder="Nome da Rua"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="address_number"
                                    class="block text-sm font-medium text-gray-700">Número</label>
                                <input type="text" name="address_number" id="address_number"
                                    value="{{ old('address_number', $member->address_number) }}" placeholder="123"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label for="address_neighborhood"
                                    class="block text-sm font-medium text-gray-700">Bairro</label>
                                <input type="text" name="address_neighborhood" id="address_neighborhood"
                                    value="{{ old('address_neighborhood', $member->address_neighborhood) }}"
                                    placeholder="Nome do Bairro"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                                <input type="text" name="city" id="city"
                                    value="{{ old('city', $member->city) }}" placeholder="Nome da Cidade"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="uf" class="block text-sm font-medium text-gray-700">Estado</label>
                                <select name="uf" id="uf"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Selecione o Estado</option>
                                    <option value="AC" {{ old('uf', $member->uf) == 'AC' ? 'selected' : '' }}>Acre
                                    </option>
                                    <option value="AL" {{ old('uf', $member->uf) == 'AL' ? 'selected' : '' }}>
                                        Alagoas</option>
                                    <option value="AP" {{ old('uf', $member->uf) == 'AP' ? 'selected' : '' }}>
                                        Amapá</option>
                                    <option value="AM" {{ old('uf', $member->uf) == 'AM' ? 'selected' : '' }}>
                                        Amazonas</option>
                                    <option value="BA" {{ old('uf', $member->uf) == 'BA' ? 'selected' : '' }}>
                                        Bahia</option>
                                    <option value="CE" {{ old('uf', $member->uf) == 'CE' ? 'selected' : '' }}>
                                        Ceará</option>
                                    <option value="DF" {{ old('uf', $member->uf) == 'DF' ? 'selected' : '' }}>
                                        Distrito Federal</option>
                                    <option value="ES" {{ old('uf', $member->uf) == 'ES' ? 'selected' : '' }}>
                                        Espírito Santo</option>
                                    <option value="GO" {{ old('uf', $member->uf) == 'GO' ? 'selected' : '' }}>
                                        Goiás</option>
                                    <option value="MA" {{ old('uf', $member->uf) == 'MA' ? 'selected' : '' }}>
                                        Maranhão</option>
                                    <option value="MT" {{ old('uf', $member->uf) == 'MT' ? 'selected' : '' }}>Mato
                                        Grosso</option>
                                    <option value="MS" {{ old('uf', $member->uf) == 'MS' ? 'selected' : '' }}>Mato
                                        Grosso do Sul</option>
                                    <option value="MG" {{ old('uf', $member->uf) == 'MG' ? 'selected' : '' }}>
                                        Minas Gerais</option>
                                    <option value="PA" {{ old('uf', $member->uf) == 'PA' ? 'selected' : '' }}>Pará
                                    </option>
                                    <option value="PB" {{ old('uf', $member->uf) == 'PB' ? 'selected' : '' }}>
                                        Paraíba</option>
                                    <option value="PR" {{ old('uf', $member->uf) == 'PR' ? 'selected' : '' }}>
                                        Paraná</option>
                                    <option value="PE" {{ old('uf', $member->uf) == 'PE' ? 'selected' : '' }}>
                                        Pernambuco</option>
                                    <option value="PI" {{ old('uf', $member->uf) == 'PI' ? 'selected' : '' }}>
                                        Piauí</option>
                                    <option value="RJ" {{ old('uf', $member->uf) == 'RJ' ? 'selected' : '' }}>Rio
                                        de Janeiro</option>
                                    <option value="RN" {{ old('uf', $member->uf) == 'RN' ? 'selected' : '' }}>Rio
                                        Grande do Norte</option>
                                    <option value="RS" {{ old('uf', $member->uf) == 'RS' ? 'selected' : '' }}>Rio
                                        Grande do Sul</option>
                                    <option value="RO" {{ old('uf', $member->uf) == 'RO' ? 'selected' : '' }}>
                                        Rondônia</option>
                                    <option value="RR" {{ old('uf', $member->uf) == 'RR' ? 'selected' : '' }}>
                                        Roraima</option>
                                    <option value="SC" {{ old('uf', $member->uf) == 'SC' ? 'selected' : '' }}>
                                        Santa Catarina</option>
                                    <option value="SP" {{ old('uf', $member->uf) == 'SP' ? 'selected' : '' }}>São
                                        Paulo</option>
                                    <option value="SE" {{ old('uf', $member->uf) == 'SE' ? 'selected' : '' }}>
                                        Sergipe</option>
                                    <option value="TO" {{ old('uf', $member->uf) == 'TO' ? 'selected' : '' }}>
                                        Tocantins</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label for="birthdate"
                                    class="block text-sm font-medium text-gray-700">Nascimento</label>
                                <input type="date" name="birthdate" id="birthdate"
                                    value="{{ old('birthdate', $member->birthdate->format('Y-m-d')) }}" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="baptism_date"
                                    class="block text-sm font-medium text-gray-700">Batismo</label>
                                <input type="date" name="baptism_date" id="baptism_date"
                                    value="{{ old('baptism_date', $member->baptism_date->format('Y-m-d')) }}" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="status_id" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status_id" id="status_id" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ $member->status_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-center mt-6">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                                Editar Membro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite(['resources/js/member-form.js'])
