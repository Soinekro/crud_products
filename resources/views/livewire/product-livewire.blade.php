<div wire:init="loadItems">
    <div class="flex flex-row my-4">
        <x-button class="w-32 m-3" type="button" wire:click="create">
            {{ __('Crear producto') }}
        </x-button>
    </div>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Good job</strong>
            <span class="block sm:inline">
                {{ session('message') }}
            </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
    <!-- table -->
    <div class="mt-4">
        <div class="flex">
            <!-- paginacion -->
            <div class="flex-1">
                <div class="flex justify-end">
                    <select wire:model.lazy="perPage"
                        class="w-24 px-2 py-1 text-xs text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="block xs:flex sm:items-center w-full">
                <label for="search" class="text-gray-700 dark:text-gray-400">
                    {{ __('Buscar') }}
                </label>
                <input type="text"
                    class="sm:max-w-max mx-2 w-full md:w-1/3 text-gray-800 rounded-md text-xs font-medium"
                    placeholder="{{ __('Buscar') }}" wire:model.lazy="search" />
            </div>
        </div>
        @if (count($products))
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Id') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Producto') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Descripción') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Precio') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Stock') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Acciones') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->id}}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->name}}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->description}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->price}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->stock}}
                                </td>
                                <td class="px-6 py-4">
                                    <x-button class="w-24 m-2 bg-green-800 hover:bg-green-300" type="button"
                                        wire:click="edit({{ $item->id}})">
                                        {{ __('Editar') }}
                                    </x-button>
                                    <x-button class="w-24 m-2 bg-blue-800 hover:bg-blue-300" type="button"
                                        wire:click="show({{ $item->id}})">
                                        {{ __('Ver') }}
                                    </x-button>
                                    <x-danger-button class="w-24 m-2" type="button"
                                        wire:click="delete({{ $item->id}})">
                                        {{ __('Eliminar') }}
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- @dd($products) --}}
            @if ($products->hasPages())
                <div class=" p-1 bg-gray-300 border-t border-gray-200 sm:px-6">
                    {{ $products->links() }}
                </div>
            @endif
        @elseif ($products != [])
            <tr>
                <div class="block md:flex mt-4 p-4">
                    <div class="mb-2 md:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 inline mr-3 fill-red-500"
                            viewBox="0 0 512 512">
                            <path
                                d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <div class="dark:text-white">
                        <p class="font-bold">
                            {{ __('No hay registros') }}
                        </p>
                        <p>
                            {{ $message ?? __('Por favor cree un registro') }}
                        </p>
                    </div>
                </div>
            </tr>
        @else
            <div>
                <style>
                    .loader-dots div {
                        animation-timing-function: cubic-bezier(0, 1, 1, 0);
                    }

                    .loader-dots div:nth-child(1) {
                        left: 8px;
                        animation: loader-dots1 0.6s infinite;
                    }

                    .loader-dots div:nth-child(2) {
                        left: 8px;
                        animation: loader-dots2 0.6s infinite;
                    }

                    .loader-dots div:nth-child(3) {
                        left: 32px;
                        animation: loader-dots2 0.6s infinite;
                    }

                    .loader-dots div:nth-child(4) {
                        left: 56px;
                        animation: loader-dots3 0.6s infinite;
                    }

                    @keyframes loader-dots1 {
                        0% {
                            transform: scale(0);
                        }

                        100% {
                            transform: scale(1);
                        }
                    }

                    @keyframes loader-dots3 {
                        0% {
                            transform: scale(1);
                        }

                        100% {
                            transform: scale(0);
                        }
                    }

                    @keyframes loader-dots2 {
                        0% {
                            transform: translate(0, 0);
                        }

                        100% {
                            transform: translate(24px, 0);
                        }
                    }
                </style>
                <div class="fixed top-0 left-0 z-50 w-screen h-screen flex items-center justify-center"
                    style="background: rgba(0, 0, 0, 0.3);">
                    <div class="bg-white border py-2 px-5 rounded-lg flex items-center flex-col">
                        <div class="loader-dots block relative w-20 h-5 mt-2">
                            <div class="absolute top-0 mt-1 w-3 h-3 rounded-full bg-green-500"></div>
                            <div class="absolute top-0 mt-1 w-3 h-3 rounded-full bg-green-500"></div>
                            <div class="absolute top-0 mt-1 w-3 h-3 rounded-full bg-green-500"></div>
                            <div class="absolute top-0 mt-1 w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <div class="text-gray-500 text-xs font-light mt-2 text-center">
                            {{ __('Please wait') }}...
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Crear producto') }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <x-label for="name" :value="__('Nombre')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div>
                    <x-label for="description" :value="__('Descripción')" />
                    <x-input id="description" class="block mt-1 w-full" type="text" wire:model="description"
                        required />
                    <x-input-error for="description" class="mt-2" />
                </div>
                <div>
                    <x-label for="price" :value="__('Precio')" />
                    <x-input id="price" class="block mt-1 w-full" type="number" wire:model="price" required />
                    <x-input-error for="price" class="mt-2" />
                </div>
                <div>
                    <x-label for="stock" :value="__('Stock')" />
                    <x-input id="stock" class="block mt-1 w-full" type="number" wire:model="stock" required />
                    <x-input-error for="stock" class="mt-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">

            <x-button class="ml-4" wire:click="save">{{ __('Guardar') }}</x-button>
            <x-button class="ml-4" wire:click="close">{{ __('Cerrar') }}</x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="showModalProduct">
        <x-slot name="title">
            {{ __('Información del producto') }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <x-label for="name" :value="__('Id')" />
                    <div>
                        {{ $id_product ?? '' }}
                    </div>
                </div>
                <div>
                    <x-label for="name" :value="__('Nombre')" />
                    <div>
                        {{ $name }}
                    </div>
                </div>
                <div>
                    <x-label for="description" :value="__('Descripción')" />
                    <div>
                        {{ $description }}
                    </div>
                </div>
                <div>
                    <x-label for="price" :value="__('Precio')" />
                    <div>
                        {{ $price }}
                    </div>
                </div>
                <div>
                    <x-label for="stock" :value="__('Stock')" />
                    <div>
                        {{ $stock }}
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button class="ml-4" wire:click="close">{{ __('Cerrar') }}</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
