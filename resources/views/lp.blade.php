<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $association->nome }} - Planos e Serviços</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gray: {
                            50: '#fafafa',
                            100: '#f4f4f5',
                            200: '#e4e4e7',
                            300: '#d4d4d8',
                            400: '#a1a1aa',
                            500: '#71717a',
                            600: '#52525b',
                            700: '#3f3f46',
                            800: '#27272a',
                            900: '#18181b',
                            950: '#09090b',
                        },
                        blue: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'scale-in': 'scaleIn 0.5s ease-out',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .gradient-subtle {
            background: linear-gradient(180deg, #fafafa 0%, #ffffff 100%);
        }
        
        .card-saas {
            background: #ffffff;
            border: 1px solid #e4e4e7;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-saas:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #d4d4d8;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #18181b 0%, #52525b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .border-gradient {
            background: linear-gradient(135deg, #e4e4e7 0%, #d4d4d8 100%);
            padding: 1px;
            border-radius: 16px;
        }
        
        .border-gradient-inner {
            background: white;
            border-radius: 15px;
        }
    </style>
</head>
<body class="bg-white text-gray-900 font-sans antialiased">
    
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    @if($association->logo)
                        <img src="{{ Storage::url($association->logo) }}" alt="Logo" class="h-8 w-auto">
                    @else
                        <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-white text-sm"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="font-semibold text-gray-900">{{ $association->nome }}</h1>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#planos" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Planos</a>
                    <a href="#sobre" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Sobre</a>
                    <a href="#contato" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Contato</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-subtle py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            @if($association->logo)
                <div class="mb-8 animate-fade-in">
                    <img src="{{ Storage::url($association->logo) }}" alt="Logo da Associação" 
                         class="mx-auto h-16 w-auto object-contain">
                </div>
            @endif
            
            <h1 class="text-5xl lg:text-7xl font-bold text-gradient mb-6 animate-slide-up">
                {{ $association->nome }}
            </h1>
            
            @if($association->descricao)
                <p class="text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto mb-12 leading-relaxed animate-fade-in">
                    {{ $association->descricao }}
                </p>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-scale-in">
                <a href="#planos" class="btn-primary text-white font-semibold py-4 px-8 rounded-xl">
                    Explorar Planos
                </a>
                
                @if($association->site)
                    <a href="{{ $association->site }}" target="_blank" 
                       class="border border-gray-300 hover:border-gray-400 text-gray-700 hover:text-gray-900 font-semibold py-4 px-8 rounded-xl transition-all">
                        <i class="fas fa-external-link-alt mr-2 text-sm"></i>
                        Website
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    @if($association->data_fundacao || $association->numero_membros)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                @if($association->data_fundacao)
                    <div class="animate-scale-in">
                        <div class="text-4xl lg:text-5xl font-bold text-gray-900 mb-2">
                            {{ round($association->data_fundacao->diffInYears(now())) }}+
                        </div>
                        <p class="text-gray-600 font-medium">Anos de Experiência</p>
                    </div>
                @endif
                
                @if($association->numero_membros)
                    <div class="animate-scale-in">
                        <div class="text-4xl lg:text-5xl font-bold text-gray-900 mb-2">
                            {{ number_format($association->numero_membros, 0, ',', '.') }}+
                        </div>
                        <p class="text-gray-600 font-medium">Membros Ativos</p>
                    </div>
                @endif
                
                <div class="animate-scale-in">
                    <div class="text-4xl lg:text-5xl font-bold text-gray-900 mb-2">
                        {{ $association->plans->where('is_active', true)->count() }}
                    </div>
                    <p class="text-gray-600 font-medium">Planos Disponíveis</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Plans Section -->
    <section id="planos" class="py-24 lg:py-32 gradient-subtle">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 lg:mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-gradient mb-6">
                    Escolha seu plano
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Planos flexíveis que crescem com você
                </p>
            </div>

            @php
                $activePlans = $association->plans->where('is_active', true);
                $planCount = $activePlans->count();
                
                $gridClass = match($planCount) {
                    1 => 'flex justify-center',
                    2 => 'grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-4xl mx-auto',
                    3 => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto',
                    default => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8'
                };
            @endphp

            <div class="{{ $gridClass }}">
                @forelse($activePlans as $index => $plan)
                    <div class="card-saas rounded-2xl p-8 {{ $planCount === 1 ? 'max-w-sm' : '' }} relative">
                        
                        <!-- Popular Badge -->
                        @if($index === 1 && $planCount > 2)
                            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                                <span class="bg-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold">
                                    Mais Popular
                                </span>
                            </div>
                        @endif
                        
                        <!-- Plan Content -->
                        <div class="text-center">
                            @if($plan->image)
                                <div class="w-16 h-16 mx-auto mb-6 rounded-xl overflow-hidden">
                                    <img src="{{ Storage::url($plan->image) }}" alt="Imagem do Plano" 
                                         class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-16 h-16 bg-gray-100 rounded-xl mx-auto mb-6 flex items-center justify-center">
                                    <i class="fas fa-star text-gray-600 text-xl"></i>
                                </div>
                            @endif

                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $plan->name }}</h3>
                            <p class="text-gray-600 mb-8 leading-relaxed">{{ $plan->description }}</p>
                            
                            <div class="mb-8">
                                <div class="flex items-baseline justify-center mb-2">
                                    <span class="text-5xl font-bold text-gray-900">
                                        {{ number_format($plan->total_price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-gray-600 ml-1">
                                        @if($plan->total_price != floor($plan->total_price))
                                            ,{{ str_pad(($plan->total_price - floor($plan->total_price)) * 100, 2, '0') }}
                                        @endif
                                    </span>
                                </div>
                                <p class="text-gray-500 capitalize">
                                    por {{ $plan->recurrence }}
                                </p>
                            </div>

                            <a href="{{ route('checkout.show', ['hash_id' => $plan->hash_id]) }}" 
                               class="block w-full btn-primary text-white font-semibold py-4 px-6 rounded-xl text-center">
                                Começar agora
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="max-w-sm mx-auto text-center card-saas rounded-2xl p-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-clock text-gray-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Em breve</h3>
                        <p class="text-gray-600 mb-8">Novos planos serão lançados em breve.</p>
                        <a href="#contato" class="inline-block btn-primary text-white font-semibold py-3 px-6 rounded-xl">
                            Entrar em contato
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="sobre" class="py-24 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-20 items-center">
                <div class="animate-slide-up">
                    <h2 class="text-4xl lg:text-5xl font-bold text-gradient mb-8">
                        Sobre nós
                    </h2>
                    
                    @if($association->descricao)
                        <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                            {{ $association->descricao }}
                        </p>
                    @endif
                    
                    <div class="space-y-6">
                        @if($association->data_fundacao)
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-calendar text-gray-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Fundada em</p>
                                    <p class="text-gray-600">{{ $association->data_fundacao->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($association->numero_membros)
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-users text-gray-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Membros ativos</p>
                                    <p class="text-gray-600">{{ number_format($association->numero_membros, 0, ',', '.') }} pessoas</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-shield-alt text-gray-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Status</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $association->status === 'ativa' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($association->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center animate-fade-in">
                    @if($association->logo)
                        <img src="{{ Storage::url($association->logo) }}" alt="Logo da Associação" 
                             class="w-full max-w-md mx-auto rounded-2xl shadow-lg">
                    @else
                        <div class="w-full max-w-md mx-auto h-80 bg-gray-100 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-building text-gray-400 text-6xl"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contato" class="py-24 lg:py-32 gradient-subtle">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 lg:mb-20">
                <h2 class="text-4xl lg:text-5xl font-bold text-gradient mb-6">
                    Entre em contato
                </h2>
                <p class="text-xl text-gray-600">
                    Estamos aqui para ajudar
                </p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-16 max-w-6xl mx-auto">
                <!-- Contact Info -->
                <div class="space-y-8">
                    @if($association->telefone)
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white border border-gray-200 rounded-xl flex items-center justify-center mr-6 shadow-sm">
                                <i class="fas fa-phone text-gray-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telefone</h3>
                                <p class="text-gray-600">{{ $association->telefone_formatado }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($association->email)
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white border border-gray-200 rounded-xl flex items-center justify-center mr-6 shadow-sm">
                                <i class="fas fa-envelope text-gray-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">E-mail</h3>
                                <p class="text-gray-600">{{ $association->email }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($association->endereco)
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-white border border-gray-200 rounded-xl flex items-center justify-center mr-6 shadow-sm flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-gray-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Endereço</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $association->endereco_completo }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($association->site)
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white border border-gray-200 rounded-xl flex items-center justify-center mr-6 shadow-sm">
                                <i class="fas fa-globe text-gray-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Website</h3>
                                <a href="{{ $association->site }}" target="_blank" 
                                   class="text-blue-600 hover:text-blue-700 transition-colors">
                                    {{ $association->site }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Contact Form -->
                <div class="card-saas rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Envie uma mensagem</h3>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nome</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">E-mail</label>
                                <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Assunto</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Mensagem</label>
                            <textarea rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full btn-primary text-white font-semibold py-4 px-6 rounded-xl">
                            Enviar mensagem
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <!-- Association Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        @if($association->logo)
                            <img src="{{ Storage::url($association->logo) }}" alt="Logo" class="h-8 w-auto">
                        @else
                            <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-building text-white text-sm"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $association->nome }}</h3>
                        </div>
                    </div>
                    @if($association->descricao)
                        <p class="text-gray-600 leading-relaxed">{{ Str::limit($association->descricao, 150) }}</p>
                    @endif
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-6">Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#planos" class="text-gray-600 hover:text-gray-900 transition-colors">Planos</a></li>
                        <li><a href="#sobre" class="text-gray-600 hover:text-gray-900 transition-colors">Sobre</a></li>
                        <li><a href="#contato" class="text-gray-600 hover:text-gray-900 transition-colors">Contato</a></li>
                        @if($association->site)
                            <li><a href="{{ $association->site }}" target="_blank" class="text-gray-600 hover:text-gray-900 transition-colors">Website</a></li>
                        @endif
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="font-semibold text-gray-900 mb-6">Contato</h3>
                    <div class="space-y-3 text-gray-600">
                        @if($association->telefone)
                            <p class="flex items-center"><i class="fas fa-phone mr-3 w-4 text-gray-400"></i>{{ $association->telefone_formatado }}</p>
                        @endif
                        @if($association->email)
                            <p class="flex items-center"><i class="fas fa-envelope mr-3 w-4 text-gray-400"></i>{{ $association->email }}</p>
                        @endif
                        @if($association->cidade && $association->estado)
                            <p class="flex items-center"><i class="fas fa-map-marker-alt mr-3 w-4 text-gray-400"></i>{{ $association->cidade }}/{{ $association->estado }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-8 text-center text-gray-500">
                <p>&copy; {{ now()->year }} {{ $association->nome }}. Todos os direitos reservados.</p>
                @if($association->documento_formatado)
                    <p class="mt-2">{{ $association->tipo === 'pf' ? 'CPF' : 'CNPJ' }}: {{ $association->documento_formatado }}</p>
                @endif
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('[class*="animate-"]').forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    </script>
</body>
</html>
