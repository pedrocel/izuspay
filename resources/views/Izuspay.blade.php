
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rifas Online - Concorra a Prêmios Incríveis</title>
  <link rel="stylesheet" href="assets.css">
</head>
<body>
  <!-- Header/Navigation -->
  <header class="main-header">
    <div class="header-container">
      <div class="logo">
        <h1>🎲 RIFAS ONLINE</h1>
      </div>
      <nav class="main-nav">
        <a href="index.php" class="active">Início</a>
        <a href="winners.php">Ganhadores</a>
        <a href="my-numbers.php">Meus Números</a>
        <a href="about.php">Quem Somos</a>
        <a href="contact.php">Fale Conosco</a>
        <a href="previous.php">Edições Anteriores</a>
      </nav>
      <a class="btn-admin" href="/admin/login.php">Admin</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-content">
      <h2 class="hero-title">CONCORRA A PRÊMIOS INCRÍVEIS!</h2>
      <p class="hero-subtitle">Participe das nossas rifas e realize seus sonhos</p>
      <a href="#raffles" class="btn-hero">Ver Rifas Disponíveis</a>
    </div>
  </section>

  <!-- How to Participate Section -->
  <section class="how-to-participate">
    <h2 class="section-title">É <span class="highlight">FÁCIL</span> PARTICIPAR!</h2>
    <p class="section-subtitle">É o melhor de tudo é poder <strong>concorrer a esse super prêmio</strong> com apenas algumas moedas!</p>
    
    <div class="steps-container">
      <div class="step">
        <div class="step-icon">🎫</div>
        <h3>Escolha o seu Título</h3>
        <p>Você pode escolher quantos títulos quiser! Quanto mais selecionar, mais chances você tem de ganhar!</p>
      </div>
      
      <div class="step">
        <div class="step-icon">💳</div>
        <h3>Efetue o pagamento</h3>
        <p>Fácil e seguro! E você pode pagar via pix!</p>
      </div>
      
      <div class="step">
        <div class="step-icon">✅</div>
        <h3>Pronto!</h3>
        <p>Agora é só aguardar participando! Você pode consultar o seu título em "Meus números"</p>
      </div>
    </div>
  </section>

  <!-- VIP Group Section -->
  <section class="vip-section">
    <div class="vip-container">
      <div class="vip-content">
        <h2>QUER MAIS CHANCES?</h2>
        <h3>ENTRE NO GRUPO VIP!</h3>
        <a href="https://wa.me/5511999999999?text=Quero%20entrar%20no%20grupo%20VIP" target="_blank" class="btn-whatsapp">
          ENTRAR
        </a>
      </div>
      <div class="vip-icon">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" style="width: 200px; height: 200px;">
      </div>
    </div>
  </section>

  <!-- Active Raffles Section -->
  <section class="raffles-section" id="raffles">
    <div class="container">
      <h2 class="section-title">Rifas em Andamento</h2>

      <?php if (!$raffles): ?>
        <p class="no-raffles">Nenhuma rifa disponível no momento.</p>
      <?php else: ?>
        <div class="raffles-grid">
          <?php foreach ($raffles as $r): ?>
            <div class="raffle-card">
              <div class="raffle-image">
                <img src="<?= esc($r['image'] ?: 'https://via.placeholder.com/400x250') ?>" alt="<?= esc($r['title']) ?>">
                <span class="raffle-badge">ATIVA</span>
              </div>
              <div class="raffle-body">
                <h3><?= esc($r['title']) ?></h3>
                <p class="raffle-description"><?= esc(mb_strimwidth($r['description'], 0, 120, '...')) ?></p>
                
                <div class="raffle-info">
                  <div class="info-item">
                    <span class="info-label">Valor por bilhete:</span>
                    <span class="info-value">R$ <?= number_format($r['price'], 2, ',', '.') ?></span>
                  </div>
                  <div class="info-item">
                    <span class="info-label">Disponíveis:</span>
                    <span class="info-value"><?= available_tickets_count($r['id']) ?> / <?= (int)$r['total_tickets'] ?></span>
                  </div>
                </div>
                
                <div class="progress-bar">
                  <?php 
                    $total = (int)$r['total_tickets'];
                    $available = available_tickets_count($r['id']);
                    $sold = $total - $available;
                    $percentage = $total > 0 ? ($sold / $total) * 100 : 0;
                  ?>
                  <div class="progress-fill" style="width: <?= $percentage ?>%"></div>
                </div>
                <p class="progress-text"><?= number_format($percentage, 1) ?>% vendidos</p>
                
                <a class="btn-primary" href="raffle.php?id=<?= $r['id'] ?>">Participar Agora</a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="faq-section">
    <div class="container">
      <h2 class="section-title">RIFAS ONLINE <span class="highlight">É SEGURO</span></h2>
      <p class="section-subtitle">Dúvida? Estamos aqui para ajudar.</p>
      
      <div class="faq-container">
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            QUEM PODE COMPRAR O BILHETE?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>Qualquer pessoa maior de 18 anos pode participar das nossas rifas. Basta escolher seus números e efetuar o pagamento de forma segura.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            ESSE SORTEIO É LEGAL?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>Sim! Todos os nossos sorteios são realizados de acordo com a legislação vigente. Trabalhamos com total transparência e segurança.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            SORTEIOS
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>Os sorteios são realizados de forma transparente e todos os participantes são notificados. Você pode acompanhar os resultados na seção "Ganhadores".</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            ONDE O PRÊMIO SERÁ ENTREGUE?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>O prêmio será entregue no endereço cadastrado pelo ganhador. Para prêmios em dinheiro, a transferência é feita via PIX de forma imediata.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <div class="main-footer py-12 bg-red text-white">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Rifas Online. Todos os direitos reservados.</p>
      <p>Jogue com responsabilidade. Proibido para menores de 18 anos.</p>
    </div>
          </div>

  <script>
    function toggleFaq(button) {
      const faqItem = button.parentElement;
      const answer = faqItem.querySelector('.faq-answer');
      const icon = button.querySelector('.faq-icon');
      
      // Close all other FAQs
      document.querySelectorAll('.faq-item').forEach(item => {
        if (item !== faqItem) {
          item.classList.remove('active');
          item.querySelector('.faq-answer').style.maxHeight = null;
          item.querySelector('.faq-icon').textContent = '+';
        }
      });
      
      // Toggle current FAQ
      faqItem.classList.toggle('active');
      if (faqItem.classList.contains('active')) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.textContent = '−';
      } else {
        answer.style.maxHeight = null;
        icon.textContent = '+';
      }
    }
  </script>
</body>
</html>

