<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Criar Papel') }}
        </h2>
    </x-slot>

    <div class="container p-4 mx-auto">
        <div class="max-w-lg mx-auto">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Nome do Papel</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-md"
                        required>
                </div>

                <div class="mb-4">
                    <label for="permissions" class="block mb-2 text-sm font-medium text-gray-600">Permissões</label>
                    <select name="permissions[]" id="permissions" multiple class="w-full px-3 py-2 border rounded-md">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Criar
                        Papel</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
