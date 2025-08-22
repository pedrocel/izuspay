<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Plano
        </h2>
    </x-slot>

      <h3 class="text-3xl font-bold text-center mb-12">Você precisa de um plano para continuar</h3>
      <section id="pricing" class="py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12">Nossos Planos</h3>
            <div class="flex flex-wrap justify-center gap-6">
                @foreach($plans as $plan)
                    <div class="w-full md:w-80 bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="text-center">
                            <h4 class="text-2xl font-bold mb-2">{{ $plan->name }}</h4>
                            <p class="text-gray-600 mb-6">{{ $plan->description }}</p>
                            <div class="text-4xl font-bold text-[#CC54F4] mb-6">R${{ number_format($plan->value, 2, ',', '.') }}</div>
                            <a href="{{ $plan->link_checkout_external }}" class="block w-full bg-gradient-to-r from-[#CC54F4] to-[#AB66FF] text-white py-3 rounded-lg hover:from-[#AB66FF] hover:to-[#CC54F4] transition">
                                Assinar Agora
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
      </section>  
</x-app-layout>
