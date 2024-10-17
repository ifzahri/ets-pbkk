<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dokter Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto space-y-6 p-6">
        <!-- Dokter Information Card -->
        <a
            href="#"
            class="block max-w-full rounded-lg border border-gray-200 bg-white p-6 shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
        >
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Welcome, Dr. {{ $dokter->nama }}
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Email: {{ $dokter->email }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Phone: {{ $dokter->nomor_telepon }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Specialization: {{ $dokter->keahlian }}</p>
        </a>

        <!-- Konsultasi Requests Section -->
        <section class="rounded-lg bg-gray-50 p-6 shadow dark:bg-gray-900">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Your Konsultasi Requests
            </h2>

            @if ($konsultasis->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No konsultasi requests yet.</p>
            @else
                <div class="overflow-x-auto rounded-lg bg-white shadow dark:bg-gray-800">
                    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                        <div
                            class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0"
                        >
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                        >
                                            <svg
                                                aria-hidden="true"
                                                class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor"
                                                viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            id="search"
                                            name="search"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                            value="{{ request('search') }}"
                                            placeholder="Search"
                                            required=""
                                        />
                                    </div>
                                </form>
                            </div>
                            <div
                                class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0"
                            >
                                <div class="flex w-full items-center space-x-3 md:w-auto">
                                    <form action="{{ route('dokter.index') }}" method="GET" class="flex items-center space-x-3 p-4 bg-white rounded-lg  dark:bg-gray-800">
                                        <label for="status" class="text-lg font-semibold text-gray-700 dark:text-gray-200">Filter by Status:</label>
                                        <select name="status" id="status" class="appearance-none bg-white border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-60 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            onchange="this.form.submit()">
                                            <option value="" class="text-gray-500">All</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Accepted</option>
                                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                    
                                    <style>
                                        select {
                                            transition: border-color 0.3s, box-shadow 0.3s;
                                        }
                                        select:hover {
                                            border-color: #5C6BC0;
                                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                        }
                                    </style>
                                    
                                </div>
                            </div>
                        </div>
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead
                                class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400"
                            >
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
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <td class="px-4 py-4">{{ $konsultasi->pasien->nama }}</td>
                                        <td class="px-4 py-4">{{ $konsultasi->keluhan }}</td>
                                        <td class="px-4 py-4">{{ $konsultasi->status }}</td>
                                        <td class="px-4 py-4">{{ $konsultasi->tanggal_keluhan }}</td>
                                        <td class="flex items-center justify-end px-4 py-3">
                                            <button
                                                id="dropdown-button-{{ $konsultasi->id }}"
                                                data-dropdown-toggle="dropdown-{{ $konsultasi->id }}"
                                                class="dark:hover-bg-gray-800 inline-flex items-center rounded-lg p-1.5 text-center text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-100"
                                                type="button"
                                            >
                                                <svg
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                    fill="currentColor"
                                                    viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
                                                    />
                                                </svg>
                                            </button>
                                            <div
                                                id="dropdown-{{ $konsultasi->id }}"
                                                class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
                                            >
                                                <ul
                                                    class="py-1 text-sm"
                                                    aria-labelledby="dropdown-button-{{ $konsultasi->id }}"
                                                >
                                                    <li>
                                                        <button
                                                            type="button"
                                                            data-modal-target="updateDataModal-{{ $konsultasi->id }}"
                                                            data-modal-toggle="updateDataModal-{{ $konsultasi->id }}"
                                                            class="flex w-full items-center px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                                                        >
                                                            <svg
                                                                class="mr-2 h-4 w-4"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewbox="0 0 20 20"
                                                                fill="currentColor"
                                                                aria-hidden="true"
                                                            >
                                                                <path
                                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                                                />
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                />
                                                            </svg>
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button
                                                            type="button"
                                                            data-modal-target="readDataModal-{{ $konsultasi->id }}"
                                                            data-modal-toggle="readDataModal-{{ $konsultasi->id }}"
                                                            class="flex w-full items-center px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                                                        >
                                                            <svg
                                                                class="mr-2 h-4 w-4"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewbox="0 0 20 20"
                                                                fill="currentColor"
                                                                aria-hidden="true"
                                                            >
                                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    clip-rule="evenodd"
                                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                                />
                                                            </svg>
                                                            View
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Update modal -->
                                    <div
                                        id="updateDataModal-{{ $konsultasi->id }}"
                                        tabindex="-1"
                                        aria-hidden="true"
                                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
                                    >
                                        <div class="relative max-h-full w-full max-w-2xl p-4">
                                            <!-- Modal content -->
                                            <div
                                                class="relative rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5"
                                            >
                                                <!-- Modal header -->
                                                <div
                                                    class="mb-4 flex items-center justify-between rounded-t border-b pb-4 dark:border-gray-600 sm:mb-5"
                                                >
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Update Data
                                                    </h3>
                                                    <button
                                                        type="button"
                                                        class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="updateDataModal-{{ $konsultasi->id }}"
                                                    >
                                                        <svg
                                                            aria-hidden="true"
                                                            class="h-5 w-5"
                                                            fill="currentColor"
                                                            viewbox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                                fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"
                                                            />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form
                                                    action="{{ route('dokter.addMedication', ['id' => $konsultasi->id]) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    <div class="mb-4 grid gap-4 sm:grid-cols-2">
                                                        <div>
                                                            <label
                                                                for="name"
                                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                                            >
                                                                Name
                                                            </label>
                                                            <input
                                                                type="text"
                                                                name="name"
                                                                id="name"
                                                                value="{{ $konsultasi->pasien->nama }}"
                                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                                                disabled
                                                            />
                                                        </div>
                                                        <div>
                                                            <label
                                                                for="keluhan"
                                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                                            >
                                                                Keluhan
                                                            </label>
                                                            <input
                                                                type="text"
                                                                name="keluhan"
                                                                id="keluhan"
                                                                value="{{ $konsultasi->keluhan }}"
                                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                                                disabled
                                                            />
                                                        </div>
                                                        <div class="sm:col-span-2">
                                                            <label
                                                                for="penanganan"
                                                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                                            >
                                                                Penanganan
                                                            </label>
                                                            <textarea
                                                                id="penanganan"
                                                                name="penanganan"
                                                                rows="5"
                                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                                                placeholder="Write penanganan here..."
                                                            >
{{ $konsultasi->penanganan }}</textarea
                                                            >
                                                        </div>
                                                    </div>
                                                    <button
                                                        type="submit"
                                                        class="rounded-lg bg-primary-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                                    >
                                                        Save Changes
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Read modal -->
                                    <div
                                        id="readDataModal-{{ $konsultasi->id }}"
                                        tabindex="-1"
                                        aria-hidden="true"
                                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
                                    >
                                        <div class="relative max-h-full w-full max-w-xl p-4">
                                            <!-- Modal content -->
                                            <div
                                                class="relative rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5"
                                            >
                                                <!-- Modal header -->
                                                <div class="mb-4 flex justify-between rounded-t sm:mb-5">
                                                    <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                                                        <h3 class="font-semibold">{{ $konsultasi->pasien->nama }}</h3>
                                                        <p class="font-bold">
                                                            {{ $konsultasi->created_at->format('M d, Y') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <button
                                                            type="button"
                                                            class="inline-flex rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-toggle="readDataModal-{{ $konsultasi->id }}"
                                                        >
                                                            <svg
                                                                aria-hidden="true"
                                                                class="h-5 w-5"
                                                                fill="currentColor"
                                                                viewbox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"
                                                                />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <dl>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                                    >
                                                        Keluhan
                                                    </dt>
                                                    <dd
                                                        class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5"
                                                    >
                                                        {{ $konsultasi->keluhan }}
                                                    </dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                                    >
                                                        Penanganan
                                                    </dt>
                                                    <dd
                                                        class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5"
                                                    >
                                                        {{ $konsultasi->penanganan ?? '-' }}
                                                    </dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                                    >
                                                        Status
                                                    </dt>
                                                    <dd
                                                        class="mb-4 font-light text-gray-500 dark:text-gray-400 sm:mb-5"
                                                    >
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
                        <nav class="items-center justify-between p-4">
                            {{ $konsultasis->links('vendor.pagination.flowbite') }}
                        </nav>
                    </div>
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
