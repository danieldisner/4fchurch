<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar Papel') }}
        </h2>
    </x-slot>

    <div class="container p-4 mx-auto">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h1>
        </div>
        <form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
            @csrf
            @if (isset($role))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Role Name:</label>
                <input type="text" id="name" name="name" value="{{ $role->name ?? old('name') }}"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="mb-4">
                <label for="permissions" class="block text-gray-700">Permissions:</label>
                <select id="permissions" name="permissions[]" multiple
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}"
                            {{ isset($role) && $role->permissions->contains($permission) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                {{ isset($role) ? 'Update' : 'Create' }}
            </button>
        </form>
    </div>
</x-app-layout>
