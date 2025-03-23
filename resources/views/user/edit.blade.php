@extends('layout')

@section('content')
    @include('errorAlert')

    <section class="ml-10 mr-10">
        <section
            class="flex flex-col bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-center text-2xl font-semibold mb-4">Cambiar nombre de usuario</h2>
            <form method="POST" action="{{ route('userEditNamePut', $user) }}" class="max-w-sm mx-auto">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="userName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" name="userName" value="{{ $user->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <button type="submit"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
            </form>
        </section>

        <section>
            <h2>Cambiar e-mail de usuario</h2>
            <form method="POST" action="{{ route('userEditEmailPut', $user) }}" class="max-w-sm mx-auto">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="userEmail"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="userEmail" value="{{ $user->email }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
            </form>
        </section>

        <section>
            <h2>Cambiar contraseña</h2>
            <form method="POST" action="{{ route('userEditPasswordPut', $user) }}" class="max-w-sm mx-auto">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="userOldPassword"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Antigua
                        contraseña</label>
                    <input type="password" name="userOldPassword"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="mb-5">
                    <label for="userNewPassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva
                        contraseña</label>
                    <input type="password" name="userNewPassword"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="mb-5">
                    <label for="userNewPasswordRepeat"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repetir nueva
                        contraseña</label>
                    <input type="password" name="userNewPasswordRepeat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
            </form>
        </section>

        @auth
            @if (Auth::user()->is_admin)
                <section>
                    <h2>Cambiar rol de usuario</h2>
                    <form method="POST" action="{{ route('userEditIsAdminPut', $user) }}" class="max-w-sm mx-auto">
                        @csrf
                        @method('PUT')

                        <label for="userIsAdmin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Administrador</label>
                        <input type="checkbox" name="userIsAdmin" checked="@if ($user->is_admin) checked @endif">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar</button>
                    </form>
                </section>
            @endif
        @endauth

    </section>
@endsection
