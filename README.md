# Sistema de Gerenciamento de Tarefas (To-Do List)

![PHP](https://img.shields.io/badge/PHP-7.4%20%7C%208.x-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Fuso Horário](https://img.shields.io/badge/Timezone-CVT%20(UTC--1)-blue?style=flat-square)

## 📄 Descrição do Projeto

Este repositório compreende o **Sistema de Gerenciamento de Tarefas (To-Do List)**, uma aplicação web robusta concebida para a otimização de fluxos de trabalho, organização de atividades e acompanhamento de metas operacionais. O sistema foi desenvolvido com estrito alinhamento a critérios de segurança da informação, integridade de dados e separação de privilégios de acesso.

A solução dispõe de uma política de governança de acessos granular, mitigando riscos de exposição de dados: usuários operacionais gerenciam de forma autônoma suas respectivas demandas, enquanto o controle de contas e configurações estruturais permanecem centralizados sob a tutela exclusiva de perfis administrativos.

---

## 🚀 Funcionalidades Principais

### 🔒 Segurança e Autenticação
* **Controle de Sessões:** Mecanismo integrado de autenticação que impede acessos não autorizados a endpoints internos da aplicação.
* **Criptografia de Credenciais:** Armazenamento seguro de senhas em banco de dados por meio de algoritmos de *hashing* unidirecional, inviabilizando a leitura de dados sensíveis em caso de vazamento.

### 👥 Governança de Usuários e Permissões
* **Hierarquia Claras de Acesso:** Divisão explícita de escopo entre perfis do tipo `Administrador` e `Normal`.
* **Criação Centralizada de Contas:** Por premissa de segurança do ecossistema, **apenas administradores** detêm privilégios para registrar e cadastrar novos usuários.
* **Política Restrita por Padrão:** Novos registros inseridos na plataforma assumem compulsoriamente o status padrão de usuário comum (`normal`), evitando a escalada involuntária de privilégios.

### 📋 Gestão de Atividades (CRUD)
* **Persistência Completa:** Operações completas de criação, leitura, atualização e exclusão de tarefas de forma performática.
* **Escopo de Visualização:** Usuários possuem gerência exclusiva sobre o seu próprio inventário de tarefas, enquanto o perfil administrador possui visibilidade analítica global para fins de auditoria.
* **Sincronização Temporal:** Tratamento nativo e padronizado de datas e prazos sob o fuso horário de **Cabo Verde (CVT / UTC-1)**, eliminando discrepâncias em auditorias e entregas de prazos.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (Lógica de negócios, segurança de requisições e processamento de dados).
* **Banco de Dados:** MySQL (Persistência relacional otimizada com chaves estrangeiras e integridade referencial).
* **Front-end:** HTML5, CSS3 e JavaScript (Interface limpa, responsiva e focada na experiência do usuário).

---

## 📂 Estrutura Organizacional do Projeto

```text
├── config/
│   ├── database.php      # Estabelece a conexão segura com o SGBD MySQL
│   └── timezone.php      # Parametrização do fuso horário padrão (CVT)
├── database/
│   └── schema.sql        # Script de modelagem relacional (DDL e DML inicial)
├── includes/
│   ├── header.php        # Componente estrutural superior e menu de navegação
│   └── footer.php        # Componente estrutural inferior e notas de rodapé
├── modules/
│   ├── auth/             # Módulo de autenticação, logout e tratamento de hashes
│   ├── tasks/            # Controladores e interfaces do ecossistema de tarefas
│   └── users/            # Painel administrativo de controle e cadastro de usuários
├── index.php             # Ponto de entrada unificado da aplicação
└── README.md             # Documentação técnica do sistema
```
⚙️ Instalação e Implantação
Pré-requisitos
Para a execução do sistema em ambiente local de homologação, é necessária a infraestrutura de um servidor web com interpretador PHP e o motor de banco de dados MySQL ativos (recomenda-se o uso de ambientes como XAMPP, Laragon, Docker ou stacks LAMP/WAMP equivalentes).

Passo a Passo para Configuração
Clonagem do Repositório:

Bash
git clone [https://github.com/marcoplaceholderaccount/projeto_todolist.git](https://github.com/marcoplaceholderaccount/projeto_todolist.git)
cd projeto_todolist
Instanciação do Banco de Dados:

Acesse a ferramenta de gerência do seu banco de dados (ex: phpMyAdmin).

Crie um novo schema (banco de dados) denominado todolist_db.

Execute o script contido em database/schema.sql para a correta criação das tabelas e relacionamentos.

Parametrização do Ambiente:

Edite o arquivo localizado em config/database.php.

Substitua as variáveis de ambiente pelas credenciais correspondentes ao seu servidor MySQL local (Host, Usuário, Senha e Nome do Banco).

Alinhamento de Timezone:

O sistema assegura a consistência cronológica executando nativamente o seguinte bloco de instrução nas inicializações:

PHP
date_default_timezone_set('Atlantic/Cape_Verde');
Inicialização:

Aloque o diretório do projeto na pasta raiz de execução pública do seu servidor web (ex: htdocs ou www).

Certifique-se de que os serviços do Apache e MySQL estejam operacionais.

Navegue até o endereço: http://localhost/projeto_todolist.

📝 Licença
Este projeto está sob a égide da licença MIT. Para informações detalhadas, consulte o arquivo LICENSE anexo ao repositório.
