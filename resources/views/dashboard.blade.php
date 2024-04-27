<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" flex items-center justify-between  p-6 text-gray-900 dark:text-gray-100">

                    {{ __("Listado de usuarios del sistema") }}

                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    >{{ __('Agregar usuario') }}</x-primary-button>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>


                        <div class="max-w-7xl mx-auto sm:px-9  lg:px-8">
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center mb-5 ">
                                    <h1>Agregar Usuario</h1>
                                </div>
                            </div>
                            <form method="post" action="{{ route('user.store') }}">
                                @csrf


                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Nombre')"/>
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                                  :value="old('name')" required autofocus autocomplete="Nombre"/>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                </div>
                                <div>
                                    <x-input-label for="last_name" :value="__('Apellido')"/>
                                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                                  :value="old('last_name')" required autofocus
                                                  autocomplete="last_name"/>
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                                </div>
                                <div>
                                    <x-input-label for="phone" :value="__('Telefono')"/>
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                                  :value="old('phone')" required autofocus autocomplete="phone"/>
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Correo')"/>
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                  :value="old('email')" required autocomplete="email"/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Contrasenha')"/>

                                    <x-text-input id="password" class="block mt-1 w-full"
                                                  type="password"
                                                  name="password"
                                                  required autocomplete="new-password"/>

                                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                  type="password"
                                                  name="password_confirmation" required autocomplete="new-password"/>

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                                </div>


                                <div class="flex items-center justify-end mt-4">


                                    <x-primary-button class="ml-2" >
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>


                    </x-modal>
                </div>
                <div>


                    <x-table-user :items="$users" :columnas="$columnas"/>


                </div>
            </div>
        </div>

    </div>


</x-app-layout>
