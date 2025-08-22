<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CopyWave - Ferramenta de Clonagem de Páginas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link id="favicon" rel="icon" href="/img/copywave.png" type="image/x-icon"/>
  <style>
    .bg-gradient {
      background: linear-gradient(90deg, #CC54F4, #AB66FF);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- component -->
<header class="fixed w-full">
  <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
      <!-- Logo atualizada para copywave.png -->
      <a href="/" class="flex items-center">
        <img src="img/copywave.png" class="h-6 mr-3 sm:h-9" alt="Copywave Logo" />
      </a>
      <div class="flex items-center lg:order-2">
        <!-- Botão de Download em português -->
        <a href="login" target="_blank"
          class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">
          Login
        </a>
        <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="mobile-menu-2" aria-expanded="false">
          <span class="sr-only">Abrir menu principal</span>
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
          <!-- Menus em português -->
          <li>
            <a href="#"
              class="block py-2 pl-3 pr-4 text-white bg-purple-700 rounded lg:bg-transparent lg:text-purple-700 lg:p-0 dark:text-white"
              aria-current="page">Início</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Empresa</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Mercado</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Funcionalidades</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Equipe</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Contato</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<section class="bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-24 lg:px-6">
            <!-- Primeira seção -->
        <div class="items-center gap-12 lg:grid xl:gap-16">
            <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">TERMOS E CONDIÇÕES GERAIS DE USO DA PLATAFORMA COPYWAVE TECNOLOGIA</h2>
                <p class="mb-8 font-light lg:text-p"><strong>Data da versão:</strong> 02/02/2025</p>
                <p>Os serviços da referida plataforma são oferecidos pela empresa denominada COPYWAVE TECNOLOGIA, CNPJ nº 58.954.044/0001-30, com SEDE estabelecida no endereço: Rua Valdizar Saldanha Fontenele, 42, Bairro Lagoa Redonda, Fortaleza - CE, CEP: 60.831-460. A plataforma COPYWAVE TECNOLOGIA abrange software, website, conteúdos e outros ativos relacionados.</p>

                <h2>CLÁUSULA PRIMEIRA - TERMOS E CONDIÇÕES DE USO:</h2>
                <p>1.1 O presente documento regula a relação entre a COPYWAVE TECNOLOGIA e os usuários, sendo a aceitação voluntária destes termos indispensável para o uso da plataforma.</p>
                <p>1.2 O acesso e uso do site copywave.io e de qualquer subdomínio implicam na leitura e aceitação integral deste documento.</p>
                <p>1.3 Os termos estarão disponíveis para consulta no site e, por serem de domínio público, o desconhecimento não poderá ser alegado.</p>
                <p>1.4 Termos adicionais poderão ser aplicados, conforme a atividade do usuário na plataforma, sendo esses parte integrante deste documento.</p>
                <p>1.5 Em caso de conflito entre os termos gerais e termos adicionais, prevalecerá a cláusula mais específica.</p>
                <p>1.6 A COPYWAVE TECNOLOGIA poderá alterar os termos a qualquer momento sem aviso prévio, cabendo ao usuário verificar periodicamente as atualizações.</p>
                <p>1.7 É de responsabilidade do usuário verificar periodicamente os Termos e eventuais Termos Adicionais, na íntegra. Caso o usuário discorde de alguma atualização dos termos, deve cessar imediatamente o uso da plataforma e solicitar o descadastramento de sua conta.</p>
                <p>1.8 Os termos de uso constituem um acordo legal vinculativo entre as partes e vigorarão por prazo indeterminado.</p>

                <h2>CLÁUSULA SEGUNDA - DA PLATAFORMA:</h2>
                <p>2.1 A COPYWAVE TECNOLOGIA é uma Plataforma online hospedada sob o domínio copywave.io, e de propriedade da COPYWAVE TECNOLOGIA, CNPJ nº 58.954.044/0001-30.</p>
                <p>2.2 A COPYWAVE TECNOLOGIA fornece um conjunto de ferramentas para marketing digital e afiliados.</p>
                <p>2.3 Para acessar os serviços, o usuário precisa de um computador, notebook ou smartphone com conexão à internet.</p>
                <p>2.4 Os usuários concordam que a plataforma é independente e não exclusiva, em que o usuário atua por conta própria e que se utilizam dos próprios recursos para a execução das atividades.</p>
                <p>2.6 Os usuários reconhecem que a relação jurídica estabelecida por estes Termos não cria vínculo empregatício, societário, de associação, mandato, franquia, ou de qualquer outra natureza.</p>
                <p>2.7 Os usuários reconhecem que a COPYWAVE TECNOLOGIA não tem ingerência, controle ou responsabilidade sobre as avaliações realizadas por terceiros.</p>
                <h2>CLÁUSULA TERCEIRA - DO OBJETO:</h2>
                <p>3.1 A plataforma possibilita a utilização de seu software, website e demais ativos de propriedade intelectual.</p>
                <p>3.2 A plataforma disponibiliza ferramentas para auxiliar os usuários no desenvolvimento de estratégias digitais, incluindo:</p>
                <ul>
                <li>Validação de domínios para Hotmart e Facebook Ads;</li>
                <li>Cópia e personalização de páginas de vendas;</li>
                <li>Instalação de pixel do Facebook e Tags do Google Ads;</li>
                <li>Criação de páginas pressel;</li>
                <li>Hospedagem segura de conteúdos;</li>
                <li>Certificado SSL;</li>
                <li>Acesso à biblioteca de anúncios do Facebook;</li>
                <li>Hospedagem de páginas e recursos criados usando a plataforma.</li>
                </ul>

                <h2>CLÁUSULA QUARTA - DA ACEITAÇÃO:</h2>
                <p>4.1 O presente Termo estabelece obrigações contratadas de livre e espontânea vontade, por tempo indeterminado.</p>
                <p>4.2 O uso da plataforma implica na aceitação completa destes termos.</p>
                <p>4.3 O usuário é responsável por todas as suas atividades ao utilizar o website.</p>
                <p>4.4 O usuário não poderá utilizar o serviço para qualquer finalidade ilegal ou não autorizada.</p>
                <p>4.5 Não será permitida a realização de upload, ou transmissão de vírus ou qualquer outro código destrutivo.</p>
                <p>4.6 Além do aceite das normas, o usuário dá ciência dos seguintes termos:</p>
                <p>4.7. A COPYWAVE TECNOLOGIA pode conter conteúdo e links de terceiros para sites de terceiros que não pertençam nem sejam controlados pela COPYWAVE TECNOLOGIA.</p>
                <p>4.8. A COPYWAVE TECNOLOGIA não tem controle, nem assume nenhuma responsabilidade pelo conteúdo, pelas políticas de privacidade ou pelas práticas de qualquer conteúdo ou sites de terceiros ou qualquer um dos seus conteúdos.</p>
                <p>4.9. O usuário não poderá alterar, nem modificar qualquer parte do sistema que não possa ser razoavelmente necessária para utilizar o Site para a sua finalidade e/ou de uma forma permitida pela COPYWAVE TECNOLOGIA.</p>
                <p>4.10. A responsabilidade sobre a conta e a senha é do usuário, o qual deverá notificar a COPYWAVE TECNOLOGIA imediatamente sobre qualquer violação de segurança ou uso não autorizado de sua conta.</p>
                <p>4.11. Embora a COPYWAVE TECNOLOGIA não seja responsável pelas perdas causadas por qualquer uso não autorizado de sua conta, o usuário poderá ser responsabilizado pelas perdas da COPYWAVE TECNOLOGIA ou de outrem, devido a esse uso não autorizado.</p>
                <p>4.12. Ao utilizar o Website, o usuário expressamente isenta a COPYWAVE TECNOLOGIA de toda e qualquer responsabilidade decorrente do mau uso que fizer de qualquer site de terceiros.</p>
                <p>4.13. Para efeitos deste termo de uso, “associar a marca da nossa Empresa” significa expor o nome, logo, marca comercial ou outros meios de atribuição ou identificação em fonte de maneira que dê ao usuário a impressão de que tal fonte tem o direito de expor, publicar ou distribuir este site ou o conteúdo disponibilizado por ele.</p>
                <p>4.14. Atenção: A aceitação do presente instrumento é imprescindível para o acesso e para a utilização de quaisquer serviços fornecidos pela empresa. Caso não concorde com as disposições deste instrumento, o usuário não deve utilizá-los.</p>
                <p>4.15. Cumpra o usuário com as leis aplicáveis - por exemplo, não comprometa a privacidade de outras pessoas, envolva-se em atividades regulamentadas sem cumprir as regulamentações aplicáveis ou promova ou participe de qualquer atividade ilegal, incluindo a exploração ou o dano a crianças e o desenvolvimento ou distribuição de substâncias tóxicas, bens ou serviços ilegais.</p>
                <p>4.16. Não use nosso serviço para se prejudicar ou prejudicar outras pessoas - por exemplo, não use nossos serviços para promover suicídio ou autolesão, desenvolver ou usar armas, ferir outras pessoas ou destruir propriedades, ou se envolver em atividades não autorizadas que violem a segurança de qualquer serviço ou sistema.</p>
                <p>4.17. Não reutilize ou distribua os resultados de nossos serviços para prejudicar outras pessoas - por exemplo, não compartilhe os resultados de nossos serviços para fraudar, enganar, enviar spam, enganar, intimidar, difamar, discriminar com base em atributos protegidos, sexualizar crianças ou promover violência, ódio ou sofrimento de outras pessoas.</p>
                <p>4.18. Respeite nossas salvaguardas - não burle as salvaguardas ou mitigadores de segurança em nossos serviços, a menos que seja apoiado pela COPYWAVE TECNOLOGIA (por exemplo, especialistas de domínio em nossa Rede de Testes Vermelhos) ou relacionado à pesquisa conduzida de acordo com nossa Política de Compartilhamento e Publicação.</p>

                <h2>CLÁUSULA QUINTA: DO ACESSO AOS USUÁRIOS</h2>
                <p>5.1. Após a realização do cadastro inicial, o usuário poderá acessar imediatamente o sistema da COPYWAVE TECNOLOGIA e utilizar a plataforma disponibilizada.</p>
                <p>5.2. Serão utilizadas todas as soluções técnicas à disposição do responsável pela plataforma para permitir o acesso ao serviço 24 (vinte e quatro) horas por dia, 7 (sete) dias por semana.</p>
                <p>5.3. A navegação na plataforma ou em alguma de suas páginas poderá ser interrompida, limitada ou suspensa para atualizações, modificações ou qualquer ação necessária ao seu bom funcionamento.</p>
                <p>5.4. O acesso às funcionalidades da plataforma exigirá a realização de um cadastro prévio e do pagamento de determinado valor.</p>

                <h2>CLÁUSULA SEXTA: DO CADASTRO</h2>
                <p>6.1. Para a utilização da Plataforma é necessária a criação de um perfil de usuário. Para tal, o usuário deverá informar e/ou disponibilizar: (i) nome completo (ii) CPF, (iii) endereço, (iv) telefone para contato e (v) endereço de e-mail, por fim, o usuário deverá criar uma senha, a qual é realizar a devida verificação de senha, a qual é de uso pessoal e intransferível, para acessar a Plataforma por meio do login com seu endereço de e-mail.</p>
                <p>6.2. Caso seja identificada qualquer informação inexata do usuário, a COPYWAVE TECNOLOGIA, a seu exclusivo critério, poderá solicitar a retificação ou complementação das informações necessárias ou, ainda, rejeitar o cadastro do usuário por motivos de segurança.</p>
                <p>6.3. A COPYWAVE TECNOLOGIA poderá, ainda, avaliar periodicamente os documentos e informações constantes do cadastro. Nestes casos, se for constatada qualquer inconsistência, a COPYWAVE TECNOLOGIA poderá, a seu exclusivo critério, solicitar a retificação ou complementação das informações e/ou documentos necessários ou, ainda, suspender temporariamente ou definitivamente o cadastro do usuário, por motivos de segurança.</p>
                <p>Parágrafo único: O uso ou distribuição de ferramentas destinadas para comprometer a segurança (ex: programas para descobrir senha, ferramentas de crack ou de sondagem da rede, phishing) são estritamente proibidos. Se você estiver envolvido em qualquer violação da segurança do sistema, a COPYWAVE TECNOLOGIA se reserva o direito de fornecer suas informações para os administradores de sistema de outros sites para ajudá-los a resolver incidentes de segurança.</p>
                <p>6.4. O usuário deverá manter todos os seus dados sempre atualizados, sob pena de impossibilidade: de acesso, ou da utilização da Plataforma, não sendo a COPYWAVE TECNOLOGIA responsável, portanto, por qualquer erro/ausência de pagamento ocasionados ou problemas no acesso, por inconsistência nos dados cadastrais.</p>
                <p>6.5. O Perfil é de uso exclusivo do usuário e o login e senha por ele criados são pessoais e intransferíveis, comprometendo-se ainda a não informar para terceiros, sendo a sua guarda de responsabilidade única e exclusiva. A utilização do perfil do usuário por terceiros poderá implicar em desativação imediata e definitiva da sua conta.</p>
                <p>6.6. O usuário compromete-se, ainda, a informar imediatamente ao COPYWAVE TECNOLOGIA qualquer suspeita de utilização, invasão ou acesso indevidos no seu perfil, sob pena de ter sua conta suspensa ou desativada em razão de qualquer atividade suspeita detectada pelo COPYWAVE TECNOLOGIA.</p>
                <p>6.7. A COPYWAVE TECNOLOGIA se reserva ao direito de, a qualquer momento, desativar ou suspender temporariamente a conta do usuário caso haja qualquer suspeita de irregularidade de quaisquer dados ou de atividade de uso da referida conta, pela segurança do próprio usuário da COPYWAVE TECNOLOGIA e todos os demais usuários da Plataforma, bastando para tanto informar ao usuário: (i) detecção de suspeita; (ii) providências adotadas temporariamente pela COPYWAVE TECNOLOGIA, para análise e verificação e (iii) providências definitivas adotadas pela COPYWAVE TECNOLOGIA.</p>
                <p>6.8. Todos os dados pessoais do usuário serão mantidos em sigilo, conforme Lei Geral de Proteção de Dados Pessoais (LGPD Lei nº 13.709/2018).</p>

                <h2>CLÁUSULA SÉTIMA: DA VERACIDADE DOS DADOS</h2>
                <p>7.1. Ao se cadastrar o usuário deverá informar dados completos, recentes e válidos, sendo de sua exclusiva responsabilidade manter referidos dados atualizados.</p>
                <p>7.2. O usuário compromete-se com a veracidade dos dados fornecidos.</p>
                <p>7.3. O usuário se compromete a não informar seus dados cadastrais e/ou de acesso à plataforma a terceiros, responsabilizando-se integralmente pelo uso que deles seja feito.</p>
                <p>7.4. Menores de 18 anos e aqueles que não possuírem plena capacidade civil deverão obter previamente o consentimento expresso de seus responsáveis legais para utilização da plataforma e dos serviços, sendo de responsabilidade exclusiva dos mesmos o eventual acesso por menores de idade e por aqueles que não possuem plena capacidade civil sem a prévia autorização.</p>
                <p>7.5. Mediante a realização do cadastro o usuário declara e garante expressamente ser plenamente capaz, podendo exercer e usufruir livremente dos serviços.</p>
                <p>7.6. O usuário deverá fornecer um endereço de e-mail válido
                <p>7.7. Após a confirmação do cadastro, o usuário possuirá um login e uma senha pessoal, a qual assegura ao usuário o acesso individual à mesma. Desta forma, compete ao usuário exclusivamente a manutenção de referida senha de maneira confidencial e segura, evitando o acesso indevido às informações pessoais.</p>
                <p>7.8. Toda e qualquer atividade realizada com o uso da senha será de responsabilidade do usuário, que deverá informar prontamente à plataforma em caso de uso indevido da respectiva senha.</p>
                <p>7.9. Não será permitido ceder, vender, alugar ou transferir, de qualquer forma, a conta, que é pessoal e intransferível.</p>
                <h2>Cláusula Oitava – Da Compatibilidade e Aceite</h2>
                <p>8.1. Caberá ao usuário assegurar que o seu equipamento seja compatível com as características técnicas que viabilize a utilização da plataforma e dos serviços ou produtos.</p>
                <p>8.2. O usuário, ao aceitar os Termos e Política de Privacidade, autoriza expressamente a plataforma a coletar, usar, armazenar, tratar, ceder ou utilizar as informações derivadas do uso dos serviços, do site e quaisquer plataformas, incluindo todas as informações preenchidas pelo usuário no momento em que realizar ou atualizar seu cadastro, além de outras expressamente descritas na Política de Privacidade que deverá ser autorizada pelo usuário.</p>
                <h2>Cláusula Nona – Dos Serviços</h2>
                <p>9.1. A plataforma disponibilizará para o usuário o seguinte serviço: pacote de ferramentas para usuários que atuam com marketing de afiliados e marketing digital.</p>
                <p>9.2. Na plataforma, os serviços oferecidos estão descritos e apresentados com o maior grau de exatidão, contendo informações sobre suas características, qualidades, quantidades, composição, preço, garantia, prazos de validade e origem, entre outros dados, bem como sobre os riscos que apresentam à saúde e segurança do usuário.</p>
                <p>9.3. A entrega de serviços adquiridos na plataforma será informada no momento da finalização da compra.</p>
                <h2>Cláusula Décima – Do Preço</h2>
                <p>10.1. Os valores dos serviços da plataforma são:</p>
                <ul>
                <li>Assinatura plano mensal: R$</li>
                <li>Assinatura plano trimestral: R$</li>
                <li>Assinatura plano semestral: R$</li>
                <li>Assinatura plano Plus anual: R$</li>
                </ul>
                <p>10.2. A plataforma se reserva no direito de reajustar unilateralmente, a qualquer tempo, os valores dos serviços e produtos sem consulta prévia ou anuência ao usuário.</p>
                <p>10.3. Os preços são indicados em reais, as quais são especificadas à parte e informadas ao usuário antes da finalização do pedido.</p>
                <p>10.4. Na contratação de determinado serviço ou produto, a plataforma poderá solicitar as informações financeiras do usuário, como CPF, endereço de cobrança, dados de cartões e documentos digitais.</p>
                <p>10.5. Ao inserir referidos dados, o usuário concorda que sejam cobrados, de acordo com a forma de pagamento que venha a ser escolhida, os preços então vigentes e informados quando da contratação. Os referidos dados financeiros poderão ser armazenados para facilitar acessos e contratações futuras.</p>
                <p>10.6. A contratação dos serviços será renovada de forma mensal, trimestral, semestral ou anual de acordo com o plano escolhido, e ocorrerá automaticamente pela plataforma, independentemente de comunicação ao usuário, mediante cobrança periódica da mesma forma de pagamento indicada pelo usuário quando da contratação do serviço.</p>
                <h2>Cláusula Décima Primeira – Dos Conteúdos de Terceiros</h2>
                <p>11.1. A COPYWAVE TECNOLOGIA permite o usuário criar links para imagens, animações, vídeos, áudio, fontes e outros conteúdos hospedados em sites de terceiros (o "Conteúdo Vinculado").</p>
                <p>11.2. Como usuário registrado, a criação do usuário é salva pela COPYWAVE TECNOLOGIA, mas permanece separado do Conteúdo Vinculado, e a existência de sua criação na COPYWAVE TECNOLOGIA não afeta, de nenhuma maneira, a possibilidade de ver ou utilizar o Conteúdo Vinculado.</p>
                <p>11.3. Se o Conteúdo Vinculado não estiver mais disponível nem for acessível para um usuário, então essa parte de sua criação que faz referência ao Conteúdo Vinculado não funcionará.</p>
                <p>11.4. A COPYWAVE TECNOLOGIA pode oferecer a seus usuários a possibilidade de incorporar no conteúdo criado pela COPYWAVE TECNOLOGIA imagens, animações, vídeos, áudio, fontes e outros conteúdos pertencentes ou fornecidos por terceiros no conteúdo criado pela COPYWAVE TECNOLOGIA. Nesse caso, o uso desse conteúdo de terceiros estará sujeito ao cumprimento das disposições destes Termos de Uso e, além disso, aos termos de uso/acordo de licença do usuário final de terceiros que detêm ou fornecem o conteúdo usado.</p>
                <p>11.5. A COPYWAVE TECNOLOGIA poderá fornecer no Website (incluindo o editor e/ou nos templates oferecidos aos usuários) alguns conteúdos como, por exemplo, fotos, fontes, itens gráficos que estão sujeitos aos direitos de propriedade de terceiros ("Conteúdo de Terceiros").</p>
                <p>11.6. O usuário reconhece e concorda que a COPYWAVE TECNOLOGIA deverá ter o direito, a qualquer momento, e a seu critério exclusivo de:</p>
                <ul>
                <li>Remover e/ou desativar o acesso a tal Conteúdo de Terceiros; ou</li>
                <li>Exigir que o usuário remova imediatamente tal conteúdo de terceiro de qualquer website ou outra plataforma da web criada e/ou publicada por você nas páginas da COPYWAVE TECNOLOGIA.</li>
                </ul>

                <p>11.7. Se o usuário não obedecer a tais instruções e não remover o Conteúdo de Terceiro do seu Conteúdo da COPYWAVE TECNOLOGIA dentro de não mais do que 24 horas do momento no qual a COPYWAVE TECNOLOGIA forneceu a você tal notificação pertinente, a COPYWAVE TECNOLOGIA poderá desativar o acesso do usuário ao conteúdo e/ou excluí-lo a seu critério exclusivo, sem responsabilização para a COPYWAVE TECNOLOGIA, e o usuário não terá direito a reembolso.</p>

                <p>11.8. A COPYWAVE TECNOLOGIA ratifica que as cláusulas desta seção acima deverão se aplicar a qualquer conteúdo fornecido aos Usuários no Website e para os quais a COPYWAVE TECNOLOGIA exige a sua remoção, por qualquer razão.</p>

                <p>11.9. Das Violações: A COPYWAVE TECNOLOGIA permite o envio e o carregamento de Conteúdo enviado por você e outros usuários ("Conteúdo do Usuário") e a hospedagem, o compartilhamento e/ou publicação desses Conteúdos do Usuário. Você entende que, independentemente de esses Conteúdos do Usuário serem ou não publicados, a COPYWAVE TECNOLOGIA não garante nenhuma proteção em relação a tal Conteúdo do Usuário.</p>

                <p>11.10. Infrator reincidente: A COPYWAVE TECNOLOGIA reserva-se o direito de remover o Conteúdo e os Conteúdos do Usuário sem aviso prévio. A COPYWAVE TECNOLOGIA também vai encerrar o acesso do Usuário ao seu Site, caso se determine que ele é um infrator reincidente.</p>
                <h2>11.11.</h2>
                <p>O infrator reincidente é o usuário que foi notificado da atividade de infração mais de duas vezes e/ou teve o Conteúdo do Usuário retirado do Site mais de duas vezes.</p>

                <h2>11.12.</h2>
                <p>A COPYWAVE TECNOLOGIA também se reserva o direito de decidir se o Conteúdo ou o Conteúdo do Usuário é apropriado e obedece a esses Termos de Serviço no que tange a violações que não de direitos autorais da lei de propriedade intelectual.</p>

                <h2>11.13.</h2>
                <p>A COPYWAVE TECNOLOGIA pode remover esses Conteúdos do Usuário e/ou cancelar o acesso de um Usuário pelo envio desse material em violação destes Termos de Uso a qualquer momento, sem aviso prévio e a seu exclusivo critério.</p>

                <h2>11.14.</h2>
                <p>A COPYWAVE TECNOLOGIA não garante que poderá proteger seus usuários da exposição ao material ofensivo. A COPYWAVE TECNOLOGIA não se responsabiliza pelo conteúdo de qualquer Conteúdo do Usuário e expressamente isenta-se de toda a responsabilidade daí relacionada.</p>

                <h2>CLÁUSULA DÉCIMA SEGUNDA - DO CANCELAMENTO:</h2>

                <h2>12.1.</h2>
                <p>O usuário poderá cancelar a contratação dos serviços de acordo com os termos que forem definidos no momento de sua contratação.</p>

                <h2>12.2.</h2>
                <p>O usuário poderá cancelar os serviços em até 7 (sete) dias após a contratação, através do site, de acordo com o Código de Defesa do Consumidor (Lei no. 8.078/90).</p>

                <h2>12.3.</h2>
                <p>O serviço poderá ser cancelado por:</p>
                <ul>
                <li>usuário: nessas condições os serviços somente cessarão quando concluído o ciclo vigente ao tempo do cancelamento;</li>
                <li>plataforma: violação dos Termos de Uso: os serviços serão cessados imediatamente sem reembolso.</li>
                </ul>

                <h2>12.4.</h2>
                <p>O serviço poderá ser cancelado pela plataforma em virtude do descumprimento dos termos e condições de uso, implicando no encerramento imediato do plano, sem prejuízo dos pagamentos e das medidas cabíveis, além da possibilidade de ingressar em juízo pelas perdas e danos.</p>

                <h2>CLÁUSULA DÉCIMA TERCEIRA – DO SUPORTE:</h2>

                <h2>13.1.</h2>
                <p>Em caso de qualquer dúvida, sugestão ou problema com a utilização da plataforma, o usuário poderá entrar em contato com o suporte, com o preenchimento do formulário através do link: <a href="https://COPYWAVE TECNOLOGIA.com.br/ajuda">https://COPYWAVE TECNOLOGIA.com.br/ajuda</a></p>

                <h2>CLÁUSULA DÉCIMA QUARTA - DAS OBRIGAÇÕES E RESPONSABILIDADES:</h2>

                <h2>14.1.</h2>
                <p>A plataforma não se responsabiliza pelo nome de usuário, pois se trata de responsabilidade do próprio usuário.</p>

                <h2>14.1.1.</h2>
                <p>Caso o usuário utilize o nome de outra empresa que já possua registro de marca, essa empresa poderá recorrer e o usuário terá que alterar o nome de usuário, caso contrário sua conta poderá ser excluída e assim dar prioridade para o detentor dos direitos da marca e responsabilizar-se.</p>

                <h2>14.1.2.</h2>
                <p>É de inteira responsabilidade do usuário a responsabilidade sobre os dados cadastrais que irá fornecer e as demandas judiciais decorrentes da má-utilização do nome de terceiros.</p>

                <h2>14.2.</h2>
                <p>É estritamente proibida a venda de itens e produtos ilícitos, e em sendo constatada a ocorrência, a plataforma sem aviso prévio realizará o cancelamento imediato do referido contrato com o usuário. Sendo de inteira responsabilidade do usuário as consequências do ato danoso. Sem prejuízo do direito da plataforma em ingressar com as medidas judiciais cabíveis e perdas e danos.</p>

                <h2>14.3.</h2>
                <p>É de responsabilidade do usuário, qualquer dano causado aos clientes finais que forem prejudicados pelos afiliados ou usuários da plataforma, exonerando a COPYWAVE TECNOLOGIA de toda e qualquer responsabilidade neste sentido e se comprometendo a ressarcir ao Cliente Final, e/ou a plataforma COPYWAVE TECNOLOGIA de todos os danos e/ou prejuízos que estes(s) venham a sofrer em decorrência de ação e/ou omissão do usuário.</p>

                <h2>14.3.1.</h2>
                <p>É de responsabilidade do usuário, o uso correto e devido da Plataforma, sendo expressamente proibido de copiar, reproduzir, distribuir, duplicar, compilar, criar obra derivada, alterar, combinar, modificar, adaptar, traduzir, ampliar, mesclar, decodificar, recriar ou realizar a engenharia reversa de qualquer componente da Plataforma, sob pena de responder judicialmente pelo dano ocorrido.</p>

                <h2>14.3.2.</h2>
                <p>É dever do usuário indenizar a COPYWAVE TECNOLOGIA, suas filiais, coligadas, controladoras, controladas, diretores, administradores, colaboradores, representantes e empregados por quaisquer danos, prejuízos, responsabilização, reclamações, processos, perdas, demandas ou despesas, incluindo, mas não se limitando a isso, honorários advocatícios, custas judiciais e ônus de sucumbência decorrentes da utilização indevida da Plataforma;</p>

                <h2>14.4.</h2>
                <p>É de responsabilidade do usuário, dispor dos ativos, equipamentos técnicos e operacionais necessários para a realização dos serviços oferecidos ao cliente final, de acordo com a legislação aplicável.</p>

                <h2>14.5.</h2>
                <p>É de responsabilidade do usuário cumprir todas as leis, regulamentos e normas em âmbito federal, estadual e municipal na execução das Atividades e da utilização da plataforma, assumindo a responsabilidade por todas as multas, penalidades e processos administrativos ou judiciais decorrentes ou referentes ao serviço prestado ao cliente final.</p>

                <h2>14.5.1.</h2>
                <p>Em nenhuma hipótese, o usuário poderá oferecer produtos ou serviços que envolvam o transporte de cartas, cartões-postais e correspondências agrupadas (nos termos da Lei nº 6.538/78); de produtos ilícitos; pessoas e animais; armas de fogo ou munições; materiais inflamáveis, tóxicos e/ou radioativos; drogas e entorpecentes; explosivos; joias de alto valor; elevadas quantias; e de quaisquer outros materiais cujo transporte seja proibido por lei.</p>

                <h2>14.6.</h2>
                <p>O usuário, por meio de sua aceitação aos presentes Termos, reconhece que ficará, a seu exclusivo critério: (i) a escolha do momento em que se conectará à Plataforma; (ii) o tempo em que ficará ativo (“online” ou “disponível”) na Plataforma; e (iii) o período, local e quantidade de acessos à Plataforma.</p>

                <h2>14.6.1.</h2>
                <p>O usuário reconhece que não existe qualquer participação e/ou ingerência da COPYWAVE TECNOLOGIA nas suas escolhas de utilização da Plataforma, podendo o usuário acessar e usufruir da Plataforma como melhor lhe couber, desde que respeitados os Termos aqui descritos.</p>

                <h2>14.7.</h2>
                <p>Ainda, são responsabilidades do usuário:</p>
                <ul>
                <li>a) defeitos ou vícios técnicos originados no próprio sistema do usuário;</li>
                <li>b) a correta utilização da plataforma, dos serviços ou produtos oferecidos, prezando pela boa convivência, pelo respeito e cordialidade entre os usuários;</li>
                <li>c) o cumprimento e respeito ao conjunto de regras disposto nesse Termo de Condições Geral de Uso, na respectiva Política de Privacidade e na legislação nacional e internacional;</li>
                <li>d) a proteção aos dados de acesso à sua conta/perfil (login e senha).</li>
                <li>e) os produtos publicados, apresentados e vendidos aos clientes finais.</li>
                <li>f) os conteúdos ou atividades ilícitas praticadas pelo usuário ou seu cliente final na plataforma.</li>
                <li>g) Os comentários ou informações realizadas por usuários são de inteira responsabilidade dos próprios usuários;</li>
                <li>h) A COPYWAVE TECNOLOGIA, suas filiais, afiliados, licenciantes, provedores de serviço, provedores de conteúdo, empregados, agentes, administradores e diretores não serão responsáveis por qualquer dano eventual, direto, indireto, punitivo, real, consequente, especial, exemplar ou de qualquer outro tipo, incluindo perda de receita ou renda, dor e sofrimento, estresse emocional ou similares mesmo que a empresa tenha aconselhado sobre a possibilidade de tais danos.</li>
                </ul>

                <h2>14.8.</h2>
                <p>É de responsabilidade da plataforma COPYWAVE TECNOLOGIA:</p>
                <ul>
                <li>a) indicar as características do serviço ou produto;</li>
                <li>b) os defeitos e vícios encontrados no serviço ou produto oferecido desde que lhe tenha dado causa;</li>
                <li>c) as informações que foram divulgadas pela plataforma.</li>
                <li>d) os conteúdos ou atividades ilícitas praticadas pela plataforma.</li>
                <li>e) manter o sistema sempre atualizado, e em caso de alguma manutenção de emergência, compromete-se com a usabilidade e segurança dos dados de todos os usuários.</li>
                <li>f) As informações prestadas pelos usuários à plataforma.</li>
                </ul>

                <h2>14.9.</h2>
                <p>A plataforma não se responsabiliza por links externos contidos em seu sistema que possam redirecionar o usuário ao ambiente externo a sua rede.</p>

                <h2>14.9.1.</h2>
                <p>Não poderão ser incluídos links externos ou páginas que sirvam para fins comerciais ou publicitários ou quaisquer informações
                <h2>Cláusula Quatorze – Da Responsabilidade do Usuário</h2>
                <p>14.9.1 Não poderão ser incluídos links externos ou páginas que sirvam para fins comerciais ou publicitários, ou quaisquer informações ilícitas, violentas, polêmicas, pornográficas, xenofóbicas, discriminatórias ou ofensivas.</p>
                <p>14.9.2 O usuário possui ciência de que a COPYWAVE TECNOLOGIA não garante que arquivos disponíveis para download da Internet estejam livres de vírus, worms, cavalos de Tróia ou outro código que possa manifestar propriedades contaminadoras ou destrutivas.</p>
                <p>14.9.3 O usuário é responsável por implementar procedimentos e checkpoints suficientes para satisfazer seus requisitos de segurança e por manter meios externos a este site para reconstrução de qualquer dado perdido.</p>
                <p>14.9.4 A COPYWAVE TECNOLOGIA não assume nenhuma responsabilidade ou risco pelo uso da internet.</p>

                <h2>CLÁUSULA DÉCIMA QUINTA - DOS DIREITOS AUTORAIS:</h2>
                <p>15.1 O presente Termo de Uso concede aos usuários uma licença não exclusiva, não transferível e não sublicenciável, para acessar e fazer uso da plataforma e dos serviços e produtos por ela disponibilizados.</p>
                <p>15.2 A estrutura do site ou aplicativo, as marcas, logotipos, nomes comerciais, layouts, gráficos e design de interface, imagens, ilustrações, fotografias, apresentações, vídeos, conteúdos escritos e de som e áudio, programas de computador, banco de dados, arquivos de transmissão e quaisquer outras informações e direitos de propriedade intelectual da razão social COPYWAVE TECNOLOGIA, observados os termos da Lei da Propriedade Industrial (Lei nº 9.279/96), Lei de Direitos Autorais (Lei nº 9.610/98) e Lei do Software (Lei nº 9.609/98), estão devidamente reservados.</p>
                <p>15.3 É proibido a cópia parcial ou total deste website e sistema, sujeito às penas da lei. Direitos autorais visual:</p>
                <ul>
                    <li>WEBSITE: não será permitido visualmente parecido com a nossa empresa como o logotipo, vídeo de vendas, script do vídeo de vendas, formatação visual e escrita dos planos ativos, frases e nomenclaturas da mesma ordem que está no site de vendas, cores e padrões idênticos ao nosso, textos do site, chamada para ação, nome de planos, qualquer imagem em png, jpeg e svg do nosso site é estritamente proibida o uso ou cópia, padronização ou associação de qualquer forma com nossa marca.</li>
                </ul>
                <p>15.4 O uso de qualquer item acima é exclusivo da COPYWAVE TECNOLOGIA.</p>
                <p>15.5 O usuário está expressamente proibido de publicar, incluindo material de propriedade de terceiros que:</p>
                <ul>
                    <li>Defenda atividade ilegal ou discutir a intenção de fazer algo ilegal;</li>
                    <li>Possa ameaçar ou insultar outros, difamar, caluniar, invadir privacidade, perseguir, ser obsceno, pornográfico, racista, assediar ou ofender;</li>
                    <li>Busque explorar ou prejudicar crianças expondo-as a conteúdo inapropriado, perguntar sobre informações pessoais ou qualquer outro do tipo;</li>
                    <li>Infrinja qualquer propriedade intelectual ou outro direito de pessoa ou entidade, incluindo violações de direitos autorais, marca registrada ou direitos de publicidade;</li>
                    <li>Violam qualquer lei ou podem ser considerados para violar a lei;</li>
                    <li>Personifique ou deturpar sua conexão com qualquer entidade ou pessoa; ou ainda manipula títulos ou identificadores para encobrir a origem do conteúdo;</li>
                    <li>Promova qualquer atividade ilegal;</li>
                    <li>Solicitar fundos, divulgações ou patrocinadores;</li>
                    <li>Inclua programas com vírus, worms e/ou Cavalos de Tróia ou qualquer outro código, arquivo ou programa de computador destinado a interromper, destruir ou limitar a funcionalidade de qualquer software ou hardware de computador ou telecomunicações;</li>
                    <li>Interrompa o fluxo normal da conversa, faça com que a tela “role” mais rápido que os outros usuários conseguem acompanhar ou mesmo agir de modo a afetar a habilidade de outras pessoas de se engajar em atividades em tempo real neste site;</li>
                    <li>Hospeda arquivos em qualquer formato que infrinjam os direitos autorais de alguma pessoa ou entidade;</li>
                    <li>Desobedeça a qualquer política ou regra estabelecida de tempos em tempos para o uso desse site ou qualquer rede conectada a ele;</li>
                    <li>Contenha links para sites que contenham conteúdo que se enquadrem nas descrições acima;</li>
                    <li>Utilize robots para inclusão de e-mails em massa utilizando as integrações com os serviços de e-mails disponíveis na COPYWAVE TECNOLOGIA.</li>
                </ul>
                <p>15.6 A COPYWAVE TECNOLOGIA reserva o direito de monitorar o uso deste site para determinar o cumprimento desse Termo de Uso assim como o de remover ou vetar qualquer informação por qualquer razão.</p>
                <p>15.7 O usuário é completamente responsável pelo conteúdo das suas páginas, imagens, arquivos e qualquer outro conteúdo, enviado, criado, e/ou vinculado pelo usuário na COPYWAVE TECNOLOGIA.</p>
                <p>15.8 O usuário concorda que nem a COPYWAVE TECNOLOGIA ou qualquer terceiro provendo conteúdo para a COPYWAVE TECNOLOGIA, assumirá qualquer responsabilidade por alguma ação ou omissão da COPYWAVE TECNOLOGIA ou referido terceiro a respeito de qualquer envio ou atividade sua.</p>
                <p>15.9 Proibições Adicionais: Além de todas as proibições acima, o usuário concorda que não utilizará conscientemente o Serviço, entre outras coisas, para:</p>
                <ul>
                    <li>Molestar menores de qualquer forma;</li>
                    <li>Representar ser qualquer pessoa ou entidade, ou declarar falsamente ou de outra forma deturpar sua afiliação com uma pessoa ou entidade;</li>
                    <li>Fazer upload, publicar, enviar por e-mail, transmitir ou de outra forma disponibilizar qualquer conteúdo que você não tem o direito de disponibilizar segundo qualquer lei ou relações contratuais ou fiduciárias (como informações privilegiadas, "proprietárias" e informações confidenciais recebidas ou divulgadas como parte das relações de trabalho ou segundo contratos de confidencialidade);</li>
                    <li>Fazer upload, postar, enviar por e-mail, transmitir ou de outra forma disponibilizar qualquer anúncio não solicitado ou autorizado, materiais promocionais, "lixo eletrônico", "spam", "correntes", "pirâmides" ou qualquer outra forma de solicitação;</li>
                    <li>"Realizar spam" para promover seu site ou o Conteúdo, ou envolver-se em marketing, anúncios ou qualquer outra prática não ética vinculada de qualquer forma a "spam" incluindo enviar conteúdo ou e-mails que não respeitem o CAN-SPAM Act de 2003;</li>
                    <li>Fazer upload, postar, enviar por e-mail, transmitir ou de outra forma disponibilizar qualquer material que contenha vírus de software ou qualquer outro código de computador, arquivos ou programas projetados para interromper, destruir ou limitar a funcionalidade de qualquer software ou hardware ou equipamentos de telecomunicações;</li>
                    <li>Violar, intencionalmente ou não, tentar violar ou evitar qualquer política ou norma aplicável da ICANN;</li>
                </ul>
                <p>15.10 A COPYWAVE TECNOLOGIA reserva-se o direito de investigar o usuário, a empresa e/ou seus proprietários, administradores, diretores, gerentes e outros dirigentes, seus sites e os materiais que compõem os sites a qualquer momento. Essas investigações serão realizadas exclusivamente para benefício da COPYWAVE TECNOLOGIA, e não para seu benefício ou de terceiros.</p>
                <p>§1º Se a investigação revelar qualquer informação, ato ou omissão, que, na opinião única da COPYWAVE TECNOLOGIA constituir uma violação de qualquer lei ou norma local, estadual, federal ou estrangeiro, ou estes Termos de Uso, a COPYWAVE TECNOLOGIA pode desligar imediatamente o local e notificá-lo da ação. Você concorda em renunciar a qualquer ação ou reivindicação que você possa ter contra a COPYWAVE TECNOLOGIA por essa ação.</p>
                <p>15.11 Este Termos de Uso não cede ou transfere ao usuário qualquer direito, de modo que o acesso não gera qualquer direito de propriedade intelectual ao usuário, exceto pela licença limitada ora concedida.</p>
                <p>15.12 O uso da plataforma pelo usuário é pessoal, individual e intransferível, sendo vedado qualquer uso não autorizado, comercial ou não-comercial. Tais usos consistirão em violação dos direitos de propriedade intelectual da razão social COPYWAVE TECNOLOGIA, puníveis nos termos da legislação aplicável.</p>
                <p>15.13 A COPYWAVE TECNOLOGIA se reserva o direito de cooperar totalmente com as autoridades competentes ou pedidos da justiça para que a COPYWAVE TECNOLOGIA revele a identidade de qualquer pessoa que publique e-mail, mensagem ou disponibilize qualquer material que possa violar esse Termo de Uso.</p>
                <h2>CLÁUSULA DÉCIMA SEXTA - DAS SANÇÕES:</h2>
                <p>16.1 Sem prejuízo das demais medidas legais cabíveis, a razão social COPYWAVE TECNOLOGIA poderá, a qualquer momento, advertir, suspender ou cancelar a conta do usuário:</p>
                <ul>
                    <li>a) que violar qualquer dispositivo do presente Termo;</li>
                    <li>b) que descumprir os seus deveres de usuário;</li>
                    <li>c) que tenha qualquer comportamento fraudulento, ilícito, doloso ou que ofenda a terceiros o nome da plataforma, seus colaboradores ou a terceiros;</li>
                    <li>d) que esteja inadimplente, ensejando o cancelamento do contrato automaticamente, com a exclusão da conta do usuário e todos os dados ali contidos.</li>
                </ul>
                <h2>CLÁUSULA DÉCIMA SÉTIMA - DA RESCISÃO:</h2>
                <p>17. A não observância das obrigações pactuadas neste Termo de Uso ou da legislação aplicável poderá, sem prévio aviso, ensejar a imediata rescisão unilateral por parte da razão social COPYWAVE TECNOLOGIA, e o bloqueio de todos os serviços prestados ao usuário.</p>
                <p>Na ocorrência de inadimplência do usuário e ausência de pagamento em até 3 dias úteis após o prazo indicado, o usuário poderá ter o seu acesso bloqueado e após isso poderão ser excluídas as páginas, domínios e todos os demais conteúdos, links, e recursos criados usando a plataforma.</p>
                <p>Na ocorrência de ilegalidades, desonra, calúnia, difamação ou injúria com a plataforma COPYWAVE TECNOLOGIA ou os colaboradores da Plataforma, ensejará a referida rescisão, sem prejuízo das perdas e danos e demais ações cabíveis.</p>
                <p>Na ocorrência de gravação interna do sistema da Plataforma de uma forma maliciosa, ensejará o cancelamento do contrato, sem prejuízo das demais ações cabíveis.</p>
                <h2>CLÁUSULA DÉCIMA OITAVA - DAS ALTERAÇÕES:</h2>
                <p>18.1 Os itens descritos no presente instrumento poderão sofrer alterações, unilateralmente e a qualquer tempo, por parte DA COPYWAVE TECNOLOGIA para adequar ou modificar os serviços, bem como para atender novas exigências legais.</p>
                <p>18.2 As alterações serão veiculadas pelo site ou aplicativo e o usuário poderá optar por aceitar o novo conteúdo ou por cancelar o uso dos serviços, caso seja assinante de algum serviço.</p>
                <p>18.3 Poderá ocorrer reajustes de preços anuais, com base no indexador do salário-mínimo nacional.</p>
                <p>18.4 Caso o usuário adicione módulos a sua assinatura, fica ciente que o pagamento da modalidade sempre será pré-pago.</p>
                <p>18.5 Em caso de alterações nos dados cadastrais como CPF ou CNPJ, será necessária a realização de um novo contrato com o termo aditivo.</p>
                <p>18.6 Os serviços oferecidos podem, a qualquer tempo e unilateralmente, e sem qualquer aviso prévio, ser deixados de fornecer, alterados em suas características, bem como restringido para o uso ou acesso, sendo o usuário notificado da referida modificação.</p>
                <h2>CLÁUSULA DÉCIMA NONA – DAS FALHAS NA PLATAFORMA:</h2>
                <p>19.1 A COPYWAVE TECNOLOGIA não será responsável por quaisquer danos, prejuízos ou perdas, de qualquer forma causados ao usuário ou ao cliente final, inclusive decorrentes de caso fortuito ou força maior, por falhas na Plataforma, no servidor, na internet e por quaisquer vírus, cavalos de Tróia, worms ou outras rotinas de programação de computador que possam danificar, interferir adversamente, que possam ser infiltrados no equipamento do usuário em decorrência do acesso ou como consequência da transferência de dados, arquivos, imagens, textos ou conteúdo de áudio contidos na Plataforma.</p>
                <p>Parágrafo único: A COPYWAVE TECNOLOGIA não será responsabilizada por qualquer atraso ou falha neste Website e/ou qualquer um dos Serviços e/ou informações no Site, direta ou indiretamente resultantes de, decorrentes de, relacionados ou em conexão com eventos que estão além do controle razoável da COPYWAVE TECNOLOGIA, incluindo, sem limitação, falhas na Internet, falhas em equipamentos, falhas de energia elétrica, greves, disputas trabalhistas, motins, rebeliões, desordem civil, falta de mão de obra ou de materiais, incêndios, inundações, tempestades, terremotos, explosões, guerra, terrorismo, ações governamentais, ordens de tribunais, agências ou tribunais ou não execução de terceiros. As disposições do presente parágrafo vêm em acréscimo a, e não se destinam a limitar ou modificar, o limite da seção de Limite de Responsabilidade, como estipulado acima.</p>
                <p>19.2 A COPYWAVE TECNOLOGIA não garante o acesso e uso contínuo e ininterrupto à Plataforma. O usuário reconhece e concorda que, eventualmente, a Plataforma poderá ficar indisponível por motivos técnicos ou qualquer outra circunstância alheia ao COPYWAVE TECNOLOGIA.</p>
                <h2>CLÁUSULA VIGÉSIMA - DA POLÍTICA DE PRIVACIDADE:</h2>
                <p>20.1 Além do presente Termo, o usuário deverá consentir com as disposições contidas na respectiva Política de Privacidade a ser apresentada a todos os interessados dentro da interface da plataforma.</p>
                <p>20.2 O sistema pode precisar da localização em tempo real do cliente com intuito de realizar todas as verificações internas. Além disso, serão necessários os dados como: nome completo, CPF, endereço, e-mail, telefone, senha e verificação de senha. Além dos Cookies para melhorias de usabilidade do cliente.</p>
                <p>20.3 Os dados financeiros serão guardados no sistema do mercado pago, juntamente com a segurança e responsabilidade do mesmo.</p>
                <p>20.4 A COPYWAVE TECNOLOGIA possui uma política expressa e específica sobre a privacidade dos dados pessoais dos usuários (a “Política de Privacidade”). Todas as informações dos usuários estão sujeitas ao tratamento descrito na referida Política de Privacidade.</p>
                <p>20.5 O usuário concorda expressamente que o uso da Plataforma implica na coleta e utilização de informações e dados sobre o usuário incluindo eventual transferência, armazenamento, processamento e utilização dos dados pela COPYWAVE TECNOLOGIA, seus controladores e demais empresas do grupo econômico, bem como para envio a autoridades competentes ou ainda para as demais finalidades previstas na Política de Privacidade.</p>
                <p>20.6 O usuário entende e concorda que a utilização da Plataforma implica na aceitação integral dos termos dispostos na Política de Privacidade, a qual poderá ser consultada em: copywave.io e constitui parte integrante destes Termos.</p>
                <p>20.7 Os relatórios de faturamento, dados financeiros, e quaisquer outros relatórios não serão divulgados a terceiros.</p>
                <p>20.8 Além disso, as imagens e vídeos utilizados para marketing da plataforma, terão a devida permissão de direito de imagem dos usuários.</p>
                <p>20.9 Para a segurança dos dados, estes são salvos em banco dados protegido.</p>
                <p>20.9.1 As senhas são criptografadas usando criptografia segura.</p>
                <p>20.9.2 A rotina de backup acontecerá a cada 24h e contemplará as configurações salvas no banco assim como arquivos enviados ao servidor.</p>
                <h2>CLÁUSULA VIGÉSIMA PRIMEIRA – DA CONFIDENCIALIDADE:</h2>
                <p>21.1 O usuário assume o compromisso de manter absoluto sigilo de todas e quaisquer informações e documentos da plataforma COPYWAVE TECNOLOGIA seja de natureza comercial, econômico-financeira, técnica, administrativa ou operacional, bem como quaisquer outras informações e documentos relativos a COPYWAVE TECNOLOGIA, às suas atividades e/ou aos Clientes Finais ficando proibido de divulgar, revelar, reproduzir ou de qualquer outra forma dispor, no todo ou em parte, das Informações Confidenciais e obrigado, portanto, a adotar todas as precauções convenientes, razoáveis e/ou necessárias a fim de proteger a integridade e a confidencialidade das Informações Confidenciais (o “Compromisso de Exclusividade”).</p>
                <p>21.2 O usuário reconhece e concorda que as Informações Confidenciais somente poderão ser utilizadas para finalidades decorrentes ou relacionadas à realização das atividades e em nenhuma hipótese para fins que sejam contrários aos interesses da COPYWAVE TECNOLOGIA, dos Estabelecimentos Parceiros ou dos Clientes Finais.</p>
                <h2>CLÁUSULA VIGÉSIMA TERCEIRA – DAS DISPOSIÇÕES GERAIS:</h2>
                <h2>CLÁUSULA VIGÉSIMA PRIMEIRA – DO COMPROMISSO DE CONFIDENCIALIDADE</h2>
                <p>21.3. O Compromisso de Confidencialidade não será exigível nos casos em que:</p>
                <ul>
                <li>(i) a revelação, divulgação e/ou reprodução das Informações Confidenciais forem devida e previamente autorizadas, por escrito, pelos titulares das informações em questão;</li>
                <li>(ii) as Informações Confidenciais tornarem-se disponíveis ao público em geral por qualquer meio que não o inadimplemento pelo usuário do Compromisso de Confidencialidade; ou</li>
                <li>(iii) a revelação, divulgação e/ou reprodução das Informações Confidenciais venham a ser exigidas por lei ou por autoridade competente, sob pena de ser caracterizada desobediência ou outra penalidade, caso em que o usuário compromete-se a comunicar a COPYWAVE TECNOLOGIA sobre a exigência formulada no prazo máximo de 48 (quarenta e oito) horas contados da data em que tomar conhecimento dela, e a revelar, divulgar e/ou reproduzir apenas as Informações Confidenciais ou sua parte que forem necessárias para satisfazer tal exigência.</li>
                </ul>

                <h2>CLÁUSULA VIGÉSIMA SEGUNDA – INEXISTÊNCIA DE VÍNCULO EMPREGATÍCIO</h2>
                <p>22.1. Como profissional independente e que se cadastra na Plataforma por sua livre e espontânea vontade, o usuário atesta que a Plataforma é uma mera ferramenta, não sendo essencial para o desenvolvimento de suas atividades econômicas e que não há qualquer relação hierárquica, de dependência, subordinação ou trabalhista entre o usuário e a COPYWAVE TECNOLOGIA, podendo o usuário desempenhar as Atividades de Entrega livremente e sem ingerência, inclusive para outras empresas do mercado e, até mesmo, de forma simultânea para concorrentes da COPYWAVE TECNOLOGIA, não havendo qualquer obrigação de exclusividade e/ou de continuidade do usuário.</p>
                <p>22.2. Ambas as Partes têm total ciência de que a relação entre elas não possui nenhuma das características previstas em lei para reconhecimento do vínculo empregatício, tratando-se de relação estritamente cível e comercial, conforme a conveniência do usuário com relação ao aceite e à realização das atividades.</p>
                <p>22.3. As Partes são autônomas e independentes entre si e cada uma é inteiramente responsável pelos seus custos operacionais, despesas, taxas, contribuições e tributos relativos à manutenção de suas atividades.</p>

                <h2>CLÁUSULA VIGÉSIMA TERCEIRA – DAS DISPOSIÇÕES GERAIS</h2>
                <p>23.1. Modificação ou Descontinuidade da Plataforma: Independentemente de qualquer aviso ou notificação prévia ao usuário, a COPYWAVE TECNOLOGIA poderá, a seu exclusivo critério, modificar, suspender ou descontinuar a Plataforma, a qualquer tempo e por qualquer motivo, não tendo o usuário direito a qualquer indenização ou compensação.</p>
                <p>23.2. Proibição de Cessão: Os direitos e as obrigações do usuário previstos nestes Termos não poderão ser cedidos ou de qualquer outra forma transferidos, no todo em parte, a quaisquer terceiros.</p>
                <p>23.3. Tolerância: A eventual tolerância por qualquer das Partes quanto ao inexato ou impontual cumprimento das obrigações da outra Parte dispostos nestes Termos valerá tão somente de forma isolada, não constituindo renúncia ou novação de qualquer espécie.</p>
                <p>23.4. Nulidade ou Ineficácia: Caso qualquer disposição destes Termos se torne nula ou ineficaz, a validade ou eficácia das disposições restantes não será afetada, permanecendo em pleno vigor e efeito.</p>
                <p>23.5. Alteração destes Termos: O usuário reconhece e concorda que a COPYWAVE TECNOLOGIA poderá alterar estes Termos a qualquer tempo, mediante o envio de notificação escrita ao usuário, por meio da Plataforma, com antecedência mínima de 30 (trinta) dias contados da data de entrada em vigor da nova versão deste instrumento.</p>

                <h2>CLÁUSULA VIGÉSIMA QUARTA</h2>
                <p>24.1. Teste beta: o Site está atualmente em sua versão BETA e em fase de testes BETA. O usuário compreende e concorda que os Serviços oferecidos pela COPYWAVE TECNOLOGIA ainda podem conter bugs de software, sofrer interrupções e não funcionar como pretendido ou da forma designada.</p>
                <p>24.2. O uso que você fizer dos Serviços, nesta fase, requer compreensão e concordância em participar dos testes BETA do Serviço.</p>

                <h2>CLÁUSULA VIGÉSIMA QUINTA - DO FORO</h2>
                <p>25.1. Para a solução de controvérsias decorrentes do presente instrumento será aplicado integralmente o Direito brasileiro.</p>
                <p>25.2. Os eventuais litígios deverão ser apresentados no foro da comarca de Balneário Camboriú - SC.</p>
                <p>O usuário declara ter lido e expressamente concordar, sem quaisquer reservas ou ressalvas, com os presentes termos.</p>
                <p>O usuário reconhece e concorda que a sua concordância integral com os termos é condição essencial para a utilização da plataforma COPYWAVE TECNOLOGIA.</p>
                <p>Fortaleza, 02 de fevereiro de 2025.</p>
                <p>COPYWAVE TECNOLOGIA</p>
                <p>CNPJ 58.954.044/0001-3</p>


            </div>  
        </div>
    </div>
</section>

<footer class="bg-white dark:bg-gray-800">
	<div class="max-w-screen-xl p-4 py-6 mx-auto lg:py-16 md:p-8 lg:p-10">
		<div class="grid grid-cols-2 gap-8 md:grid-cols-3 lg:grid-cols-5">
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class=" hover:underline">About</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Careers</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Brand Center</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Blog</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Help center</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class="hover:underline">Discord Server</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Twitter</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Facebook
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Contact Us</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="/privacidade" class="hover:underline">Politica de privacidade</a>
					</li>
					<li class="mb-4">
						<a href="/cookies" class="hover:underline">Cookies</a>
					</li>
					<li class="mb-4">
						<a href="/termos" class="hover:underline">Termos</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class=" hover:underline">About</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Careers</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Brand Center</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Blog</a>
					</li>
				</ul>
			</div>
			<div>
				<h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Download</h3>
				<ul class="text-gray-500 dark:text-gray-400">
					<li class="mb-4">
						<a href="#" class="hover:underline">iOS</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Android</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">Windows</a>
					</li>
					<li class="mb-4">
						<a href="#" class="hover:underline">MacOS</a>
					</li>
				</ul>
			</div>
		</div>
		<hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
		<div class="text-center">
			<a href="#"
				class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
				<img src="https://demo.themesberg.com/landwind/images/logo.svg" class="h-6 mr-3 sm:h-9" alt="Landwind Logo" />
Landwind
</a>
				<span class="block text-sm text-center text-gray-500 dark:text-gray-400">© 2021-2022 Landwind™. All Rights Reserved. Built with <a href="#" target="_blank" class="text-purple-600 hover:underline dark:text-purple-500">Flowbite</a> and <a href="#" target="_blank" class="text-purple-600 hover:underline dark:text-purple-500">Tailwind CSS</a>.
</span>
				<ul class="flex justify-center mt-5 space-x-5">
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path
									d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
								</svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
					<li>
						<a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
							<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
								<path fill-rule="evenodd"
									d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
									clip-rule="evenodd" /></svg>
						</a>
					</li>
				</ul>
		</div>
	</div>
</footer>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto text-center">
      <p class="mb-4">© 2024 CopyWave. Todos os direitos reservados.</p>
      <div class="flex justify-center space-x-4">
        <a href="/termos" class="hover:text-[#CC54F4] transition">Termos de Uso</a>
        <a href="/privacidade" class="hover:text-[#CC54F4] transition">Política de Privacidade</a>
      </div>
    </div>
  </footer>

  <script>
    // Menu Mobile Toggle
    document.getElementById('hamburger').addEventListener('click', function() {
      const mobileMenu = document.getElementById('mobileMenu');
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>