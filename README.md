# Viagem Corporativa

Uma aplicação de pedidos de viagem desenvolvida com Laravel (backend) e VueJS (frontend), utilizando práticas modernas de desenvolvimento.

## 📋 Visão Geral

Viagem Corporativa é um sistema que permite aos usuários gerenciar seus pedidos de viagem através de uma interface intuitiva. O projeto foi desenvolvido seguindo princípios de MVC e Segurança.

### 🚀 Principais Funcionalidades

- **Autenticação Segura**: Login e logout de usuários via token JWT
- **Gerenciamento de Pedidos de viagem**: Visualização, criação e detalhes de pedidos de viagem

## 🛠️ Tecnologias Utilizadas

### Backend
- **PHP 8.3+**: Linguagem base do backend
- **Laravel 12**: Framework PHP para desenvolvimento rápido e seguro
- **MySQL**: Banco de dados relacional para armazenamento persistente

### Frontend
- **TypeScript**: Linguagem fortemente tipada para desenvolvimento frontend.
- **VueJS 3.5**: Framework para construção de interfaces modernas e reativas.
- **SPA**: Navegação de página única.
- **HTML5/TailwindCss**: Estruturação e estilização da interface.

### DevOps & Infraestrutura
- **Docker & Docker Compose**: Containerização e orquestração de serviços

### Práticas de Desenvolvimento
- **Feedback**: Feedback visual no frontend.
- **Requisições**: Requisições desacopladas com services.
- **Validações**: Validação de formulários no frontend.

## 🏗️ Arquitetura

O projeto segue a arquitetura:

### Backend (Laravel)
- **Camada de domínio**: Entidades como Pedido, Usuario, Papel, além de suas regras de negócio.
- **Camada de aplicação**: Contém os casos de uso e orquestração dos fluxos entre o domínio e a infraestrutura (criação, aprovação ou cancelamento de pedidos).
- **Camada de infraestrutura**: Persistência com Eloquent ORM; Middleware para autenticação (JwtMiddleware) e JSON (ApiMiddleware).
- **Camada de apresentação**: Controllers que expõem rotas REST (PedidoController e AuthController); Transformações de dados para o frontend (JSON responses).

### Frontend (Angular)
- **Core**: Serviços compartilhados, interceptadores de token JWT e guards de autenticação.
- **Componentes**: Componentes reútilizaveis.
- **Funcionalidades isoladas**: Pages e views.
- **Services**: Camada de abstração para chamadas à API.
- **Estado**: Estado reativo é gerenciado com (Vue Composition API).

## 🚀 Instalação e Execução

### Pré-requisitos
- Git
- Docker e Docker Compose instalados

### Passos para Instalação

1. Clone o repositório via HTTPS:
   ```bash
   git clone https://github.com/lucmorais/viagem-corporativa.git
   cd viagem-corporativa
   ```

2. Inicie os containers com Docker Compose:
   ```bash
   docker-compose up -d --build
   ```

3. O sistema estará disponível nos seguintes endereços:
   - **Frontend**: http://localhost:5173
   - **Backend API**: http://localhost:8000

### Configuração Inicial

O sistema já vem pré-configurado para desenvolvimento, com:
- Migrations e seeds automáticos para o banco de dados
- Usuários padrão criados (usuario: usuario.teste, senha: senha123), (usuario: admin.teste, senha: senha123)

Principais endpoints:
- **Autenticação**: `/login`, `/user`, `/logout`
- **Pedidos**: `/pedido`, `/pedido/{id}`, `/pedido/filtrar`

## 🔒 Segurança

O sistema implementa algumas camadas de segurança:
- Autenticação JWT no backend e interceptada no frontend.
- Proteção contra CSRF