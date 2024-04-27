<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        @foreach ($columnas as $columna)
            <th scope="col" class="p-4">{{ $columna['name'] }}</th>
        @endforeach
        <th scope="col" class="p-4">Acciones</th> <!-- Columna para los botones de acción -->
    </tr>
    </thead>
    <tbody>
    @foreach ($items as $item)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            @foreach ($columnas as $columna)
                <td class="px-6 py-4">{{ isset($columna['selector']) ? $columna['selector']($item) : '' }}</td>
            @endforeach
            <td class="px-6 py-4">
                <!-- Botón de eliminar -->
                <form method="post" action="{{ route('user.destroy', $item->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                </form>
                <!-- Botón de editar -->
                <button x-data @click="editUser({{ $item->toJson() }})" class="ml-2 text-blue-600 hover:text-blue-900">Editar</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


