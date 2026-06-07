<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Learning Materials</h2>
            <a href="{{ route('manager.materials.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">
                + Upload Material
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($materials->isEmpty())
                    <div class="px-6 py-12 text-center text-gray-400">No materials uploaded yet.</div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploaded By</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($materials as $material)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $material->title }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $material->uploader->name ?? '—' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                        {{ $material->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-3">
                                        <a href="{{ route('manager.materials.download', $material) }}"
                                           class="text-indigo-600 hover:underline">Download</a>
                                        <form method="POST" action="{{ route('manager.materials.destroy', $material) }}" class="inline"
                                              onsubmit="return confirm('Delete this material?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-6 py-3">{{ $materials->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
