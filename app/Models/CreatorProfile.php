<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'display_name',
        'bio',
        'profile_image',
        'cover_image',
        'is_verified',
        'followers_count',
        'following_count',
        'posts_count',
        'category',
        'website',
        'location',
        'is_active'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'followers_count' => 'integer',
        'following_count' => 'integer',
        'posts_count' => 'integer'
    ];

    /**
     * Relacionamento com o usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com as notícias/posts do criador
     */
    public function news()
    {
        return $this->hasMany(News::class, 'creator_profile_id');
    }

     public function association()
    {
        return $this->hasOneThrough(Association::class, User::class, 'id', 'id', 'user_id', 'association_id');
    }
    
    /**
     * Relacionamento com os seguidores
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'creator_followers', 'creator_profile_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Relacionamento com quem o criador segue
     */
    public function following()
    {
        return $this->belongsToMany(CreatorProfile::class, 'creator_follows', 'follower_id', 'following_id')
                    ->withTimestamps();
    }

    /**
     * Verifica se um usuário segue este criador
     */
    public function isFollowedBy($userId)
    {
        return $this->followers()->where('user_id', $userId)->exists();
    }

    public function posts()
{
    return $this->hasMany(News::class, 'creator_profile_id');
}

    /**
     * Scope para buscar criadores ativos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para buscar por nome ou username
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('display_name', 'LIKE', "%{$term}%")
              ->orWhere('username', 'LIKE', "%{$term}%")
              ->orWhere('bio', 'LIKE', "%{$term}%");
        });
    }

    /**
     * Accessor para URL da imagem de perfil
     */
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        
        // Retorna uma imagem padrão baseada nas iniciais
        return "https://ui-avatars.com/api/?name=" . urlencode($this->display_name) . "&background=22c55e&color=fff&size=200";
    }

    /**
     * Accessor para URL da imagem de capa
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        
        return null;
    }
}
