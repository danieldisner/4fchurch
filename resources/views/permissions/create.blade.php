<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Regras / Papéis') }}
        </h2>
    </x-slot>
    <div class="container p-4 mx-auto">
        <div class="mb-4">
            <h1 class="text-2xl font-bold">{{ isset($permission) ? 'Edit Permission' : 'Create Permission' }}</h1>
        </div>
        <form action="{{ isset($permission) ? route('permissions.update', $permission) : route('permissions.store') }}"
            method="POST">
            @csrf
            @if (isset($permission))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Permission Name:</label>
                <input type="text" id="name" name="name" value="{{ $permission->name ?? old('name') }}"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                {{ isset($permission) ? 'Update' : 'Create' }}
            </button>
        </form>
    </div>
</x-app-layout>
