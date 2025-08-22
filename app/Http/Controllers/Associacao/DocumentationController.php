<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documentation;
use App\Models\User;
use App\Models\DocumentType; // Importe a nova model
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $submittedDocs = $user->documentations()->with('documentType')->get()->keyBy('document_type_id');
        $requiredTypes = DocumentType::where('association_id', $user->association_id)
                                     ->where('is_active', true)
                                     ->get();
        return view('associacao.documentos.index', compact('submittedDocs', 'requiredTypes'));
    }
    
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'document_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        
        $file = $request->file('document_file');
        $path = $file->store('public/documentos/' . $user->id);

        $user->documentations()->create([
            'document_type_id' => $request->document_type_id,
            'file_path' => $path,
            'status' => 'pending',
        ]);
        
        $user->status = 'docs_under_review';
        $user->save();
        
        return redirect()->route('associacao.documentos.index')->with('success', 'Documento enviado com sucesso! Aguarde a aprovação.');
    }

     public function showDocs(User $user)
    {
        if ($user->association_id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }

        // CORREÇÃO: Busca os documentos enviados, ordena pelo mais recente e os agrupa
        // Isso garante que apenas o último documento de cada tipo seja exibido
        $submittedDocs = $user->documentations()
                              ->latest()
                              ->with('documentType')
                              ->get()
                              ->unique('document_type_id')
                              ->keyBy('document_type_id');
        
        $documentTypes = DocumentType::where('association_id', $user->association_id)
                                     ->where('is_active', true)
                                     ->get();

        return view('associacao.documentos.show', compact('user', 'submittedDocs', 'documentTypes'));
    }

    /**
     * Aprova um tipo de documento para um usuário.
     * Pode ser chamado mesmo se o documento não foi enviado.
     */
    public function approve(Request $request, Documentation $documentation)
    {
        if ($documentation->user->association_id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }

        $documentation->status = 'approved';
        $documentation->rejection_reason = null;
        $documentation->save();

        $this->checkUserDocumentStatus($documentation->user);

        return redirect()->back()->with('success', "O documento '{$documentation->documentType->name}' foi aprovado.");
    }

    /**
     * Reprova um tipo de documento para um usuário.
     */
    public function reject(Request $request, Documentation $documentation)
    {
        if ($documentation->user->association_id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }

        $request->validate(['rejection_reason' => 'required|string']);

        $documentation->status = 'rejected';
        $documentation->rejection_reason = $request->rejection_reason;
        $documentation->save();
        
        $this->checkUserDocumentStatus($documentation->user);

        return redirect()->back()->with('success', "O documento '{$documentation->documentType->name}' foi reprovado.");
    }

    public function review()
    {
        $documentations = Documentation::with('user', 'documentType') // Inclui o tipo de documento
                                       ->where('status', 'pending') // Filtra apenas os pendentes de revisão
                                       ->whereHas('user', function ($query) {
                                           $query->where('association_id', auth()->user()->association_id);
                                       })
                                       ->get();
        
        return view('associacao.documentos.review', compact('documentations'));
    }
    /**
     * Helper para verificar o status de todos os documentos obrigatórios do usuário.
     */
    private function checkUserDocumentStatus(User $user)
    {
        $requiredTypes = DocumentType::where('association_id', $user->association_id)
                                     ->where('is_required', true)
                                     ->get();
        
        $allRequiredDocsApproved = true;
        foreach ($requiredTypes as $type) {
            $doc = $user->documentations()->where('document_type_id', $type->id)->first();
            if (!$doc || $doc->status !== 'approved') {
                $allRequiredDocsApproved = false;
                break;
            }
        }

        if ($allRequiredDocsApproved) {
            $user->status = 'payment_pending';
        } else {
            $user->status = 'documentation_pending';
        }
        $user->save();
    }
    
    public function pendingDocs()
    {
        $associationId = auth()->user()->association_id;
        
        $users = User::where('association_id', $associationId)
                     ->whereIn('status', ['documentation_pending', 'docs_under_review', 'payment_pending']) // <-- CORRIGIDO AQUI
                     ->get();

        return view('associacao.documentos.pending_docs', compact('users'));
    }

    /**
     * Aprova o usuário, mudando o status para a próxima etapa.
     */
    public function approveUser(Request $request, User $user)
    {
        if ($user->association_id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }
        
        // Verifica se todos os documentos obrigatórios estão aprovados
        $requiredTypes = DocumentType::where('association_id', $user->association_id)
                                     ->where('is_required', true)
                                     ->get();
        
        $allRequiredDocsApproved = true;
        if ($requiredTypes->count() > 0) {
            foreach ($requiredTypes as $type) {
                $doc = $user->documentations()->where('document_type_id', $type->id)->first();
                if (!$doc || $doc->status !== 'approved') {
                    $allRequiredDocsApproved = false;
                    break;
                }
            }
        }

        if ($allRequiredDocsApproved) {
            $user->status = 'payment_pending';
            $user->save();
            return redirect()->back()->with('success', 'Usuário aprovado! Ele agora pode realizar o pagamento.');
        }

        return redirect()->back()->with('error', 'Não foi possível aprovar. Nem todos os documentos obrigatórios foram aprovados.');
    }


    
}