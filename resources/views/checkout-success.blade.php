<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagamento Aprovado | Lux Secrets</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              100: "#f3e8ff",
              500: "#8b5cf6",
              600: "#7c3aed",
              700: "#6d28d9"
            }
          },
          fontFamily: {
            lux: ["'Playfair Display'", "serif"]
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-purple-50 to-white min-h-screen flex items-center justify-center px-4">

  <div class="max-w-2xl w-full bg-white shadow-xl rounded-2xl p-8 text-center border border-purple-100">
    
    <!-- Logo / Nome -->
    <h1 class="font-lux text-4xl font-bold text-primary-600 mb-6">Lux Secrets</h1>

    <!-- Ícone de Sucesso -->
    <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
      <i class="fas fa-check text-primary-600 text-3xl"></i>
    </div>

    <!-- Mensagem Principal -->
    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Pagamento Aprovado!</h2>
    <p class="text-gray-600 mb-6">
      Seu pagamento foi confirmado com sucesso. Agora você já pode acessar a plataforma clicando no botão abaixo.
    </p>

    <!-- Orientações -->
    <div class="bg-purple-50 border border-purple-200 rounded-xl p-5 text-left mb-6">
      <h3 class="text-lg font-medium text-primary-700 mb-3">Como acessar:</h3>
      <ul class="list-disc pl-5 space-y-2 text-gray-700 text-sm">
        <li>Clique no botão <b>"Fazer Login"</b> abaixo.</li>
        <li>Use o <b>e-mail de compra</b> e a <b>senha informada</b> no momento da aquisição.</li>
      </ul>
    </div>

    <!-- Botão de Login -->
    <a href="/login" class="block w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 rounded-lg transition-colors mb-6">
      <i class="fas fa-sign-in-alt mr-2"></i> Fazer Login
    </a>

    <!-- Suporte -->
    <div class="text-sm text-gray-600">
      <p class="mb-2">Qualquer dúvida, nossa equipe está pronta para ajudar:</p>
      <p><i class="fas fa-envelope text-primary-600 mr-1"></i> <a href="mailto:suporte@luxsecrets.shop" class="text-primary-600 font-medium">suporte@luxsecrets.shop</a></p>
      <p><i class="fab fa-whatsapp text-green-500 mr-1"></i> <a href="https://wa.me/SEU_NUMERO_AQUI" class="text-primary-600 font-medium">WhatsApp</a></p>
    </div>

  </div>
</body>
</html>
