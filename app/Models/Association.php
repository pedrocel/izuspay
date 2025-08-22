<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Association extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
        'slug',
        'documento',
        'email',
        'telefone',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'data_fundacao',
        'descricao',
        'site',
        'logo',
        'representante_nome',
        'representante_cpf',
        'representante_email',
        'representante_telefone',
        'status',
        'plano_id',
        'mensalidade',
        'data_vencimento',
        'numero_membros',
        'configuracoes',
        'observacoes',
    ];

    protected $casts = [
        'data_fundacao' => 'date',
        'data_vencimento' => 'date',
        'mensalidade' => 'decimal:2',
        'configuracoes' => 'array',
    ];

    // ==================== RELACIONAMENTOS ====================

    /**
     * Usuários da associação
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Usuário responsável (dono da associação)
     */
    public function responsavel()
    {
        return $this->hasOne(User::class)->where('tipo', 'cliente');
    }

    /**
     * Membros da associação
     */
    public function membros()
    {
        return $this->hasMany(User::class)->where('tipo', 'membro');
    }

    // ==================== ACCESSORS ====================

    /**
     * Formatar documento (CPF/CNPJ)
     */
    public function getDocumentoFormatadoAttribute(): string
    {
        if (!$this->documento) return '';
        
        if (strlen($this->documento) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->documento);
        } elseif (strlen($this->documento) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $this->documento);
        }
        
        return $this->documento;
    }

    /**
     * Formatar telefone
     */
    public function getTelefoneFormatadoAttribute(): string
    {
        if (!$this->telefone) return '';
        
        $telefone = preg_replace('/\D/', '', $this->telefone);
        
        if (strlen($telefone) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
        } elseif (strlen($telefone) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
        }
        
        return $this->telefone;
    }

    /**
     * Formatar CEP
     */
    public function getCepFormatadoAttribute(): string
    {
        if (!$this->cep) return '';
        
        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $this->cep);
    }

    /**
     * Endereço completo
     */
    public function getEnderecoCompletoAttribute(): string
    {
        $endereco = $this->endereco . ', ' . $this->numero;
        
        if ($this->complemento) {
            $endereco .= ' - ' . $this->complemento;
        }
        
        $endereco .= ' - ' . $this->bairro . ', ' . $this->cidade . '/' . $this->estado;
        $endereco .= ' - CEP: ' . $this->cep_formatado;
        
        return $endereco;
    }

    // ==================== SCOPES ====================

    /**
     * Associações ativas
     */
    public function scopeAtivas($query)
    {
        return $query->where('status', 'ativa');
    }

    /**
     * Associações pendentes
     */
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    /**
     * Associações inativas
     */
    public function scopeInativas($query)
    {
        return $query->where('status', 'inativa');
    }

    /**
     * Filtrar por tipo
     */
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    /**
     * Buscar por nome ou documento
     */
    public function scopeBuscar($query, $termo)
    {
        return $query->where(function ($q) use ($termo) {
            $q->where('nome', 'like', "%{$termo}%")
              ->orWhere('documento', 'like', "%{$termo}%")
              ->orWhere('email', 'like', "%{$termo}%");
        });
    }

    // ==================== MÉTODOS ====================

    /**
     * Verificar se é pessoa física
     */
    public function isPessoaFisica(): bool
    {
        return $this->tipo === 'pf';
    }

    /**
     * Verificar se é pessoa jurídica
     */
    public function isPessoaJuridica(): bool
    {
        return $this->tipo === 'cnpj';
    }

    /**
     * Verificar se está ativa
     */
    public function isAtiva(): bool
    {
        return $this->status === 'ativa';
    }

    /**
     * Verificar se está pendente
     */
    public function isPendente(): bool
    {
        return $this->status === 'pendente';
    }

    /**
     * Ativar associação
     */
    public function ativar(): bool
    {
        return $this->update(['status' => 'ativa']);
    }

    /**
     * Inativar associação
     */
    public function inativar(): bool
    {
        return $this->update(['status' => 'inativa']);
    }

    /**
     * Obter cor do status
     */
    public function getCorStatus(): string
    {
        return match($this->status) {
            'ativa' => 'success',
            'inativa' => 'danger',
            'pendente' => 'warning',
            'suspensa' => 'secondary',
            default => 'secondary'
        };
    }

    /**
     * Obter badge do status
     */
    public function getBadgeStatus(): string
    {
        return match($this->status) {
            'ativa' => '<span class="badge bg-success">Ativa</span>',
            'inativa' => '<span class="badge bg-danger">Inativa</span>',
            'pendente' => '<span class="badge bg-warning">Pendente</span>',
            'suspensa' => '<span class="badge bg-secondary">Suspensa</span>',
            default => '<span class="badge bg-secondary">Indefinido</span>'
        };
    }

    /**
     * Obter badge do tipo
     */
    public function getBadgeTipo(): string
    {
        return match($this->tipo) {
            'pf' => '<span class="badge bg-info">Pessoa Física</span>',
            'cnpj' => '<span class="badge bg-primary">Pessoa Jurídica</span>',
            default => '<span class="badge bg-secondary">Indefinido</span>'
        };
    }

    // Relacionamento com os planos
    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
    
    // Relacionamento com os produtos
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($association) {
            $association->slug = Str::slug($association->nome);

            // Garante que o slug seja único
            $originalSlug = $association->slug;
            $counter = 1;
            while (static::where('slug', $association->slug)->exists()) {
                $association->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });

        static::updating(function ($association) {
            // Se o nome foi alterado e o slug não foi manualmente editado, gera um novo slug
            if ($association->isDirty('nome') && !$association->isDirty('slug')) {
                $association->slug = Str::slug($association->nome);

                // Garante que o slug seja único
                $originalSlug = $association->slug;
                $counter = 1;
                while (static::where('slug', $association->slug)->where('id', '!=', $association->id)->exists()) {
                    $association->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }
}
