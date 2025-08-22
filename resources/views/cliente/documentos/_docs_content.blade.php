<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Gerenciamento de Documentos</h3>
    
    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @forelse($activeDocumentTypes as $type)
            @php
                $doc = $submittedDocs->get($type->id);
            @endphp
            <li class="py-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $type->name }}
                        @if($type->is_required)
                            <span class="ml-2 px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Obrigatório</span>
                        @endif
                    </p>
                    <div class="flex items-center mt-1 space-x-2">
                        @if($doc)
                            @if($doc->status === 'approved')
                                <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Aprovado</span>
                            @elseif($doc->status === 'rejected')
                                <span class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Reprovado</span>
                                <p class="text-xs text-red-500 dark:text-red-400">Motivo: {{ $doc->rejection_reason }}</p>
                            @else
                                <span class="px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Pendente de Revisão</span>
                            @endif
                        @else
                            <span class="px-2 py-1 text-xs font-medium text-gray-800 bg-gray-100 rounded-full">Pendente de Envio</span>
                        @endif
                    </div>
                </div>
                
                <div>
                    @if($doc && $doc->file_path)
                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mr-4" title="Ver Arquivo">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </a>
                    @endif
                    
                    @if(!$doc || $doc->status === 'rejected')
                        <form action="{{ route('cliente.documentos.store') }}" method="POST" enctype="multipart/form-data" class="inline-flex items-center space-x-2">
                            @csrf
                            <input type="hidden" name="document_type_id" value="{{ $type->id }}">
                            <input type="file" name="document_file" required
                                   class="text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                                Enviar
                            </button>
                        </form>
                    @endif
                </div>
            </li>
        @empty
            <li class="py-4 text-center text-gray-500 dark:text-gray-400">Nenhum documento ativo cadastrado pela associação.</li>
        @endforelse
    </ul>
</div>

<div class="mt-6 flex justify-end">
    <form action="{{ route('cliente.documentos.submit-for-review') }}" method="POST">
        @csrf
        @method('PATCH')
        @php
            $isAwaitingReview = auth()->user()->status === 'docs_under_review';
            $requiredCount = \App\Models\DocumentType::where('association_id', auth()->user()->association_id)->where('is_required', true)->count();
            $submittedCount = auth()->user()->documentations()->whereHas('documentType', function ($query) {
                                $query->where('is_required', true);
                            })->count();
            $allRequiredSubmitted = ($submittedCount >= $requiredCount) && ($requiredCount > 0);
        @endphp
        <button type="submit" 
                class="inline-flex items-center space-x-2 px-6 py-3 rounded-lg font-medium shadow-lg transition-all
                       {{ $isAwaitingReview ? 'bg-yellow-600 text-white disabled:opacity-75 disabled:cursor-not-allowed' : 
                          ($allRequiredSubmitted ? 'bg-blue-600 hover:bg-blue-700 text-white' : 
                           'bg-gray-400 text-white disabled:opacity-75 disabled:cursor-not-allowed') }}"
                {{ $isAwaitingReview || !$allRequiredSubmitted ? 'disabled' : '' }}
                title="{{ $isAwaitingReview ? 'Seus documentos estão em análise' : 
                         ($allRequiredSubmitted ? 'Clique para enviar para análise' : 
                          'Envie todos os documentos obrigatórios para habilitar') }}">
            <i data-lucide="{{ $isAwaitingReview ? 'clock' : 'file-check' }}" class="w-5 h-5"></i>
            <span>{{ $isAwaitingReview ? 'Aguardando Análise' : 'Enviar para Análise' }}</span>
        </button>
    </form>
</div>