<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Pasien Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto space-y-6 p-6">
        <!-- Pasien Information Card -->
        <a href="#"
            class="block max-w-full rounded-lg border border-gray-200 bg-white p-6 shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Welcome, {{ $pasien->nama }}
            </h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Email: {{ $pasien->email }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Phone: {{ $pasien->nomor_telepon }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Address: {{ $pasien->alamat }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Blood Type: {{ $pasien->golongan_darah }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Date of Birth: {{ $pasien->tanggal_lahir }}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">Gender: {{ $pasien->jenis_kelamin }}</p>
        </a>

        <!-- Konsultasi Form -->
        <div class="block w-full max-w-full rounded-lg border border-gray-200 bg-white p-6 shadow">
            <h2 class="mb-4 text-lg font-semibold">Create a new Konsultasi</h2>
            <form action="{{ route('konsultasi.store') }}" method="POST">
                @csrf
                <div class="mb-6 grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="tanggal_keluhan"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            Date of Symptoms
                        </label>
                        <input type="date" name="tanggal_keluhan" id="tanggal_keluhan" required
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
                    </div>
                    <div>
                        <label for="dokter_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            Pick a Doctor
                        </label>
                        <select name="dokter_id" id="dokter_id" required
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}">
                                    {{ $dokter->nama }} - {{ $dokter->keahlian }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="keluhan" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Symptoms
                    </label>
                    <textarea name="keluhan" id="keluhan" rows="3" required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"></textarea>
                </div>
                <input type="hidden" name="status" value="pending" />
                <div class="mb-6">
                    <button type="submit"
                        class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <!-- Konsultasi History -->
        <div class="block w-full max-w-full rounded-lg border border-gray-200 bg-white p-6 shadow">
            <h2 class="mb-4 text-lg font-semibold">Your Konsultasi History</h2>
            @if ($konsultasis->isEmpty())
                <p>No consultations yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">Symptoms</th>
                                <th scope="col" class="px-4 py-4">Doctor</th>
                                <th scope="col" class="px-4 py-4">Status</th>
                                <th scope="col" class="px-4 py-4">Date</th>
                                <th scope="col" class="px-4 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasis as $konsultasi)
                                <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                    <td class="px-4 py-4">{{ $konsultasi->keluhan }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->dokter->nama }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->status }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->tanggal_keluhan }}</td>
                                    <td class="px-4 py-4">
                                        <button type="submit" id="deleteButton" data-modal-target="deleteModal-{{ $konsultasi->id }}" data-modal-toggle="deleteModal-{{ $konsultasi->id }}"
                                            class="rounded-md bg-red-500 px-2 py-1 text-white hover:bg-red-700">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <!-- Main modal -->
                                <div id="deleteModal-{{ $konsultasi->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div
                                            class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <button type="button"
                                                class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="deleteModal-{{ $konsultasi->id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"
                                                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to
                                                delete this item?</p>
                                            <div class="flex justify-center items-center space-x-4">
                                                <button data-modal-toggle="deleteModal-{{ $konsultasi->id }}" type="button"
                                                    class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    No, cancel
                                                </button>
                                                <form action="{{ route('konsultasi.destroy', $konsultasi->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        Yes, I'm sure
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
