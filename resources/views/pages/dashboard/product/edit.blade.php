<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{-- Breadcrumb --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard.product.index') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2"
                                xmlns:xlink="http://www.w3.org/1999/xlink" height="800px" width="800px" version="1.1"
                                id="_x32_" viewBox="0 0 512 512" xml:space="preserve">
                                <style type="text/css">
                                    .st0 {
                                        fill: #000000;
                                    }
                                </style>
                                <g>
                                    <polygon class="st0"
                                        points="465.209,302.804 511.996,256.009 360.602,104.624 256.004,209.213 198.176,151.394 302.782,46.795    256.004,0 104.602,151.394 209.217,256 151.398,313.838 46.782,209.213 0.004,256 151.398,407.394 256.004,302.787    313.832,360.606 209.217,465.214 256.004,512 407.398,360.606 302.782,256 360.602,198.18  " />
                                </g>
                            </svg>
                            Products
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Edit
                                Products</span>
                        </div>
                    </li>
                </ol>
            </nav>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="md-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's Something Wrong!
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-5 text-red-700">
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('dashboard.product.update', $product->id) }}" class="w-full" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="flex flex-wrap -mx-3 -mb-6">
                        <div class="w-full px-3">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                            <input type="text" placeholder="Product Name" value="{{ old('title') ?? $product->title }}"
                                name="title"
                                class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-tight outline-none focus:outline-none focus:bg-white focus:border-pink-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 -mb-6">
                        <div class="w-full px-3 mb-8 mt-8">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Description</label>
                            <textarea name="description" id="description"
                                class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-tight outline-none focus:outline-none focus:bg-white focus:border-pink-500">{!! old('description') ?? $product->description !!}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 -mb-6">
                        <div class="w-full px-3 mb-8">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Price</label>
                            <input type="text" value="{{ old('price') ?? $product->price }}" name="price"
                                class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-tight outline-none focus:outline-none focus:bg-white focus:border-pink-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 -mb-6">
                        <div class="w-full px-3 mb-6">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Qty</label>
                            <input type="text" value="{{ old('qty') ?? $product->qty }}" name="qty"
                                class="block w-full bg-gray-200 text-gray-700 border-gray-200 rounded py-3 px-4 leading-tight outline-none focus:outline-none focus:bg-white focus:border-pink-500">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 -mb-6">
                        <div class="w-full px-3 mt-6">
                            <button type="submit"
                                class="bg-pink-400 text-white font-bold py-2 px-4 rounded shadow-lg">Simpan Perubahan</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

</x-app-layout>
