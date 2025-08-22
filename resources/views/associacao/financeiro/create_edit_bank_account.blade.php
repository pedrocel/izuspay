@extends('layouts.app')

@section('title', isset($bankAccount) ? 'Editar Conta Bancária' : 'Adicionar Conta Bancária')
@section('page-title', isset($bankAccount) ? 'Editar Conta Bancária' : 'Adicionar Conta Bancária')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="banknote" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ isset($bankAccount) ? 'Editar Conta' : 'Adicionar Conta' }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ isset($bankAccount) ? 'Atualize os dados da sua conta bancária.' : 'Preencha os dados da conta para receber saques.' }}
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.financeiro.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <form action="{{ isset($bankAccount) ? route('associacao.financeiro.bank-accounts.update', $bankAccount) : route('associacao.financeiro.bank-accounts.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($bankAccount))
            @method('PUT')
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="bank_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Banco *</label>
                    <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name', $bankAccount->bank_name ?? '') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('bank_name') border-red-500 @enderror">
                    @error('bank_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="agency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Agência *</label>
                    <input type="text" id="agency" name="agency" value="{{ old('agency', $bankAccount->agency ?? '') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('agency') border-red-500 @enderror">
                    @error('agency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Conta *</label>
                    <input type="text" id="account_number" name="account_number" value="{{ old('account_number', $bankAccount->account_number ?? '') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('account_number') border-red-500 @enderror">
                    @error('account_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="account_holder_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome do Titular *</label>
                    <input type="text" id="account_holder_name" name="account_holder_name" value="{{ old('account_holder_name', $bankAccount->account_holder_name ?? '') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('account_holder_name') border-red-500 @enderror">
                    @error('account_holder_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="account_holder_document" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Documento do Titular *</label>
                    <input type="text" id="account_holder_document" name="account_holder_document" value="{{ old('account_holder_document', $bankAccount->account_holder_document ?? '') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('account_holder_document') border-red-500 @enderror">
                    @error('account_holder_document') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pix_key_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Chave Pix</label>
                        <select id="pix_key_type" name="pix_key_type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('pix_key_type') border-red-500 @enderror">
                            <option value="">Nenhum</option>
                            <option value="cpf" {{ old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'cpf' ? 'selected' : '' }}>CPF</option>
                            <option value="cnpj" {{ old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'cnpj' ? 'selected' : '' }}>CNPJ</option>
                            <option value="email" {{ old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'email' ? 'selected' : '' }}>E-mail</option>
                            <option value="phone" {{ old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'phone' ? 'selected' : '' }}>Telefone</option>
                            <option value="aleatoria" {{ old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'aleatoria' ? 'selected' : '' }}>Aleatória</option>
                        </select>
                        @error('pix_key_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="pix_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Chave Pix</label>
                        <input type="text" id="pix_key" name="pix_key" value="{{ old('pix_key', $bankAccount->pix_key ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('pix_key') border-red-500 @enderror">
                        @error('pix_key') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="md:col-span-2 flex items-center">
                    <input type="checkbox" id="is_default" name="is_default" value="1" {{ old('is_default', $bankAccount->is_default ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="is_default" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Definir como padrão</label>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 flex justify-end gap-4">
            <a href="{{ route('associacao.financeiro.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Salvar Conta
            </button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush