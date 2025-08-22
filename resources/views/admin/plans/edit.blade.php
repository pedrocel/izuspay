<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <i class="fas fa-clipboard-list mr-2"></i> Editar Plano
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">Nome</label>
                <input type="text" name="name" id="name" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('name', $plan->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 dark:text-gray-300 font-medium">Descrição</label>
                <textarea name="description" id="description" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" required>{{ old('description', $plan->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="link_image" class="block text-gray-700 dark:text-gray-300 font-medium">Link da Imagem</label>
                <input type="url" name="link_image" id="link_image" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('link_image', $plan->link_image) }}">
                @error('link_image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_plan_external" class="block text-gray-700 dark:text-gray-300 font-medium">ID Plano Externo</label>
                <input type="text" name="id_plan_external" id="id_plan_external" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('id_plan_external', $plan->id_plan_external) }}">
            </div>

            <div class="mb-4">
                <label for="id_offer_external" class="block text-gray-700 dark:text-gray-300 font-medium">ID Oferta Externa</label>
                <input type="text" name="id_offer_external" id="id_offer_external" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('id_offer_external', $plan->id_offer_external) }}">
            </div>

            <div class="mb-4">
                <label for="link_checkout_external" class="block text-gray-700 dark:text-gray-300 font-medium">Link de Checkout Externo</label>
                <input type="url" name="link_checkout_external" id="link_checkout_external" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('link_checkout_external', $plan->link_checkout_external) }}">
            </div>

            <div class="mb-4">
                <label for="value" class="block text-gray-700 dark:text-gray-300 font-medium">Valor</label>
                <input type="text" name="value" id="value" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('value', $plan->value) }}" required oninput="this.value = this.value.replace(/[^0-9,.]/g, '')">
                @error('value')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="page_quantity" class="block text-gray-700 dark:text-gray-300 font-medium">Quantidade de Páginas</label>
                <input type="number" name="page_quantity" id="page_quantity" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500" value="{{ old('page_quantity', $plan->page_quantity) }}" required>
            </div>

            <div class="mb-4">
                <label for="billing_cycle" class="block text-gray-700 dark:text-gray-300 font-medium">Ciclo de Cobrança</label>
                <select name="billing_cycle" id="billing_cycle" class="border border-gray-300 dark:border-gray-700 rounded w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <option value="monthly" {{ old('billing_cycle', $plan->billing_cycle) == 'monthly' ? 'selected' : '' }}>Mensal</option>
                    <option value="quarterly" {{ old('billing_cycle', $plan->billing_cycle) == 'quarterly' ? 'selected' : '' }}>Trimestral</option>
                    <option value="semiannual" {{ old('billing_cycle', $plan->billing_cycle) == 'semiannual' ? 'selected' : '' }}>Semestral</option>
                    <option value="annual" {{ old('billing_cycle', $plan->billing_cycle) == 'annual' ? 'selected' : '' }}>Anual</option>
                    <option value="biennial" {{ old('billing_cycle', $plan->billing_cycle) == 'biennial' ? 'selected' : '' }}>Bienal</option>
                    <option value="quadrennial" {{ old('billing_cycle', $plan->billing_cycle) == 'quadrennial' ? 'selected' : '' }}>Quadrienal</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-medium">Status</label>
                <input type="checkbox" name="status" id="status" class="mr-2" value="1" {{ old('status', $plan->status) ? 'checked' : '' }}>
                <label for="status" class="text-gray-700 dark:text-gray-300">Ativo</label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Atualizar</button>
                <a href="{{ route('admin.plans.index') }}" class="ml-4 text-gray-600 dark:text-gray-400 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>