# Funcionamento do Sistema de Locadora de Roupas com PHP e Bootstrap

Este documento descreve o funcionamento do sistema de locadora de Roupas desenvolvido em PHP, utilizando o Bootstrap para a interface, com autenticação de usuários, gerenciamento de Roupas (carros e motos) e persistência de dados em arquivos JSON. O foco principal é explicar o funcionamento geral do sistema, com ênfase especial nos perfis de acesso (admin e usuário).

## 1. Visão Geral do Sistema

O sistema de Locadora de Roupas é uma aplicação web que permite:
- Autenticação de usuário com dois perfis: **admin** (administrador) e **usuário**;
- Gerenciamento de Roupas: cadastro, aluguel, devolução e exclusão;
- Cálculo de previsão de aluguel: com base no tipo de Roupa (carro ou moto) e número de dias;
- Interface responsiva.

Os dados armazenados em dois arquivos JSON:
- `usuarios.json`: username, senha criptografada e perfil
- `veiculos.json`: tipo, nome, placa, status de disponibilidade

## 2. Estrutura do Sistema
O sistema utiliza:
- **PHP**: para a lógica
- **Bootstrap**: para a estilização
- **Bootstrap Icons**: para os ícones da interface
- **Composer**: para autoloading de classes
- **JSON**: para persistência de dados

### 2.1 Componentes principais
- **Interfaces**: Define a interface `Locavel` para Roupas e utiliza os métodos `alugar()`, `devolver()` e `isDisponivel()`.
- **Models**: Classes `Veiculo` (abstrata), `Carro` e `Moto` para os Roupas, com cálculo de aluguel baseado em diárias constantes (`DIARIA_CARRO` e `DIARIA_MOTO`).
- **Services**: Classes `AUTH` (autenticação e gerenciamento de usuários) e `Locadora`(gerenciamento dos Roupas).
- **Views**: Template principal `template.php` para renderizar a interface e `login.php` para a autenticação.
- **Controllers**: Lógica em `index.php` para processar requisições e carregar o template.