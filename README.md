# API JWT Laravel SaaS para Gestão de Clínicas

Projeto backend em Laravel que oferece uma API JWT para um SaaS de gestão de clínicas. O foco é suportar autenticação, multi-tenancy de clínicas/unidades, usuários, pacientes, endereços e operações administrativas para um sistema de saúde.

## Funcionalidades principais

- Autenticação via JWT para API segura.
- Gerenciamento de usuários.
- Suporte a múltiplas clínicas/tenants.
- Cadastro e gerenciamento de pacientes.
- Gerenciamento de endereços de pacientes.
- Estrutura de API RESTful para integração com apps web ou mobile.

## Bibliotecas instaladas e utilizadas

Este projeto utiliza principalmente:

- `laravel/framework` — base do framework Laravel.
- `phpunit/phpunit` — testes automatizados.
- `guzzlehttp/guzzle` — cliente HTTP para serviços externos.
- `fakerphp/faker` — geração de dados falsos para testes e seeders.
- `fruitcake/laravel-cors` — suporte a CORS em API.
- `php-open-source-saver/jwt-auth` — pacote para JWT.

> Observação: as versões exatas e dependências completas estão definidas em `composer.json`.

## Requisitos

- PHP 8.3+ ou superior
- Composer
- Servidor web compatível com Laravel ou PHP embutido
- Banco de dados MySQL/MariaDB ou outro suportado pelo Laravel

## Instalação e execução local

1. Clone o repositório:

```bash
git clone https://github.com/valdijr-web/api-jwt.git
cd api-jwt
```

2. Instale as dependências PHP:

```bash
composer install
```

3. Copie o arquivo de ambiente e ajuste as variáveis:

```bash
cp .env.example .env
```

Edite `.env` com as configurações de banco de dados e JWT:

- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `JWT_SECRET` ou outra chave/token configurada no pacote JWT

4. Gere a chave da aplicação:

```bash
php artisan key:generate
```

5. Execute as migrations e seeders:

```bash
php artisan migrate
php artisan db:seed
```

6. Inicie o servidor de desenvolvimento:

```bash
php artisan serve
```

A API ficará disponível em `http://127.0.0.1:8000`.

## Endpoints básicos

- `POST /api/auth/login` — autenticação de usuário.
- `POST /api/auth/register` — cadastro de usuário (quando disponível).
- `GET /api/patients` — listagem de pacientes.
- `POST /api/patients` — criação de paciente.
- `GET /api/tenants` — listagem de clínicas/tenants.

> Consulte o código em `routes/api.php` para ver todos os endpoints disponíveis.

## Testes

Execute os testes com:

```bash
php artisan test
```

## Estrutura do projeto

- `app/Http/Controllers` — controladores da API.
- `app/Models` — modelos Eloquent.
- `app/Actions` — ações de domínio e regras de negócio.
- `app/Services` — serviços e integrações externas.
- `database/migrations` — migrações de banco de dados.
- `database/factories` — factories para testes.
- `database/seeders` — seeders iniciais.
- `routes/api.php` — rotas da API.

## Observações

Este projeto é uma base para um backend SaaS de gestão de clínicas. Ele deve ser estendido com controle de permissões, validação de dados, testes adicionais e documentação de API para uso em produção.
