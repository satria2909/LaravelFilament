<x-filament-panels::page>
    <div class="space-y-4">
        <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
            <thead>
                <tr class="bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">NIDN</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nama Dosen</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Mata Kuliah</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">SKS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->getData() as $dosen)
                    <tr class="bg-white text-gray-800 dark:bg-gray-800 dark:text-gray-200">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $dosen->nidn }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $dosen->nama }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                            {{ $dosen->makul?->nama_makul ?? '-' }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                            {{ $dosen->makul?->sks ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
