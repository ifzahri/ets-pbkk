<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Pasien Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 space-y-6">

        <!-- Pasien Information Card -->
        <a href="#"
            class="block w-full max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
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
        <div class="block w-full max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Create a new Konsultasi</h2>
            <form action="{{ route('konsultasi.store') }}" method="POST">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="tanggal_keluhan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Symptoms</label>
                        <input type="date" name="tanggal_keluhan" id="tanggal_keluhan" required 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <label for="dokter_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pick a Doctor</label>
                        <select name="dokter_id" id="dokter_id" required 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama }} - {{ $dokter->keahlian }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="keluhan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Symptoms</label>
                    <textarea name="keluhan" id="keluhan" rows="3" required 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <input type="hidden" name="status" value="pending">
                <div class="mb-6">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>
        
        
        <!-- Konsultasi History -->
        <div class="block w-full max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Your Konsultasi History</h2>
            @if ($konsultasis->isEmpty())
                <p>No consultations yet.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4">Symptoms</th>
                                <th scope="col" class="px-4 py-4">Status</th>
                                <th scope="col" class="px-4 py-4">Date</th>
                                <th scope="col" class="px-4 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasis as $konsultasi)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-4 py-4">{{ $konsultasi->keluhan }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->status }}</td>
                                    <td class="px-4 py-4">{{ $konsultasi->tanggal_keluhan }}</td>
                                    <td class="px-4 py-4">
                                        <form action="{{ route('konsultasi.destroy', $konsultasi->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
