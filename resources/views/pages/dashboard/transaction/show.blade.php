<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard.transaction.index') }}"
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
                                Transactions
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $transaction->id }} - {{ $transaction->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            var datatable = $('#crudTable').dataTable({
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        width: '5%'
                    },
                    {
                        data: 'product.title',
                        name: 'product.title'
                    },
                    {
                        data: 'product.price',
                        name: 'product.price'
                    }
                ]
            })
        </script>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-lg text-gray-800 leading-tight mb-5">
                Transaction Details
            </h1>
            <div class="shadow overflow-hidden sm:rounded-lg">
                <div class="bg-white p-6 border-b border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                            <tr>
                                <th class="border px-6 py-4 text-right">Name</th>
                                <td class="border px-6 py-4">{{ $transaction->name }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Email</th>
                                <td class="border px-6 py-4">{{ $transaction->email }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Telp</th>
                                <td class="border px-6 py-4">{{ $transaction->telp }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Payment</th>
                                <td class="border px-6 py-4">{{ $transaction->payment }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Payment URL</th>
                                <td class="border px-6 py-4">{{ $transaction->payment_url }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Total Harga</th>
                                <td class="border px-6 py-4">{{ $transaction->total_price }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Status</th>
                                <td class="border px-6 py-4">{{ $transaction->status }}</td>
                            </tr>
                            <tbody>
                            </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <h1 class="font-semibold text-lg text-gray-800 leading-tight mb-5 mt-5">
                Transaction Items
            </h1>
            <div class="shadow overflow-hidden sm-rounded-lg">
                <div class="div px-4 py-5 bg-white sm:p-6">

                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

</x-app-layout>