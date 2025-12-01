<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Criador - Izus Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1e40af',
                        'secondary-blue': '#3b82f6',
                        'accent-blue': '#60a5fa',
                        'dark-blue': '#1e3a8a',
                        'light-blue': '#dbeafe'
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
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 25%, #60a5fa 50%, #3b82f6 75%, #1e40af 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(30, 64, 175, 0.15);
            border: 1px solid rgba(96, 165, 250, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(59, 130, 246, 0.4);
        }

        /* Classes tipo-card removidas */

        .input-field {
            display: block;
            width: 100%;
            border-radius: 0.5rem;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 0.25rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: rgba(248, 250, 252, 0.8);
            color: #1e293b;
        }

        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
            background: rgba(255, 255, 255, 1);
        }

        .section-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    
    <div class="w-full max-w-4xl">
        <div class="glass-effect rounded-2xl shadow-2xl p-8 lg:p-12">
            
            <div class="text-center mb-10">
            <h1 class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-primary-blue to-accent-blue">
    {{ env('APP_NAME', 'Izus Payment') }}
</h1>
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
                
                <fieldset>
                    <legend class="text-lg font-semibold section-header mb-4">1. Dados Gerais</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo ou Marca *</label>
                            <input type="text" id="nome" name="nome" required class="input-field" value="{{ old('nome') }}">
                        </div>
                        
                        <div>
                            <label for="tipo-conta" class="block text-sm font-medium text-gray-700">Tipo de Conta *</label>
                            <select id="tipo-conta" name="tipo" required class="input-field">
                                <option value="pf" {{ old('tipo', 'pf') == 'pf' ? 'selected' : '' }}>Pessoa Física</option>
                                <option value="cnpj" {{ old('tipo') == 'cnpj' ? 'selected' : '' }}>Pessoa Jurídica</option>
                            </select>
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
                
                <fieldset>
                    <legend class="text-lg font-semibold section-header mb-4">2. Endereço</legend>
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

                <fieldset>
                    <legend class="text-lg font-semibold section-header mb-4">3. Senha de Acesso</legend>
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
                
                <div class="pt-6 text-center">
                    <button type="submit" class="w-full sm:w-auto btn-primary text-white font-bold py-4 px-12 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>
                        Finalizar Cadastro
                    </button>
                    <p class="text-sm text-gray-500 mt-4">
                        Ao se cadastrar, você concorda com nossos 
                        <a href="#" class="text-secondary-blue hover:text-primary-blue transition-colors">Termos de Uso</a> e 
                        <a href="#" class="text-secondary-blue hover:text-primary-blue transition-colors">Política de Privacidade</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tipoContaSelect = document.getElementById('tipo-conta');
            const documentoLabel = document.getElementById('documento-label');
            const documentoInput = document.getElementById('documento');

            // Função para atualizar o label
            const updateDocumentoLabel = (value) => {
                if (value === 'pf') {
                    documentoLabel.textContent = 'CPF *';
                    documentoInput.placeholder = '000.000.000-00';
                } else {
                    documentoLabel.textContent = 'CNPJ *';
                    documentoInput.placeholder = '00.000.000/0000-00';
                }
                // Limpa o campo ao trocar para evitar problemas de validação
                documentoInput.value = ''; 
            };
            
            // 1. Ouve a mudança no campo de seleção
            if (tipoContaSelect) {
                tipoContaSelect.addEventListener('change', (e) => {
                    updateDocumentoLabel(e.target.value);
                });
            }

            // 2. Garante que o label esteja correto no carregamento inicial (se old('tipo') estiver setado)
            if (tipoContaSelect) {
                updateDocumentoLabel(tipoContaSelect.value);
            }
        });
    </script>
</body>
</html>