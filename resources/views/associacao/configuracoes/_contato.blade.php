<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
        <div class="flex items-center space-x-2">
            <i data-lucide="map-pin" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contato e Endereço</h3>
        </div>
    </div>
    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email', $association->email) }}" required
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('email') border-red-500 @enderror">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Telefone</label>
            <input type="tel" id="telefone" name="telefone" value="{{ old('telefone', $association->telefone) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('telefone') border-red-500 @enderror">
            @error('telefone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="md:col-span-2">
            <label for="site" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site</label>
            <input type="url" id="site" name="site" value="{{ old('site', $association->site) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('site') border-red-500 @enderror">
            @error('site') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="md:col-span-2">
            <label for="endereco" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Endereço</label>
            <input type="text" id="endereco" name="endereco" value="{{ old('endereco', $association->endereco) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('endereco') border-red-500 @enderror">
            @error('endereco') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Número</label>
            <input type="text" id="numero" name="numero" value="{{ old('numero', $association->numero) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('numero') border-red-500 @enderror">
            @error('numero') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="complemento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Complemento</label>
            <input type="text" id="complemento" name="complemento" value="{{ old('complemento', $association->complemento) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('complemento') border-red-500 @enderror">
            @error('complemento') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="bairro" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bairro</label>
            <input type="text" id="bairro" name="bairro" value="{{ old('bairro', $association->bairro) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('bairro') border-red-500 @enderror">
            @error('bairro') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="cidade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cidade</label>
            <input type="text" id="cidade" name="cidade" value="{{ old('cidade', $association->cidade) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('cidade') border-red-500 @enderror">
            @error('cidade') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Estado (UF)</label>
            <input type="text" id="estado" name="estado" value="{{ old('estado', $association->estado) }}" maxlength="2"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('estado') border-red-500 @enderror">
            @error('estado') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="cep" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">CEP</label>
            <input type="text" id="cep" name="cep" value="{{ old('cep', $association->cep) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('cep') border-red-500 @enderror">
            @error('cep') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
</div>