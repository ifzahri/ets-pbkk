<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dokter Dashboard') }}
        </h2>
    </x-slot>

    <div class= >

        <!-- Dokter Information Card -->
        <a href="#"
            class="block w-full max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Welcome, Dr. {{ $dokter->nama }}
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Email: {{ $dokter->email }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Phone: {{ $dokter->nomor_telepon }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Specialization: {{ $dokter->keahlian }}</p>
        </a>

        <!-- Konsultasi Requests Section -->
        <section class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Konsultasi Requests</h2>

            @if ($konsultasis->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No konsultasi requests yet.</p>
            @else
                <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">Nama</th>
                                <th scope="col" class="px-4 py-4">Keluhan</th>
                                <th scope="col" class="px-4 py-4">Status</th>
                                <th scope="col" class="px-4 py-4">Tanggal Keluhan</th>
                                <th scope="col" class="px-4 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasis as $konsultasi)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-4 py-4">{{ $konsultasi->pasien->nama }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->keluhan }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->status }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->tanggal_keluhan }}</td>
                                    <td class="px-4 py-4 flex items-center justify-end">
                                        <!-- Actions Dropdown -->
                                        <button id="dropdown-button-{{ $konsultasi->id }}"
                                            data-dropdown-toggle="dropdown-{{ $konsultasi->id }}"
                                            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="dropdown-{{ $konsultasi->id }}" class="hidden z-10 w-44 bg-white rounded-lg shadow dark:bg-gray-700">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <button class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Edit</button>
                                                </li>
                                                <li>
                                                    <button class="w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">View</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <nav class="p-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Showing 1-10 of 1000</span>
                        {{ $konsultasis->links() }}
                    </nav>
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
