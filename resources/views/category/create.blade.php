@extends('layoutAdmin')

@section('content')
    <section class="mt-8 flex flex-col items-center justify-center">
        @include('errorAlert')

        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" method="POST" action="{{ route('categoryCreatePost') }}">
                @csrf

                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Crear Categoría</h5>
                <div>
                    <label for="categoryName"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" name="categoryName" id="categoryName"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ old('categoryName') }}" required />
                </div>

                <x-form.button>Crear</x-form.button>
            </form>
        </div>
    </section>
@endsection
