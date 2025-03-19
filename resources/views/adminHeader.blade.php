@auth
    @if (Auth::user()->is_admin)
        <nav class="bg-cyan-500 border-gray-200 dark:bg-gray-900">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
                {{-- ADMIN TITLE --}}
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Menú de
                    Administrador</span>


                <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                    {{-- USER LIST --}}
                    <a href="{{ route('userList') }}"
                        class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Gestionar
                        Usuarios
                    </a>

                    {{-- CATEGORY LIST --}}
                    <a href="{{ route('categoryList') }}"
                        class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Gestionar
                        Categorías
                    </a>

                    {{-- PRODUCT LIST --}}
                    <a href="{{ route('productList') }}"
                        class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Gestionar
                        Productos
                    </a>


                </div>
            </div>
        </nav>
    @endif
@endauth
