<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Http\Requests\AssociationRequest;
use App\Models\CreatorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str; // <-- Importe a classe Str

class ConfiguracoesController extends Controller
{
    /**
     * Exibe o formulário de configurações da associação.
     */
    public function edit()
    {
        $user = Auth::user();

        $apiKey = $user->api_token;
        $association = $user->association;
        $creatorProfile = $user->creatorProfile;

        if (!$association) {
            return redirect()->route('dashboard')->with('error', 'Associação não encontrada.');
        }

        return view('associacao.configuracoes.edit', compact('association', 'creatorProfile', 'user', 'apiKey'));
    }

    /**
     * Atualiza as configurações da associação.
     */
    public function update(Request $request, Association $association){
        $user = Auth::user();
        $association = $user->association;
        $creatorProfile = $user->creatorProfile;

        // Validation rules
        $rules = [
            // User fields
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            
            // Creator Profile fields
            'username' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique('creator_profiles')->ignore($creatorProfile?->id)],
            'display_name' => 'required|string|max:100',
            'category' => 'required|string|in:gaming,lifestyle,tech,fitness,food,travel,education,entertainment',
            'bio' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            
            // Association fields
            'association_name' => 'required|string|max:255',
            'tipo' => 'required|in:pf,cnpj',
            'documento' => 'required|string|max:20',
            'association_description' => 'nullable|string|max:1000',
            'association_phone' => 'nullable|string|max:20',
            'association_website' => 'nullable|url',
        ];

        // Add password validation if changing password
        if ($request->filled('password')) {
            $rules['current_password'] = 'required|string';
        }

        $validatedData = $request->validate($rules);

        // Verify current password if changing password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
            }
        }

        try {
            // Update User
            $userData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ];
            
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($validatedData['password']);
            }
            
            $user->update($userData);

            // Update Association
            $association->update([
                'nome' => $validatedData['association_name'],
                'tipo' => $validatedData['tipo'],
                'documento' => $validatedData['documento'],
                'descricao' => $validatedData['association_description'],
                'telefone' => $validatedData['association_phone'],
                'site' => $validatedData['association_website'],
            ]);

            // Handle avatar upload
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($creatorProfile && $creatorProfile->avatar) {
                    Storage::delete($creatorProfile->avatar);
                }
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }

            // Handle profile_image and cover_image uploads
            $profileImagePath = null;
            $coverImagePath = null;
            
            if ($request->hasFile('profile_image')) {
                // Delete old profile image if exists
                if ($creatorProfile && $creatorProfile->profile_image) {
                    Storage::delete($creatorProfile->profile_image);
                }
                $profileImagePath = $request->file('profile_image')->store('profile-images', 'public');
            }

            if ($request->hasFile('cover_image')) {
                // Delete old cover image if exists
                if ($creatorProfile && $creatorProfile->cover_image) {
                    Storage::delete($creatorProfile->cover_image);
                }
                $coverImagePath = $request->file('cover_image')->store('cover-images', 'public');
            }

            // Update or Create Creator Profile
            $creatorData = [
                'username' => $validatedData['username'],
                'display_name' => $validatedData['display_name'],
                'category' => $validatedData['category'],
                'bio' => $validatedData['bio'],
                'instagram_url' => $validatedData['instagram_url'],
                'youtube_url' => $validatedData['youtube_url'],
                'tiktok_url' => $validatedData['tiktok_url'],
                'twitter_url' => $validatedData['twitter_url'],
                'is_active' => true,
            ];

            if ($profileImagePath) {
                $creatorData['profile_image'] = $profileImagePath;
            }
            
            if ($coverImagePath) {
                $creatorData['cover_image'] = $coverImagePath;
            }

            if ($creatorProfile) {
                $creatorProfile->update($creatorData);
            } else {
                $creatorData['user_id'] = $user->id;
                $creatorData['association_id'] = $association->id;
                CreatorProfile::create($creatorData);
            }

            return redirect()->route('associacao.configuracoes.edit')->with('success', 'Configurações atualizadas com sucesso!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao atualizar configurações: ' . $e->getMessage()]);
        }
    }

     public function regenerateApiToken()
    {
        $user = Auth::user();
        
        // Gera um novo token aleatório e seguro
        $newToken = Str::random(60);

        // Atualiza o usuário com o novo token
        $user->forceFill([
            'api_token' => hash('sha256', $newToken),
        ])->save();

        // Redireciona de volta com o novo token visível (apenas desta vez)
        // e uma mensagem de sucesso.
        return redirect()->route('associacao.configuracoes.edit')
                         ->with('success', 'Nova chave de API gerada com sucesso!')
                         ->with('newApiKey', $newToken);
    }
}