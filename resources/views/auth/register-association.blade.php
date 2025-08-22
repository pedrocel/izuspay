<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Criador - Lux Secrets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lux-purple': '#621d62',
                        'lux-magenta': '#ff00ff',
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #621d62 0%, #000000 100%);
            min-height: 100vh;
        }
        .form-card { 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-primary { 
            background: linear-gradient(135deg, #621d62 0%, #ff00ff 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(98, 29, 98, 0.4);
        }
        .btn-primary:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(98, 29, 98, 0.6);
        }
        .tipo-card { 
            transition: all 0.3s ease; 
            cursor: pointer; 
            border: 2px solid #e5e7eb;
            background: rgba(255, 255, 255, 0.8);
        }
        .tipo-card:hover {
            border-color: #621d62;
            background: rgba(255, 255, 255, 0.9);
        }
        .tipo-card.selected { 
            border-color: #621d62; 
            background: linear-gradient(135deg, rgba(98, 29, 98, 0.1) 0%, rgba(255, 0, 255, 0.1) 100%);
            box-shadow: 0 0 0 3px rgba(98, 29, 98, 0.2);
        }
        .input-field { 
            display: block; 
            width: 100%; 
            border-radius: 0.5rem; 
            border: 2px solid #e5e7eb; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
            margin-top: 0.25rem; 
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }
        .input-field:focus { 
            border-color: #621d62; 
            box-shadow: 0 0 0 3px rgba(98, 29, 98, 0.2);
            outline: none;
            background: rgba(255, 255, 255, 1);
        }
        .logo-space {
            width: 250px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        .section-header {
            background: linear-gradient(135deg, #621d62 0%, #ff00ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-4xl">
        <div class="form-card rounded-2xl shadow-2xl p-8 lg:p-12">
            
            <!-- Adicionado header com logo e identidade visual do Lux Secrets -->
            <div class="text-center mb-10">
                <div class="logo-space">
                    <div class="w-36  justify-center">
                        <img class="text-white text-xl" src="https://i.ibb.co/0pNpWH61/image-removebg-preview-1.png">
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Crie seu Perfil de Criador</h3>
                <p class="text-gray-600">Cadastreseu perfil de criador em um só lugar.</p>
            </div>
            
            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-lg p-4">
                <p class="font-bold mb-1">Ops! Algo deu errado.</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form method="POST" action="{{ route('association.register') }}" id="registration-form" class="space-y-8">
                @csrf
                
                <!-- SEÇÃO 1: TIPO DE PERFIL -->
                <fieldset>
                    <!-- Aplicado gradiente nas legendas das seções -->
                    <legend class="text-lg font-semibold section-header mb-4">1. Tipo de Perfil</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="tipo-card rounded-lg p-4 flex items-center space-x-3 {{ old('tipo', 'pf') == 'pf' ? 'selected' : '' }}">
                            <input type="radio" name="tipo" value="pf" class="sr-only" {{ old('tipo', 'pf') == 'pf' ? 'checked' : '' }}>
                            <!-- Mudado cor dos ícones para lux-purple -->
                            <i class="fas fa-user text-lux-purple text-xl fa-fw"></i>
                            <span class="font-medium text-gray-800">Pessoa Física (CPF)</span>
                        </label>
                        <label class="tipo-card rounded-lg p-4 flex items-center space-x-3 {{ old('tipo') == 'cnpj' ? 'selected' : '' }}">
                            <input type="radio" name="tipo" value="cnpj" class="sr-only" {{ old('tipo') == 'cnpj' ? 'checked' : '' }}>
                            <i class="fas fa-building text-lux-purple text-xl fa-fw"></i>
                            <span class="font-medium text-gray-800">Pessoa Jurídica (CNPJ)</span>
                        </label>
                    </div>
                </fieldset>

                <!-- SEÇÃO 2: DADOS GERAIS -->
                <fieldset>
                    <legend class="text-lg font-semibold section-header mb-4">2. Dados Gerais</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo ou Marca *</label>
                            <input type="text" id="nome" name="nome" required class="input-field" value="{{ old('nome') }}">
                        </div>
                        <div>
                            <label for="documento" class="block text-sm font-medium text-gray-700" id="documento-label">CPF *</label>
                            <input type="text" id="documento" name="documento" required class="input-field" value="{{ old('documento') }}">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">E-mail Principal *</label>
                            <input type="email" id="email" name="email" required class="input-field" value="{{ old('email') }}">
                        </div>
                        <div>
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone / WhatsApp *</label>
                            <input type="tel" id="telefone" name="telefone" required class="input-field" value="{{ old('telefone') }}">
                        </div>
                    </div>
                </fieldset>

                <!-- SEÇÃO 3: PERFIL DE CRIADOR -->
                <fieldset>
                    <legend class="text-lg font-semibold section-header mb-4">3. Perfil de Criador</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Nome de Usuário *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">@</span>
                                <input type="text" id="username" name="username" required class="input-field pl-8" 
                                       value="{{ old('username') }}" placeholder="seuusername">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Apenas letras, números e underscore. Será seu identificador único.</p>
                        </div>
                        <div>
                            <label for="display_name" class="block text-sm font-medium text-gray-700">Nome de Exibição *</label>
                            <input type="text" id="display_name" name="display_name" required class="input-field" 
                                   value="{{ old('display_name') }}" placeholder="Como você quer aparecer">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Biografia</label>
                            <textarea id="bio" name="bio" rows="3" class="input-field resize-none" 
                                      placeholder="Conte um pouco sobre você e seu trabalho...">{{ old('bio') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Máximo 500 caracteres</p>
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Categoria *</label>
                            <select id="category" name="category" required class="input-field">
                                <option value="">Selecione uma categoria</option>
                                <option value="tecnologia" {{ old('category') == 'tecnologia' ? 'selected' : '' }}>Tecnologia</option>
                                <option value="educacao" {{ old('category') == 'educacao' ? 'selected' : '' }}>Educação</option>
                                <option value="entretenimento" {{ old('category') == 'entretenimento' ? 'selected' : '' }}>Entretenimento</option>
                                <option value="esportes" {{ old('category') == 'esportes' ? 'selected' : '' }}>Esportes</option>
                                <option value="lifestyle" {{ old('category') == 'lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                                <option value="negocios" {{ old('category') == 'negocios' ? 'selected' : '' }}>Negócios</option>
                                <option value="saude" {{ old('category') == 'saude' ? 'selected' : '' }}>Saúde</option>
                                <option value="arte" {{ old('category') == 'arte' ? 'selected' : '' }}>Arte e Design</option>
                                <option value="culinaria" {{ old('category') == 'culinaria' ? 'selected' : '' }}>Culinária</option>
                                <option value="viagem" {{ old('category') == 'viagem' ? 'selected' : '' }}>Viagem</option>
                                <option value="outros" {{ old('category') == 'outros' ? 'selected' : '' }}>Outros</option>
                            </select>
                        </div>
                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                            <input type="url" id="website" name="website" class="input-field" 
                                   value="{{ old('website') }}" placeholder="https://seusite.com">
                        </div>
                    </div>
                </fieldset>

                <!-- SEÇÃO 4: ENDEREÇO -->
                <fieldset>
                    <legend class="text-lg font-semibold section-header mb-4">4. Endereço</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="cep" class="block text-sm font-medium text-gray-700">CEP *</label>
                            <input type="text" id="cep" name="cep" required class="input-field" value="{{ old('cep') }}">
                        </div>
                        <div class="sm:col-span-2 grid grid-cols-3 gap-6">
                            <div class="col-span-2">
                                <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço *</label>
                                <input type="text" id="endereco" name="endereco" required class="input-field" value="{{ old('endereco') }}">
                            </div>
                            <div>
                                <label for="numero" class="block text-sm font-medium text-gray-700">Número *</label>
                                <input type="text" id="numero" name="numero" required class="input-field" value="{{ old('numero') }}">
                            </div>
                        </div>
                        <div>
                            <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro *</label>
                            <input type="text" id="bairro" name="bairro" required class="input-field" value="{{ old('bairro') }}">
                        </div>
                        <div>
                            <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade *</label>
                            <input type="text" id="cidade" name="cidade" required class="input-field" value="{{ old('cidade') }}">
                        </div>
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado *</label>
                            <input type="text" id="estado" name="estado" required class="input-field" value="{{ old('estado') }}">
                        </div>
                    </div>
                </fieldset>

                <!-- SEÇÃO 5: SENHA DE ACESSO -->
                <fieldset>
                    <legend class="text-lg font-semibold section-header mb-4">5. Senha de Acesso</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Senha *</label>
                            <input type="password" id="password" name="password" required class="input-field" placeholder="Mínimo 8 caracteres">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirme sua Senha *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required class="input-field">
                        </div>
                    </div>
                </fieldset>
                
                <!-- Melhorado botão de cadastro com gradiente e efeitos -->
                <div class="pt-6 text-center">
                    <button type="submit" class="w-full sm:w-auto btn-primary text-white font-bold py-4 px-12 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-crown mr-2"></i>
                        
                        Finalizar Cadastro
                    </button>
                    <p class="text-sm text-gray-500 mt-4">
                        Ao se cadastrar, você concorda com nossos 
                        <a href="#" class="text-lux-purple hover:text-lux-magenta transition-colors">Termos de Uso</a> e 
                        <a href="#" class="text-lux-purple hover:text-lux-magenta transition-colors">Política de Privacidade</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const radios = document.querySelectorAll('input[name="tipo"]');
            radios.forEach(radio => {
                radio.addEventListener('change', (e) => {
                    document.querySelectorAll('.tipo-card').forEach(c => c.classList.remove('selected'));
                    e.target.closest('.tipo-card').classList.add('selected');
                    updateDocumentField(e.target.value);
                });
            });
            
            const initialType = document.querySelector('input[name="tipo"]:checked')?.value || 'pf';
            updateDocumentField(initialType);

            applyMask(document.getElementById('telefone'), '(00) 00000-0000');
            applyMask(document.getElementById('cep'), '00000-000');

            document.getElementById('nome').addEventListener('input', (e) => {
                const displayNameField = document.getElementById('display_name');
                if (!displayNameField.value) {
                    displayNameField.value = e.target.value;
                }
            });

            document.getElementById('display_name').addEventListener('input', (e) => {
                const usernameField = document.getElementById('username');
                if (!usernameField.value) {
                    let username = e.target.value
                        .toLowerCase()
                        .replace(/[^a-z0-9\s]/g, '')
                        .replace(/\s+/g, '_')
                        .substring(0, 30);
                    usernameField.value = username;
                }
            });

            document.getElementById('cep').addEventListener('blur', async (e) => {
                const cep = e.target.value.replace(/\D/g, '');
                if (cep.length === 8) {
                    const data = await fetch(`https://viacep.com.br/ws/${cep}/json/` ).then(res => res.json());
                    if (!data.erro) {
                        document.getElementById('endereco').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';
                    }
                }
            });
        });

        function updateDocumentField(type) {
            const label = document.getElementById('documento-label');
            const input = document.getElementById('documento');
            input.value = '';
            if (type === 'pf') {
                label.textContent = 'CPF *';
                applyMask(input, '000.000.000-00');
            } else {
                label.textContent = 'CNPJ *';
                applyMask(input, '00.000.000/0000-00');
            }
        }

        function applyMask(field, maskPattern) {
            field.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');
                let result = '';
                let v_idx = 0;
                for (let m_idx = 0; m_idx < maskPattern.length && v_idx < value.length; m_idx++) {
                    if (maskPattern[m_idx] === '0') {
                        result += value[v_idx++];
                    } else if (v_idx < value.length) {
                        result += maskPattern[m_idx];
                    }
                }
                e.target.value = result;
            }, false);
        }
    </script>
</body>
</html>
