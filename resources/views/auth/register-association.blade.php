<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Rifas Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #9333ea 0%, #ec4899 25%, #f97316 50%, #ec4899 75%, #9333ea 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(147, 51, 234, 0.15);
            border: 1px solid rgba(236, 72, 153, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #9333ea 0%, #ec4899 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(236, 72, 153, 0.4);
        }

        .tipo-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid #e2e8f0;
            background: rgba(248, 250, 252, 0.8);
        }

        .tipo-card:hover {
            border-color: #ec4899;
            background: rgba(255, 255, 255, 0.9);
        }

        .tipo-card.selected {
            border-color: #9333ea;
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
        }

        .input-field {
            display: block;
            width: 100%;
            border-radius: 0.75rem;
            border: 2px solid #e2e8f0;
            margin-top: 0.25rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: rgba(248, 250, 252, 0.8);
            color: #1e293b;
        }

        .input-field:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
            outline: none;
            background: rgba(255, 255, 255, 1);
        }

        .section-header {
            background: linear-gradient(135deg, #9333ea 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating-elements {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            background: rgba(236, 72, 153, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 15%;
            left: 20%;
            animation-delay: 4s;
        }

        .floating-element:nth-child(4) {
            width: 40px;
            height: 40px;
            bottom: 30%;
            right: 10%;
            animation-delay: 1s;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #9333ea 0%, #ec4899 100%);
            color: white;
            font-weight: bold;
            margin-right: 1rem;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg relative py-8">
    
    <!-- Elementos flutuantes de fundo -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    
    <div class="w-full max-w-4xl mx-auto px-4 relative z-10">
        <div class="glass-effect rounded-2xl shadow-2xl p-8 lg:p-12">
            
            <!-- Logo e título -->
            <div class="text-center mb-10">
                <div class="flex items-center justify-center mx-auto mb-6">
                    <svg class="w-16 h-16 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-black mb-2 bg-gradient-to-r from-purple-600 via-pink-600 to-orange-600 bg-clip-text text-transparent">
                    CRIAR CONTA
                </h1>
                <p class="text-gray-600 text-sm">Preencha os dados abaixo para começar a participar</p>
            </div>
            
            @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                <p class="font-bold mb-1 text-red-800">Ops! Algo deu errado.</p>
                <ul class="list-disc list-inside text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form method="POST" action="{{ route('association.register') }}" id="registration-form" class="space-y-8">
                @csrf
                
                <!-- Seção 1: Tipo de Perfil -->
                <fieldset>
                    <div class="flex items-center mb-4">
                        <div class="step-indicator">1</div>
                        <legend class="text-lg font-bold section-header">Tipo de Perfil</legend>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="tipo-card rounded-xl p-4 flex items-center space-x-3 {{ old('tipo', 'pf') == 'pf' ? 'selected' : '' }}">
                            <input type="radio" name="tipo" value="pf" class="sr-only" {{ old('tipo', 'pf') == 'pf' ? 'checked' : '' }}>
                            <i class="fas fa-user text-pink-600 text-2xl fa-fw"></i>
                            <span class="font-semibold text-gray-800">Pessoa Física (CPF)</span>
                        </label>
                        <label class="tipo-card rounded-xl p-4 flex items-center space-x-3 {{ old('tipo') == 'cnpj' ? 'selected' : '' }}">
                            <input type="radio" name="tipo" value="cnpj" class="sr-only" {{ old('tipo') == 'cnpj' ? 'checked' : '' }}>
                            <i class="fas fa-building text-pink-600 text-2xl fa-fw"></i>
                            <span class="font-semibold text-gray-800">Pessoa Jurídica (CNPJ)</span>
                        </label>
                    </div>
                </fieldset>

                <!-- Seção 2: Dados Pessoais -->
                <fieldset>
                    <div class="flex items-center mb-4">
                        <div class="step-indicator">2</div>
                        <legend class="text-lg font-bold section-header">Dados Pessoais</legend>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label for="nome" class="block text-sm font-semibold text-gray-700">Nome Completo *</label>
                            <input type="text" id="nome" name="nome" required class="input-field" value="{{ old('nome') }}" placeholder="Seu nome completo">
                        </div>
                        <div>
                            <label for="documento" class="block text-sm font-semibold text-gray-700" id="documento-label">CPF *</label>
                            <input type="text" id="documento" name="documento" required class="input-field" value="{{ old('documento') }}" placeholder="000.000.000-00">
                        </div>
                        <div>
                            <label for="telefone" class="block text-sm font-semibold text-gray-700">Telefone / WhatsApp *</label>
                            <input type="tel" id="telefone" name="telefone" required class="input-field" value="{{ old('telefone') }}" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                </fieldset>

                <!-- Seção 3: Perfil de Criador -->
                <fieldset>
                    <div class="flex items-center mb-4">
                        <div class="step-indicator">3</div>
                        <legend class="text-lg font-bold section-header">Perfil de Criador</legend>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="username" class="block text-sm font-semibold text-gray-700">Nome de Usuário *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-bold">@</span>
                                <input type="text" id="username" name="username" required class="input-field pl-8" 
                                       value="{{ old('username') }}" placeholder="seuusername">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Apenas letras, números e underscore. Será seu identificador único.</p>
                        </div>
                        <div>
                            <label for="display_name" class="block text-sm font-semibold text-gray-700">Nome de Exibição *</label>
                            <input type="text" id="display_name" name="display_name" required class="input-field" 
                                   value="{{ old('display_name') }}" placeholder="Como você quer aparecer">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="bio" class="block text-sm font-semibold text-gray-700">Biografia</label>
                            <textarea id="bio" name="bio" rows="3" class="input-field resize-none" 
                                      placeholder="Conte um pouco sobre você e suas rifas...">{{ old('bio') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Máximo 500 caracteres</p>
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-semibold text-gray-700">Categoria *</label>
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
                            <label for="website" class="block text-sm font-semibold text-gray-700">Website</label>
                            <input type="url" id="website" name="website" class="input-field" 
                                   value="{{ old('website') }}" placeholder="https://seusite.com">
                        </div>
                    </div>
                </fieldset>

                <!-- Seção 4: Dados de Acesso -->
                <fieldset>
                    <div class="flex items-center mb-4">
                        <div class="step-indicator">4</div>
                        <legend class="text-lg font-bold section-header">Dados de Acesso</legend>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700">E-mail *</label>
                            <input type="email" id="email" name="email" required class="input-field" value="{{ old('email') }}" placeholder="seu@email.com">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700">Senha *</label>
                            <input type="password" id="password" name="password" required class="input-field" placeholder="Mínimo 8 caracteres">
                            <p class="text-xs text-gray-500 mt-1">Use letras, números e símbolos</p>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirme sua Senha *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required class="input-field" placeholder="Digite a senha novamente">
                        </div>
                    </div>
                </fieldset>

                <!-- Seção 5: Endereço -->
                <fieldset>
                    <div class="flex items-center mb-4">
                        <div class="step-indicator">5</div>
                        <legend class="text-lg font-bold section-header">Endereço</legend>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="cep" class="block text-sm font-semibold text-gray-700">CEP *</label>
                            <input type="text" id="cep" name="cep" required class="input-field" value="{{ old('cep') }}" placeholder="00000-000">
                        </div>
                        <div></div>
                        <div class="sm:col-span-2 grid grid-cols-3 gap-6">
                            <div class="col-span-2">
                                <label for="endereco" class="block text-sm font-semibold text-gray-700">Endereço *</label>
                                <input type="text" id="endereco" name="endereco" required class="input-field" value="{{ old('endereco') }}" placeholder="Rua, Avenida...">
                            </div>
                            <div>
                                <label for="numero" class="block text-sm font-semibold text-gray-700">Número *</label>
                                <input type="text" id="numero" name="numero" required class="input-field" value="{{ old('numero') }}" placeholder="123">
                            </div>
                        </div>
                        <div>
                            <label for="bairro" class="block text-sm font-semibold text-gray-700">Bairro *</label>
                            <input type="text" id="bairro" name="bairro" required class="input-field" value="{{ old('bairro') }}" placeholder="Seu bairro">
                        </div>
                        <div>
                            <label for="cidade" class="block text-sm font-semibold text-gray-700">Cidade *</label>
                            <input type="text" id="cidade" name="cidade" required class="input-field" value="{{ old('cidade') }}" placeholder="Sua cidade">
                        </div>
                        <div>
                            <label for="estado" class="block text-sm font-semibold text-gray-700">Estado *</label>
                            <select id="estado" name="estado" required class="input-field">
                                <option value="">Selecione</option>
                                <option value="AC" {{ old('estado') == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ old('estado') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ old('estado') == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ old('estado') == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ old('estado') == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ old('estado') == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ old('estado') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ old('estado') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ old('estado') == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ old('estado') == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ old('estado') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ old('estado') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ old('estado') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ old('estado') == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ old('estado') == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ old('estado') == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ old('estado') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ old('estado') == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ old('estado') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ old('estado') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ old('estado') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ old('estado') == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ old('estado') == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ old('estado') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ old('estado') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ old('estado') == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ old('estado') == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                
                <!-- Botão de envio -->
                <div class="pt-6 text-center">
                    <button type="submit" class="w-full sm:w-auto btn-primary text-white font-bold py-4 px-12 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>
                        Criar Minha Conta
                    </button>
                    <p class="text-sm text-gray-500 mt-4">
                        Ao se cadastrar, você concorda com nossos 
                        <a href="#" class="text-pink-600 hover:text-purple-600 transition-colors font-medium">Termos de Uso</a> e 
                        <a href="#" class="text-pink-600 hover:text-purple-600 transition-colors font-medium">Política de Privacidade</a>
                    </p>
                    <p class="text-sm text-gray-600 mt-4">
                        Já tem uma conta?
                        <a href="{{ route('login') }}" class="text-pink-600 hover:text-purple-600 font-bold transition-colors">
                            Fazer login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Alternar seleção de tipo de perfil
            const radios = document.querySelectorAll('input[name="tipo"]');
            radios.forEach(radio => {
                radio.addEventListener('change', (e) => {
                    document.querySelectorAll('.tipo-card').forEach(c => c.classList.remove('selected'));
                    e.target.closest('.tipo-card').classList.add('selected');
                    
                    const label = document.getElementById('documento-label');
                    if (e.target.value === 'pf') {
                        label.textContent = 'CPF *';
                        document.getElementById('documento').placeholder = '000.000.000-00';
                    } else {
                        label.textContent = 'CNPJ *';
                        document.getElementById('documento').placeholder = '00.000.000/0000-00';
                    }
                });
            });

            // Buscar CEP (integração com API ViaCEP)
            const cepInput = document.getElementById('cep');
            cepInput.addEventListener('blur', async function() {
                const cep = this.value.replace(/\D/g, '');
                if (cep.length === 8) {
                    try {
                        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                        const data = await response.json();
                        if (!data.erro) {
                            document.getElementById('endereco').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                        }
                    } catch (error) {
                        console.error('Erro ao buscar CEP:', error);
                    }
                }
            });
        });
    </script>
</body>
</html>
