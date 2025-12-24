<div class="p-6 bg-white border-b border-gray-200" wire:poll.5s>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Classificació en Temps Real</h2>
        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded animate-pulse">
            Actualitzant en viu
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Pos</th>
                    <th class="py-3 px-4 text-left">Equip</th>
                    <th class="py-3 px-4 text-center font-bold">Punts</th>
                    <th class="py-3 px-4 text-center">PJ</th>
                    <th class="py-3 px-4 text-center">PG</th>
                    <th class="py-3 px-4 text-center">PE</th>
                    <th class="py-3 px-4 text-center">PP</th>
                    <th class="py-3 px-4 text-center">GF</th>
                    <th class="py-3 px-4 text-center">GC</th>
                    <th class="py-3 px-4 text-center">DG</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($equips as $index => $equip)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-3 px-4 font-semibold text-gray-600">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-3 px-4 font-medium text-gray-900 flex items-center">
                            @if($equip->escut)
                                <img src="{{ Storage::url($equip->escut) }}" class="w-8 h-8 mr-2 object-cover rounded-full">
                            @endif
                            {{ $equip->nom }}
                        </td>
                        <td class="py-3 px-4 text-center font-bold text-blue-600 text-lg">
                            {{ $equip->stats['punts'] }}
                        </td>
                        <td class="py-3 px-4 text-center text-gray-600">{{ $equip->stats['pj'] }}</td>
                        <td class="py-3 px-4 text-center text-green-600">{{ $equip->stats['pg'] }}</td>
                        <td class="py-3 px-4 text-center text-yellow-600">{{ $equip->stats['pe'] }}</td>
                        <td class="py-3 px-4 text-center text-red-600">{{ $equip->stats['pp'] }}</td>
                        <td class="py-3 px-4 text-center text-gray-600">{{ $equip->stats['gf'] }}</td>
                        <td class="py-3 px-4 text-center text-gray-600">{{ $equip->stats['gc'] }}</td>
                        <td class="py-3 px-4 text-center font-semibold {{ $equip->stats['dg'] > 0 ? 'text-green-500' : ($equip->stats['dg'] < 0 ? 'text-red-500' : 'text-gray-500') }}">
                            {{ $equip->stats['dg'] > 0 ? '+' : '' }}{{ $equip->stats['dg'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>