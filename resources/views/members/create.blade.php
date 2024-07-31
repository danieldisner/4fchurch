<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Cadastrar Membro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Row 4: Status, Photo -->
                        <div class="grid grid-cols-1 gap-4 mt-4 mb-2 md:grid-cols-2">
                            <div>
                                <img id="photo-preview" class="w-32 h-32 mt-4 rounded-full"
                                    src="{{ asset('storage/members/default.png') }}" alt="Photo preview"
                                    style="" />

                                <label for="photo" class="block text-sm font-medium text-gray-700">Foto</label>
                                <input type="file" name="photo" id="photo"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                <input type="text" name="name" id="name" required
                                    placeholder="Ex: Joaquim Teixeira..."
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                                <input type="text" name="cpf" id="cpf" required
                                    placeholder="Ex: 123.456.789-10"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="rg" class="block text-sm font-medium text-gray-700">RG</label>
                                <input type="text" name="rg" id="rg" required
                                    placeholder="Ex: 123.456.789-10"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" required
                                    placeholder="Ex: joaquim@example.com"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="profession"
                                    class="block text-sm font-medium text-gray-700">Profissão</label>
                                <input type="text" name="profession" id="profession" required placeholder="Mecânico"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                                <input type="text" name="phone" id="phone" placeholder="(11) 99999-9999"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                                <input type="text" name="whatsapp" id="whatsapp" placeholder="(11) 99999-9999"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label for="address_zipcode" class="block text-sm font-medium text-gray-700">CEP</label>
                                <input type="text" name="address_zipcode" id="address_zipcode"
                                    placeholder="99999-999"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="address_street" class="block text-sm font-medium text-gray-700">Rua</label>
                                <input type="text" name="address_street" id="address_street"
                                    placeholder="Nome da Rua"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="address_number"
                                    class="block text-sm font-medium text-gray-700">Número</label>
                                <input type="text" name="address_number" id="address_number" placeholder="123"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label for="address_neighborhood"
                                    class="block text-sm font-medium text-gray-700">Bairro</label>
                                <input type="text" name="address_neighborhood" id="address_neighborhood"
                                    placeholder="Nome do Bairro"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                                <input type="text" name="city" id="city" placeholder="Nome da Cidade"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:italic focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="uf" class="block text-sm font-medium text-gray-700">Estado</label>
                                <select name="uf" id="uf"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Selecione o Estado</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                            <div>
                                <label for="birthdate"
                                    class="block text-sm font-medium text-gray-700">Nascimento</label>
                                <input type="date" name="birthdate" id="birthdate" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="baptism_date"
                                    class="block text-sm font-medium text-gray-700">Batismo</label>
                                <input type="date" name="baptism_date" id="baptism_date" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="status_id" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status_id" id="status_id" required
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-center mt-6">
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">
                                Cadastrar Membro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite(['resources/js/member-form.js'])
