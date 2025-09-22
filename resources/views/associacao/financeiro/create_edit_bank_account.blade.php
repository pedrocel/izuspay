@extends('layouts.app')

@section('title', isset($bankAccount) ? 'Editar Conta Bancária' : 'Adicionar Conta Bancária')
@section('page-title', isset($bankAccount) ? 'Editar Conta Bancária' : 'Adicionar Conta Bancária')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    {{-- CABEÇALHO PRINCIPAL --}}
    <div class="relative rounded-2xl p-8 overflow-hidden bg-slate-900 border border-blue-500/20 shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-black to-black opacity-80"></div>
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4 mb-2">
                    <div class="w-16 h-16 bg-black/30 backdrop-blur-sm border border-white/10 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="landmark" class="w-8 h-8 text-blue-300"></i>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                        {{ isset($bankAccount) ? 'Editar Conta' : 'Adicionar Conta' }}
                    </h1>
                </div>
                <p class="text-blue-200/80 ml-20 sm:ml-0">
                    {{ isset($bankAccount) ? 'Atualize os dados da sua conta bancária.' : 'Preencha os dados para receber seus saques.' }}
                </p>
            </div>
            <div class="flex items-center gap-3 self-start sm:self-center">
                <a href="{{ route('associacao.financeiro.index') }}" class="inline-flex items-center space-x-2 bg-slate-700/50 hover:bg-slate-700 text-gray-300 hover:text-white px-5 py-2.5 rounded-xl font-semibold border border-white/10 transition-all">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Voltar</span>
                </a>
            </div>
        </div>
    </div>

    {{-- FORMULÁRIO --}}
    <form action="{{ isset($bankAccount) ? route('associacao.financeiro.bank-accounts.update', $bankAccount) : route('associacao.financeiro.bank-accounts.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($bankAccount))
            @method('PUT')
        @endif

        <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl p-6 space-y-6">
            
            <!-- Dados da Conta -->
            <div class="p-5 bg-slate-900/50 rounded-xl border border-white/10 space-y-4">
                <h4 class="text-lg font-semibold text-white flex items-center"><i data-lucide="banknote" class="w-5 h-5 mr-2 text-blue-400"></i>Dados da Conta</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="bank_name" class="block text-sm font-medium text-gray-300 mb-1">Banco *</label>
                        <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name', $bankAccount->bank_name ?? '') }}" required 
                               class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('bank_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="agency" class="block text-sm font-medium text-gray-300 mb-1">Agência *</label>
                        <input type="text" id="agency" name="agency" value="{{ old('agency', $bankAccount->agency ?? '') }}" required 
                               class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('agency') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="account_number" class="block text-sm font-medium text-gray-300 mb-1">Conta com dígito *</label>
                        <input type="text" id="account_number" name="account_number" value="{{ old('account_number', $bankAccount->account_number ?? '') }}" required 
                               class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('account_number') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Dados do Titular -->
            <div class="p-5 bg-slate-900/50 rounded-xl border border-white/10 space-y-4">
                <h4 class="text-lg font-semibold text-white flex items-center"><i data-lucide="user" class="w-5 h-5 mr-2 text-blue-400"></i>Dados do Titular</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="account_holder_name" class="block text-sm font-medium text-gray-300 mb-1">Nome Completo do Titular *</label>
                        <input type="text" id="account_holder_name" name="account_holder_name" value="{{ old('account_holder_name', $bankAccount->account_holder_name ?? '') }}" required 
                               class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('account_holder_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="account_holder_document" class="block text-sm font-medium text-gray-300 mb-1">CPF/CNPJ do Titular *</label>
                        <input type="text" id="account_holder_document" name="account_holder_document" value="{{ old('account_holder_document', $bankAccount->account_holder_document ?? '') }}" required 
                               class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('account_holder_document') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Chave PIX -->
            <div class="p-5 bg-slate-900/50 rounded-xl border border-white/10 space-y-4">
                <h4 class="text-lg font-semibold text-white flex items-center"><i data-lucide="key-round" class="w-5 h-5 mr-2 text-blue-400"></i>Chave PIX (Opcional)</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pix_key_type" class="block text-sm font-medium text-gray-300 mb-1">Tipo de Chave</label>
                        <select id="pix_key_type" name="pix_key_type" 
                                class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">Nenhum</option>
                            <option value="cpf" @selected(old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'cpf')>CPF</option>
                            <option value="cnpj" @selected(old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'cnpj')>CNPJ</option>
                            <option value="email" @selected(old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'email')>E-mail</option>
                            <option value="phone" @selected(old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'phone')>Telefone</option>
                            <option value="aleatoria" @selected(old('pix_key_type', $bankAccount->pix_key_type ?? '') == 'aleatoria')>Aleatória</option>
                        </select>
                        @error('pix_key_type') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="pix_key" class="block text-sm font-medium text-gray-300 mb-1">Chave</label>
                        <input type="text" id="pix_key" name="pix_key" value="{{ old('pix_key', $bankAccount->pix_key ?? '') }}" 
                               class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        @error('pix_key') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Opção Padrão -->
            <div class="flex items-center p-4">
                <input type="checkbox" id="is_default" name="is_default" value="1" {{ old('is_default', $bankAccount->is_default ?? false) ? 'checked' : '' }}
                       class="h-5 w-5 text-blue-500 bg-gray-700 border-gray-600 rounded focus:ring-blue-600 focus:ring-offset-gray-800">
                <label for="is_default" class="ml-3 block text-sm font-medium text-gray-300">Definir como conta bancária padrão para saques</label>
            </div>
        </div>

        <!-- Botões de Ação -->
        <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex justify-end gap-4">
            <a href="{{ route('associacao.financeiro.index') }}" class="px-8 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-colors font-semibold">
                Cancelar
            </a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-xl hover:from-blue-600 hover:to-cyan-700 transition-all font-semibold shadow-lg hover:shadow-blue-500/30">
                {{ isset($bankAccount) ? 'Salvar Alterações' : 'Adicionar Conta' }}
            </button>
        </div>
    </form>
</div>

{{-- A tag <style> foi removida, então não há mais @push('styles') --}}
@endsection
