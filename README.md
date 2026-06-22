# Sistema de Gerenciamento de Tarefas (To-Do List)

![PHP](https://img.shields.io/badge/PHP-7.4%20%7C%208.x-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Fuso Horário](https://img.shields.io/badge/Timezone-CVT%20(UTC--1)-blue?style=flat-square)

## 📄 Descrição do Projeto

Este repositório compreende o **Sistema de Gerenciamento de Tarefas (To-Do List)**, uma aplicação web robusta concebida para a otimização de fluxos de trabalho, organização de atividades e acompanhamento de metas operacionais. O sistema foi desenvolvido com estrito alinhamento a critérios de segurança da informação, integridade de dados e separação de privilégios de acesso.

A solução dispõe de uma política de governança de acessos granular, mitigando riscos de exposição de dados: utilizadores operacionais gerenciam de forma autônoma suas respectivas demandas, enquanto o controle de contas e configurações estruturais permanecem centralizados sob a tutela exclusiva de perfis administrativos.

---

## 🚀 Funcionalidades Principais

### 🔒 Segurança e Autenticação
* **Controle de Sessões:** Mecanismo integrado de autenticação que impede acessos não autorizados a endpoints internos da aplicação.
* **Criptografia de Credenciais:** Armazenamento seguro de senhas em banco de dados por meio de algoritmos de *hashing* unidirecional, inviabilizando a leitura de dados sensíveis em caso de vazamento.

### 👥 Governança de Utilizadores e Permissões
* **Hierarquia Claras de Acesso:** Divisão explícita de escopo entre perfis do tipo `Administrador` e `Normal`.
* **Criação Centralizada de Contas:** Por premissa de segurança do ecossistema, **apenas administradores** detêm privilégios para registrar e cadastrar novos utilizadores.
* **Política Restrita por Padrão:** Novos registros inseridos na plataforma assumem compulsoriamente o status padrão de utilizador comum (`normal`), evitando a escalada involuntária de privilégios.

### 📋 Gestão de Atividades (CRUD)
* **Persistência Completa:** Operações completas de criação, leitura, atualização e exclusão de tarefas de forma performática.
* **Escopo de Visualização:** utilizadores possuem gerência exclusiva sobre o seu próprio inventário de tarefas, enquanto o perfil administrador possui visibilidade analítica global para fins de auditoria.
* **Sincronização Temporal:** Tratamento nativo e padronizado de datas e prazos sob o fuso horário de **Cabo Verde (CVT / UTC-1)**, eliminando discrepâncias em auditorias e entregas de prazos.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (Lógica de negócios, segurança de requisições e processamento de dados).
* **Banco de Dados:** MySQL (Persistência relacional otimizada com chaves estrangeiras e integridade referencial).
* **Front-end:** HTML5, CSS3 e JavaScript (Interface limpa, responsiva e focada na experiência do utilizador).

---

## 📂 Estrutura Organizacional do Projeto

```text
├── index.php                 # Ponto de entrada e tela principal do sistema
├── login.php                 # Interface de autenticação de usuários
├── logout.php                # Encerramento seguro de sessões ativas
├── registro.php              # Formulário para entrada de novos utilizadores
├── db.php                    # Centralização da conexão com o banco de dados MySQL
├── fundo.php                 # Elementos visuais e estilos secundários de background
├── libs/                     # Bibliotecas de suporte externas carregadas na aplicação
├── template/                 # Fragmentos de interface reutilizáveis
│   ├── header.php            # Componente superior e barra de navegação principal
│   └── footer.php            # Componente inferior e encerramento estrutural
└── pages/                    # Módulos de controle específicos da aplicação
    ├── report/
    │   └── index.php         # Módulo analítico para geração de relatórios
    ├── tarefas/
    │   ├── index.php         # Listagem e painel de controle de tarefas por usuário
    │   ├── create.php        # Formulário de abertura de novas demandas
    │   └── update.php        # Interface de alteração e conclusão de tarefas
    └── utilizadores/
        ├── index.php         # Painel administrativo de monitoria de utilizadores
        ├── create.php        # Endpoint de inclusão de contas restrito ao admin
        └── update.php        # Modificação de credenciais e níveis de acesso
```
---

## ⚙️ Instalação e Implementação

### 📌 Pré-requisitos

Para a execução do sistema num ambiente local de desenvolvimento ou testes, é necessária uma infraestrutura composta por um servidor web com suporte para PHP e um sistema de gestão de bases de dados MySQL em funcionamento.

Recomenda-se a utilização de ambientes como:

* XAMPP
* Laragon
* Docker
* LAMP
* WAMP

ou outras soluções equivalentes.

---

## 🚀 Passos para Configuração

### 1. Clonagem do Repositório

```bash
git clone https://github.com/marcoplaceholderaccount/projeto_todolist.git

cd projeto_todolist
```

---

### 2. Criação da Base de Dados

1. Aceda à ferramenta de administração da sua base de dados (por exemplo, phpMyAdmin).

2. Crie uma nova base de dados com o nome:

```text
todolist_db
```

3. Execute o script localizado em:

```text
database/schema.sql
```

para criar todas as tabelas, restrições e relacionamentos necessários ao funcionamento da aplicação.

---

### 3. Configuração da Ligação à Base de Dados

Edite o ficheiro:

```text
config/database.php
```

e actualize os parâmetros de ligação de acordo com a configuração do seu servidor MySQL:

* Anfitrião (Host)
* Utilizador
* Palavra-passe
* Nome da Base de Dados

---

### 4. Configuração do Fuso Horário

O sistema garante a consistência temporal através da utilização do fuso horário oficial de Cabo Verde.

A seguinte instrução é executada durante a inicialização da aplicação:

```php
date_default_timezone_set('Atlantic/Cape_Verde');
```

---

### 5. Execução da Aplicação

1. Copie a pasta do projecto para o directório público do seu servidor web.

Exemplos:

```text
htdocs
```

ou

```text
www
```

2. Certifique-se de que os seguintes serviços estão activos:

* Apache
* MySQL

3. Abra o navegador e aceda ao endereço:

```text
http://localhost/projeto_todolist
```

---

## 📝 Licença

Este projecto é distribuído sob a licença MIT.

Para mais informações, consulte o ficheiro:

```text
LICENSE
```

disponível no repositório.
