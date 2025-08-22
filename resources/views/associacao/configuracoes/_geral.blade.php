<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
        <div class="flex items-center space-x-2">
            <i data-lucide="info" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informações Gerais</h3>
        </div>
    </div>
    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome da Associação *</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $association->nome) }}" required
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('nome') border-red-500 @enderror">
            @error('nome') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo *</label>
            <select id="tipo" name="tipo" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('tipo') border-red-500 @enderror">
                <option value="pf" {{ old('tipo', $association->tipo) == 'pf' ? 'selected' : '' }}>Pessoa Física</option>
                <option value="cnpj" {{ old('tipo', $association->tipo) == 'cnpj' ? 'selected' : '' }}>Pessoa Jurídica</option>
            </select>
            @error('tipo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="documento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Documento (CPF/CNPJ) *</label>
            <input type="text" id="documento" name="documento" value="{{ old('documento', $association->documento) }}" required
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('documento') border-red-500 @enderror">
            @error('documento') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="md:col-span-2">
            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descrição</label>
            <textarea id="descricao" name="descricao" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('descricao') border-red-500 @enderror">{{ old('descricao', $association->descricao) }}</textarea>
            @error('descricao') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo da Associação</label>
            <input type="file" id="logo" name="logo" accept="image/*" onchange="previewImage(this, 'logo-preview-img')"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('logo') border-red-500 @enderror">
            @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @if($association->logo)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Logo atual:</p>
                    <img id="logo-preview-img" src="{{ Storage::url($association->logo) }}" alt="Logo da Associação" class="mt-2 h-24 w-auto object-contain rounded-lg border border-gray-200 dark:border-gray-700">
                </div>
            @else
                <div id="logo-preview-container" class="mt-4 hidden">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Preview:</p>
                    <img id="logo-preview-img" src="#" alt="Preview da Logo" class="mt-2 h-24 w-auto object-contain rounded-lg border border-gray-200 dark:border-gray-700">
                </div>
            @endif
        </div>
        <div>
            <label for="data_fundacao" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Data de Fundação</label>
            <input type="date" id="data_fundacao" name="data_fundacao" value="{{ old('data_fundacao', $association->data_fundacao?->format('Y-m-d')) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('data_fundacao') border-red-500 @enderror">
            @error('data_fundacao') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
</div>