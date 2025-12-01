# Documentação da API - IzusPay

## Índice

1. [Introdução](#introdução)
2. [Autenticação](#autenticação)
3. [Base URL](#base-url)
4. [Endpoints Públicos](#endpoints-públicos)
5. [Endpoints Protegidos](#endpoints-protegidos)
6. [Webhooks](#webhooks)
7. [Códigos de Status HTTP](#códigos-de-status-http)
8. [Tratamento de Erros](#tratamento-de-erros)

---

## Introdução

A API do IzusPay permite que você integre pagamentos PIX em sua aplicação. Esta documentação descreve todos os endpoints disponíveis, seus parâmetros, respostas e exemplos de uso.

### Características Principais

- Criação de transações de pagamento PIX
- Consulta de status de transações
- Webhooks para notificações de pagamento
- Integração com múltiplos gateways de pagamento (Goat Payments, WiteTec)

---

## Autenticação

A API utiliza autenticação via **Bearer Token**. Para acessar os endpoints protegidos, você precisa incluir seu token de API no cabeçalho da requisição.

### Como obter seu token de API

1. Acesse as configurações da sua associação no painel administrativo
2. Gere ou visualize sua chave de API
3. Use este token para autenticar suas requisições

### Formato de Autenticação

```
Authorization: Bearer {seu_token_aqui}
```

### Exemplo de Requisição Autenticada

```bash
curl -X GET "https://seu-dominio.com/api/transactions/abc123" \
  -H "Authorization: Bearer seu_token_aqui" \
  -H "Content-Type: application/json"
```

---

## Base URL

```
https://seu-dominio.com/api
```

**Nota:** Substitua `seu-dominio.com` pela URL base da sua aplicação.

---

## Endpoints Públicos

### 1. Criar Transação PIX (Goat Payments)

Cria uma nova transação PIX para um plano.

**Endpoint:** `POST /goat-payments/create-pix-transaction`

**Autenticação:** Não requerida

**Parâmetros da Requisição:**

| Parâmetro | Tipo | Obrigatório | Descrição |
|-----------|------|-------------|-----------|
| `plan_id` | integer | Sim | ID do plano |
| `name` | string | Sim | Nome do cliente |
| `email` | string | Sim | Email do cliente |
| `telefone` | string | Sim | Telefone do cliente |
| `cpf` | string | Sim | CPF do cliente |
| `password` | string | Sim | Senha do cliente |
| `utm_source` | string | Não | Parâmetro UTM source |
| `utm_medium` | string | Não | Parâmetro UTM medium |
| `utm_campaign` | string | Não | Parâmetro UTM campaign |
| `utm_term` | string | Não | Parâmetro UTM term |
| `utm_content` | string | Não | Parâmetro UTM content |

**Exemplo de Requisição:**

```json
{
  "plan_id": 1,
  "name": "João Silva",
  "email": "joao@example.com",
  "telefone": "11999999999",
  "cpf": "12345678900",
  "password": "senha123",
  "utm_source": "google",
  "utm_medium": "cpc"
}
```

**Exemplo de Resposta (Sucesso - 200):**

```json
{
  "hash": "abc123def456",
  "amount": 9900,
  "payment_method": "pix",
  "status": "awaiting_payment",
  "pix_qr_code": "00020126580014br.gov.bcb.pix...",
  "pix_copy_paste": "00020126580014br.gov.bcb.pix..."
}
```

**Exemplo de Resposta (Erro - 404):**

```json
{
  "error": "Plano não encontrado."
}
```

---

### 2. Verificar Status de Transação (Goat Payments)

Verifica o status de uma transação PIX na Goat Payments.

**Endpoint:** `GET /goat-payments/check-transaction-status`

**Autenticação:** Não requerida

**Parâmetros da Query:**

| Parâmetro | Tipo | Obrigatório | Descrição |
|-----------|------|-------------|-----------|
| `transaction_hash` | string | Sim | Hash da transação |

**Exemplo de Requisição:**

```bash
GET /goat-payments/check-transaction-status?transaction_hash=abc123def456
```

**Exemplo de Resposta (Pagamento Confirmado - 200):**

```json
{
  "status": "paid",
  "message": "Pagamento confirmado e processado com sucesso."
}
```

**Exemplo de Resposta (Aguardando Pagamento - 200):**

```json
{
  "status": "awaiting_payment"
}
```

**Exemplo de Resposta (Erro - 404):**

```json
{
  "error": "Venda não encontrada para este transaction_hash."
}
```

---

### 3. Verificar Status de Transação (WiteTec)

Verifica o status de uma transação PIX na WiteTec.

**Endpoint:** `GET /goat-payments/check-transaction-status`

**Autenticação:** Não requerida

**Parâmetros da Query:**

| Parâmetro | Tipo | Obrigatório | Descrição |
|-----------|------|-------------|-----------|
| `transaction_hash` | string | Sim | Hash da transação |

**Exemplo de Requisição:**

```bash
GET /goat-payments/check-transaction-status?transaction_hash=abc123def456
```

**Exemplo de Resposta (Pagamento Confirmado - 200):**

```json
{
  "status": "paid",
  "redirect_url": "https://example.com/success"
}
```

**Exemplo de Resposta (Aguardando Pagamento - 200):**

```json
{
  "status": "awaiting_payment"
}
```

---

## Endpoints Protegidos

Todos os endpoints abaixo requerem autenticação via Bearer Token.

### 1. Criar Transação de Pagamento

Cria uma nova transação de pagamento para um produto.

**Endpoint:** `POST /transactions`

**Autenticação:** Requerida (Bearer Token)

**Parâmetros da Requisição:**

| Parâmetro | Tipo | Obrigatório | Descrição |
|-----------|------|-------------|-----------|
| `product_hash_id` | string | Sim | Hash ID do produto |
| `customer` | object | Sim | Dados do cliente |
| `customer.name` | string | Sim | Nome do cliente (máx. 255 caracteres) |
| `customer.email` | string | Sim | Email do cliente (máx. 255 caracteres) |
| `customer.phone` | string | Sim | Telefone do cliente (máx. 20 caracteres) |
| `customer.document` | string | Sim | Documento do cliente (máx. 20 caracteres) |

**Exemplo de Requisição:**

```json
{
  "product_hash_id": "abc123def456",
  "customer": {
    "name": "Maria Santos",
    "email": "maria@example.com",
    "phone": "11988888888",
    "document": "98765432100"
  }
}
```

**Exemplo de Resposta (Sucesso - 200):**

```json
{
  "success": true,
  "message": "Transação iniciada com sucesso!",
  "transaction_id": "xyz789abc123",
  "pix_copy_paste": "00020126580014br.gov.bcb.pix...",
  "product_name": "Produto Premium",
  "total_price": 99.90
}
```

**Exemplo de Resposta (Erro - 403):**

```json
{
  "success": false,
  "message": "Produto não encontrado ou não pertence a você."
}
```

**Exemplo de Resposta (Erro - 422 - Validação):**

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "product_hash_id": ["The product hash id field is required."],
    "customer.email": ["The customer.email must be a valid email address."]
  }
}
```

---

### 2. Consultar Transação

Consulta os detalhes de uma transação específica.

**Endpoint:** `GET /transactions/{transactionId}`

**Autenticação:** Requerida (Bearer Token)

**Parâmetros da URL:**

| Parâmetro | Tipo | Obrigatório | Descrição |
|-----------|------|-------------|-----------|
| `transactionId` | string | Sim | ID da transação (hash) |

**Exemplo de Requisição:**

```bash
GET /transactions/xyz789abc123
Authorization: Bearer seu_token_aqui
```

**Exemplo de Resposta (Sucesso - 200):**

```json
{
  "success": true,
  "transaction_id": "xyz789abc123",
  "status": "paid",
  "created_at": "2024-01-15T10:30:00Z",
  "updated_at": "2024-01-15T10:35:00Z",
  "product": {
    "name": "Produto Premium"
  },
  "customer": {
    "name": "Maria Santos",
    "email": "maria@example.com"
  },
  "total_price": 99.90
}
```

**Possíveis Valores de Status:**

- `awaiting_payment` - Aguardando pagamento
- `paid` - Pago
- `expired` - Expirado
- `cancelled` - Cancelado

**Exemplo de Resposta (Erro - 404):**

```json
{
  "success": false,
  "message": "Transação não encontrada ou não pertence a você."
}
```

---

## Webhooks

Os webhooks permitem que você receba notificações em tempo real sobre eventos de pagamento.

### 1. Webhook Goat Payments (Postback)

Endpoint para receber notificações de pagamento da Goat Payments.

**Endpoint:** `POST /goat-payments/postback`

**Autenticação:** Não requerida (chamado pela Goat Payments)

**Parâmetros da Requisição:**

| Parâmetro | Tipo | Obrigatório | Descrição |
|-----------|------|-------------|-----------|
| `transaction_hash` | string | Sim | Hash da transação |
| `payment_status` | string | Sim | Status do pagamento |

**Exemplo de Payload Recebido:**

```json
{
  "transaction_hash": "abc123def456",
  "payment_status": "paid"
}
```

**Resposta:**

- `200 OK` - Webhook processado com sucesso
- `400 Bad Request` - Parâmetros faltando
- `404 Not Found` - Transação não encontrada
- `500 Internal Server Error` - Erro ao processar

---

### 2. Webhook WiteTec (Postback)

Endpoint para receber notificações de pagamento da WiteTec.

**Endpoint:** `POST /witetec/postback`

**Autenticação:** Não requerida (chamado pela WiteTec)

**Parâmetros da Requisição:**

| Parâmetro | Tipo | Obrigatório | Descrição |
|-----------|------|-------------|-----------|
| `eventType` | string | Sim | Tipo do evento |
| `id` | string | Sim | ID da transação |

**Tipos de Evento:**

- `TRANSACTION_PAID` - Transação paga
- `TRANSACTION_PENDING` - Transação pendente
- `TRANSACTION_CANCELED` - Transação cancelada

**Exemplo de Payload Recebido:**

```json
{
  "eventType": "TRANSACTION_PAID",
  "id": "abc123def456"
}
```

**Resposta:**

- `200 OK` - Webhook processado com sucesso

---

### 3. Webhook Cakto

Endpoint para receber notificações de pagamento da Cakto.

**Endpoint:** `POST /webhook-cakto`

**Autenticação:** Não requerida

**Exemplo de Payload Recebido:**

```json
{
  "event": "purchase_approved",
  "data": {
    "customer": {
      "email": "cliente@example.com"
    },
    "offer": {
      "id": 1,
      "price": 99.90
    },
    "paymentMethodName": "pix"
  }
}
```

**Resposta:**

```json
{
  "message": "Webhook received"
}
```

---

### 4. Webhook Kiwify

Endpoint para receber notificações de pagamento da Kiwify.

**Endpoint:** `POST /webhook-kiwify`

**Autenticação:** Não requerida

**Exemplo de Payload Recebido:**

```json
{
  "order_status": "paid",
  "Customer": {
    "email": "cliente@example.com",
    "full_name": "João Silva"
  },
  "payment_method": "pix"
}
```

**Resposta:**

```json
{
  "message": "Webhook received"
}
```

---

## Códigos de Status HTTP

A API utiliza os seguintes códigos de status HTTP:

| Código | Descrição | Quando é retornado |
|--------|-----------|-------------------|
| `200` | OK | Requisição bem-sucedida |
| `201` | Created | Recurso criado com sucesso |
| `400` | Bad Request | Requisição inválida |
| `401` | Unauthorized | Token de autenticação inválido ou ausente |
| `403` | Forbidden | Acesso negado (recurso não pertence ao usuário) |
| `404` | Not Found | Recurso não encontrado |
| `422` | Unprocessable Entity | Erro de validação |
| `500` | Internal Server Error | Erro interno do servidor |

---

## Tratamento de Erros

### Formato Padrão de Erro

Todas as respostas de erro seguem um formato consistente:

```json
{
  "success": false,
  "message": "Descrição do erro",
  "errors": {
    "campo": ["Mensagem de erro específica"]
  }
}
```

### Exemplos de Erros

#### Erro de Autenticação (401)

```json
{
  "message": "Token de autenticação não fornecido."
}
```

ou

```json
{
  "message": "Não autorizado. Token inválido ou usuário inativo."
}
```

#### Erro de Validação (422)

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "product_hash_id": [
      "The product hash id field is required."
    ],
    "customer.email": [
      "The customer.email must be a valid email address.",
      "The customer.email field is required."
    ]
  }
}
```

#### Erro Interno (500)

```json
{
  "success": false,
  "message": "Ocorreu um erro interno ao processar sua solicitação."
}
```

---

## Exemplos de Integração

### Exemplo em cURL

#### Criar Transação

```bash
curl -X POST "https://seu-dominio.com/api/transactions" \
  -H "Authorization: Bearer seu_token_aqui" \
  -H "Content-Type: application/json" \
  -d '{
    "product_hash_id": "abc123def456",
    "customer": {
      "name": "João Silva",
      "email": "joao@example.com",
      "phone": "11999999999",
      "document": "12345678900"
    }
  }'
```

#### Consultar Transação

```bash
curl -X GET "https://seu-dominio.com/api/transactions/xyz789abc123" \
  -H "Authorization: Bearer seu_token_aqui" \
  -H "Content-Type: application/json"
```

### Exemplo em JavaScript (Fetch API)

#### Criar Transação

```javascript
const response = await fetch('https://seu-dominio.com/api/transactions', {
  method: 'POST',
  headers: {
    'Authorization': 'Bearer seu_token_aqui',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    product_hash_id: 'abc123def456',
    customer: {
      name: 'João Silva',
      email: 'joao@example.com',
      phone: '11999999999',
      document: '12345678900'
    }
  })
});

const data = await response.json();
console.log(data);
```

#### Consultar Transação

```javascript
const response = await fetch('https://seu-dominio.com/api/transactions/xyz789abc123', {
  method: 'GET',
  headers: {
    'Authorization': 'Bearer seu_token_aqui',
    'Content-Type': 'application/json'
  }
});

const data = await response.json();
console.log(data);
```

### Exemplo em PHP (Guzzle)

#### Criar Transação

```php
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://seu-dominio.com/api',
    'headers' => [
        'Authorization' => 'Bearer seu_token_aqui',
        'Content-Type' => 'application/json'
    ]
]);

$response = $client->post('/transactions', [
    'json' => [
        'product_hash_id' => 'abc123def456',
        'customer' => [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'phone' => '11999999999',
            'document' => '12345678900'
        ]
    ]
]);

$data = json_decode($response->getBody(), true);
```

---

## Limites e Rate Limiting

Atualmente, a API não possui limites de taxa (rate limiting) configurados. No entanto, recomenda-se:

- Não fazer mais de 100 requisições por minuto por token
- Implementar retry com backoff exponencial em caso de erro 500
- Cachear respostas de consulta de transação quando apropriado

---

## Suporte

Para suporte técnico ou dúvidas sobre a API, entre em contato através do painel administrativo ou consulte a documentação adicional no repositório do projeto.

---

## Changelog

### Versão 1.0.0 (2024-01-15)
- Versão inicial da documentação
- Endpoints de criação e consulta de transações
- Suporte a webhooks de múltiplos gateways
- Autenticação via Bearer Token

---

**Última atualização:** 2024-01-15

