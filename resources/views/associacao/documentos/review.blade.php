@extends('layouts.app')

@section('title', 'Revisão de Documentos')
@section('page-title', 'Documentos para Aprovação')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-blue-100 dark:border-gray-600">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                <i data-lucide="file-check-2" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Documentos para Aprovação</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Aprovar ou reprovar documentos pendentes dos associados.
                </p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-md">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Usuário
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Tipo de Documento
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($documentations as $doc)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $doc->user->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $doc->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $doc->documentType->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($doc->status === 'pending')
                                <span class="px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Pendente</span>
                            @elseif($doc->status === 'approved')
                                <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Aprovado</span>
                            @elseif($doc->status === 'rejected')
                                <span class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full" title="Motivo: {{ $doc->rejection_reason }}">Reprovado</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                @if($doc->file_path)
                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="Ver Arquivo">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>
                                @endif

                                @if($doc->status === 'pending')
                                    <form action="{{ route('associacao.documentos.approve', ['user' => $doc->user->id, 'documentType' => $doc->documentType->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Aprovar este documento?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="Aprovar">
                                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                    <button type="button" onclick="showRejectModal('{{ $doc->user->id }}', '{{ $doc->documentType->id }}')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Reprovar">
                                        <i data-lucide="x-circle" class="w-5 h-5"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            Nenhum documento pendente de revisão.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="reject-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    </div>

@endsection

@push('scripts')
<script>
    function showRejectModal(userId, documentTypeId) {
        const modal = document.getElementById('reject-modal');
        const form = document.getElementById('reject-form');
        form.action = `{{ route('associacao.documentos.reject', ['user' => '__user_id__', 'documentType' => '__doc_type_id__']) }}`
            .replace('__user_id__', userId)
            .replace('__doc_type_id__', documentTypeId);
        modal.classList.remove('hidden');
    }
    
    function closeRejectModal() {
        const modal = document.getElementById('reject-modal');
        modal.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush