# Sistema de Eventos - PHP

## Descrição
Este é um sistema desenvolvido em PHP para gerenciar eventos, com funcionalidades que permitem a criação, listagem, atualização e exclusão de eventos. O sistema segue padrões de arquitetura organizados com PSR-4, utilizando o composer para autoload.

---

## Funcionalidades
- Criar novos eventos.
- Listar eventos cadastrados.
- Atualizar informações de eventos existentes.
- Excluir eventos (soft delete).

---

## Tecnologias Utilizadas
- **PHP**: Linguagem principal.
- **Composer**: Gerenciamento de dependências e autoload.
- **PDO**: Conexão segura com banco de dados.
- **MySQL**: Banco de dados utilizado.
- **JavaScript (Fetch API)**: Requisições para comunicação com a API.

---

## Requisitos
1. **PHP >= 8.0**
2. **Composer instalado**
3. **MySQL ou outro banco compatível com PDO**

---

## Instalação

### 1. Clonar o Repositório
```bash
git clone https://github.com/tarcisiosilva/api-sistema-eventos.git
cd api-sistema-eventos
```

### 2. Instalar Dependências
```bash
composer install
```

### 3. Configurar o Banco de Dados
- Crie um banco de dados no MySQL.
- Configure as credenciais no arquivo `config/Database.php`.

```php
class Database {
    private $host = "localhost";
    private $db_name = "seu_banco";
    private $username = "seu_usuario";
    private $password = "sua_senha";
    // ...
}
```

### 4. Importar a Estrutura do Banco
Execute o script SQL localizado em `db/schema.sql` para criar as tabelas necessárias:
```bash
mysql -u seu_usuario -p seu_banco < db/schema.sql
```

---

## Uso
### Iniciar o Servidor
Utilize o servidor embutido do PHP para testes locais:
```bash
php -S localhost:8000 -t public
```

### Endpoints Disponíveis

#### POST `/`
**Criar um evento**
```json
{
  "titulo": "Nome do Evento",
  "descricao": "Detalhes do evento",
  "data_inicio": "2024-12-22 12:00",
  "data_fim": "2024-12-22 18:00"
}
```

#### GET `/`
**Listar todos os eventos**

#### PUT `/`
**Atualizar um evento**
```json
{
  "id": 1,
  "titulo": "Nome atualizado",
  "descricao": "Novos detalhes",
  "data_inicio": "2024-12-22 14:00",
  "data_fim": "2024-12-22 20:00"
}
```

#### DELETE `/`
**Excluir um evento**
```json
{
  "id": 1
}
```

---

## Estrutura do Projeto
```
.
├── config
│   └── Database.php
├── database
│   └── schema.sql
├── public
│   └── index.php
├── src
│   ├── Controllers
│   │   └── EventoController.php
│   ├── Models
│   │   └── Evento.php
│   └── Router
│       └── api.php
└── composer.json
```

---

## Contribuição
Sinta-se à vontade para contribuir enviando pull requests ou relatando problemas no repositório oficial.

---

## Licença
Este projeto é licenciado sob a [MIT License](LICENSE).

