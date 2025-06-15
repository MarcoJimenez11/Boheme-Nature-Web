@extends('layout')

@section('content')
    {{-- HERO IMAGE --}}
    <section
        class="w-full bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply"
        style="background-image: url('{{ asset('storage/images/hero.jpg') }}')">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Productos
                naturales hechos a mano</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">En Bohême Nature realizamos todo
                el proceso de elaboración artesanalmente de principio a fin, con productos naturales y ecológicos </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="{{ route('productListByCategory', $categories[1]) }}"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Ver tienda
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                <a href="#descriptionBlock"
                    class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                    Leer más
                </a>
            </div>
        </div>
    </section>

    {{-- IMAGE AND TEXT SECTION --}}
    <section id="descriptionBlock" class="bg-gray-50 dark:bg-gray-800">
        <div
            class="flex flex-col lg:flex-row items-center justify-center px-4 py-16 mx-auto max-w-screen-xl space-y-8 lg:space-y-0 lg:space-x-8">
            {{-- Image --}}
            <div class="w-full lg:w-1/2 aspect-square bg-cover bg-center rounded-lg shadow-md"
                style="background-image: url('{{ asset('storage/images/inicio.jpg') }}');">
            </div>
            {{-- <img src="{{ asset('storage/inicio.jpg') }}"
                class="w-full lg:w-1/2 aspect-square bg-cover bg-center rounded-lg shadow-md"> --}}

            {{-- Text --}}
            <div
                class="w-full lg:w-1/2 aspect-square flex flex-col justify-center bg-white dark:bg-gray-900 rounded-lg shadow-md p-8">
                <h3 class="text-2xl font-bold text-primary-800 dark:text-white mb-4">Nuestra Filosofía</h3>
                <p class="text-gray-700 dark:text-gray-400">En Bohême Nature, creemos en la importancia de cuidar la piel
                    con productos naturales y ecológicos. Cada uno de nuestros jabones está hecho a mano con amor y
                    dedicación, utilizando ingredientes de la más alta calidad para garantizar una experiencia única y
                    saludable.</p>
            </div>
        </div>
    </section>

    {{-- IMAGE AND TEXT SECTION --}}
    <section class="bg-gray-50 dark:bg-gray-800">
        <div
            class="flex flex-col lg:flex-row items-center justify-center px-4 py-16 mx-auto max-w-screen-xl space-y-8 lg:space-y-0 lg:space-x-8">
            
            {{-- Text --}}
            <div
                class="w-full lg:w-1/2 aspect-square flex flex-col justify-center bg-white dark:bg-gray-900 rounded-lg shadow-md p-8">
                <h3 class="text-2xl font-bold text-primary-800 dark:text-white mb-4">Nuestro Producto</h3>
                <p class="text-gray-700 dark:text-gray-400">Cada producto de nuestra tienda está elaborado a mano con ingredientes ecológicos y de gran calidad
                    para ofrecerte una experiencia única. Nuestros jabones son perfectos para todo tipo de piel, ya que
                    están libres de químicos y conservantes, lo que los hace ideales para el cuidado diario.</p>
                </p>
            </div>
            
            
            {{-- Image --}}
            <div class="w-full lg:w-1/2 aspect-square bg-cover bg-center rounded-lg shadow-md"
                style="background-image: url('{{ asset('storage/images/inicio2.jpg') }}');">
            </div>

            
        </div>
    </section>


    {{-- ABOUT US --}}
    <section class="bg-white dark:bg-gray-900">
        <div class="px-4 py-8 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <h2 class="mb-4 text-4xl font-extrabold text-center text-primary-800 dark:text-white">Sobre nosotros</h2>
            <p class="mb-8 text-lg font-normal text-center text-gray-500 lg:mb-16 sm:px-16 lg:px-48 dark:text-gray-400">Bohême Nature es un pequeño negocio familiar con
                gran pasión por la elaboración de productos naturales y ecológicos. Nos dedicamos a crear jabones artesanales de alta calidad,
                utilizando ingredientes puros y sostenibles.</p>
            </p>
        </div>
    </section>
@endsection
