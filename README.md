<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Sistema de Gestão de Finanças e Membros da Igreja

## Sobre o Projeto

Este é um sistema de **gestão de finanças e membros para igrejas**, desenvolvido para facilitar o acompanhamento financeiro e a organização dos dados da congregação. Construído com **Laravel 11** e **Tailwind CSS**, o sistema oferece uma interface amigável, responsiva e eficiente para o gerenciamento administrativo.

## Funcionalidades

- **Gestão Financeira**  
  - Registro e acompanhamento de doações e dízimos.  
  - Controle de despesas e relatórios financeiros.  
  - Análise detalhada das finanças da igreja.  

- **Gestão de Membros**  
  - Cadastro de membros com informações detalhadas.  
  - Organização por grupos, ministérios e funções específicas.  
  - Histórico de participação em eventos e contribuições.  

- **Outras Funcionalidades**  
  - Criação e gestão de eventos e atividades.  
  - Sistema de autenticação e controle de acesso.  

## Tecnologias Utilizadas

- **Framework:** Laravel 11  
- **Frontend:** Tailwind CSS  
- **Banco de Dados:** MySQL  
- **Gerenciador de Pacotes:** Composer  

## Requisitos de Instalação

1. Certifique-se de que os seguintes requisitos estão instalados no servidor:  
   - PHP 8.2 ou superior  
   - Composer  
   - MySQL  
   - Node.js e npm (para o Vite)  

2. Clone o repositório:  
   ```bash
   git clone https://github.com/seuusuario/seurepositorio.git
   cd seurepositorio

3. Instale as dependências:  
   ```bash
   composer install
   npm install
   npm run build

4. Configure o arquivo .env:

5. Execute as migrações:
php artisan migrate --seed

6. Inicie o servidor local.
php artisan serve
