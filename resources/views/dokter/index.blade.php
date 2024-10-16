<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dokter Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 space-y-6">

        <!-- Dokter Information Card -->
        <a href="#"
            class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Welcome, Dr. {{ $dokter->nama }}
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Email: {{ $dokter->email }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Phone: {{ $dokter->nomor_telepon }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Specialization: {{ $dokter->keahlian }}</p>
        </a>
        
        <!-- Konsultasi Requests Section -->
        <section class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Konsultasi Requests
            </h2>

            @if ($konsultasis->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No konsultasi requests yet.</p>
            @else
                <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="search" name="search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            value="{{ request('search') }}" placeholder="Search" required="">
                                    </div>
                                </form>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <form action="{{ route('dokter.index') }}" method="GET">
                                        <label for="status">Filter by Status:</label>
                                        <select name="status" id="status" onchange="this.form.submit()">
                                            <option value="">All</option>
                                            <option value="pending"
                                                {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="diterima"
                                                {{ request('status') == 'diterima' ? 'selected' : '' }}>Accepted
                                            </option>
                                            <option value="ditolak"
                                                {{ request('status') == 'ditolak' ? 'selected' : '' }}>Rejected
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
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
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="dropdown-button-{{ $konsultasi->id }}"
                                                data-dropdown-toggle="dropdown-{{ $konsultasi->id }}"
                                                class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                            <div id="dropdown-{{ $konsultasi->id }}"
                                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm"
                                                    aria-labelledby="dropdown-button-{{ $konsultasi->id }}">
                                                    <li>
                                                        <button type="button"
                                                            data-modal-target="updateDataModal-{{ $konsultasi->id }}"
                                                            data-modal-toggle="updateDataModal-{{ $konsultasi->id }}"
                                                            class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                                viewbox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path
                                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                            </svg>
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            data-modal-target="readDataModal-{{ $konsultasi->id }}"
                                                            data-modal-toggle="readDataModal-{{ $konsultasi->id }}"
                                                            class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                            <svg class="w-4 h-4 mr-2"
                                                                xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                            View
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Update modal -->
                                    <div id="updateDataModal-{{ $konsultasi->id }}" tabindex="-1"
                                        aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div
                                                class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Update Data</h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="updateDataModal-{{ $konsultasi->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form
                                                    action="{{ route('dokter.addMedication', ['id' => $konsultasi->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                        <div>
                                                            <label for="name"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                            <input type="text" name="name" id="name"
                                                                value="{{ $konsultasi->pasien->nama }}"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                                disabled>
                                                        </div>
                                                        <div>
                                                            <label for="keluhan"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keluhan</label>
                                                            <input type="text" name="keluhan" id="keluhan"
                                                                value="{{ $konsultasi->keluhan }}"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                                disabled>
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label for="penanganan"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penanganan</label>
                                                            <textarea id="penanganan" name="penanganan" rows="5"
                                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                                placeholder="Write penanganan here...">{{ $konsultasi->penanganan }}</textarea>
                                                        </div>
                                                    </div>
                                                    <button type="submit"
                                                        class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                        Save Changes
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Read modal -->
                                    <div id="readDataModal-{{ $konsultasi->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-xl max-h-full">
                                            <!-- Modal content -->
                                            <div
                                                class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <!-- Modal header -->
                                                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                                                        <h3 class="font-semibold">{{ $konsultasi->pasien->nama }}
                                                        </h3>
                                                        <p class="font-bold">
                                                            {{ $konsultasi->created_at->format('M d, Y') }}</p>
                                                    </div>
                                                    <div>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-toggle="readDataModal-{{ $konsultasi->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5"
                                                                fill="currentColor" viewbox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <dl>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Keluhan</dt>
                                                    <dd
                                                        class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                        {{ $konsultasi->keluhan }}
                                                    </dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Penanganan</dt>
                                                    <dd
                                                        class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                        {{ $konsultasi->penanganan ?? '-' }}
                                                    </dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Status</dt>
                                                    <dd
                                                        class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                        {{ $konsultasi->status }}
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <nav class="p-4 flex justify-between items-center">
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $konsultasis->links() }}</span>
                        </nav>
                    </div>
            @endif
        </section>
    </div>
</x-app-layout>
