# Projeto Banco de Dados - Biblioteca

**Integrantes:** Pedro Galhardi, Matheus Moreno

## Descrição

Este projeto implementa um sistema de gestão de biblioteca utilizando MySQL para o banco de dados e PHP/HTML para a interface web. O objetivo é demonstrar modelagem, normalização e consultas SQL, além de uma integração simples via web.

---

## Estrutura do Projeto

- **biblioteca.sql**: Script SQL para criar todas as tabelas, inserir dados, criar consultas e uma view.
- **diagrama_ER_biblioteca.mmd**: Diagrama Entidade-Relacionamento (formato Mermaid).
- **create_tables.php**: Executa o arquivo SQL e cria todas as tabelas/dados no banco MySQL.
- **config.php**: Arquivo de configuração para conexão com o banco de dados.
- **index.php**: Menu principal do sistema (interface web).
- **usuarios.php**: Lista todos os usuários cadastrados.
- **livros.php**: Lista todos os livros e suas categorias.
- **emprestimos.php**: Lista todos os empréstimos, mostrando usuário, livro e datas.
- **consultas.php**: Exibe as 4 consultas SQL especiais do projeto.
- **index.html**: Página inicial estática com links para as páginas PHP.

---

## Como Executar

1. **Configuração do Banco de Dados**
   - Certifique-se de ter o MySQL rodando localmente.
   - Altere o usuário e senha em `create_tables.php` e `config.php` se necessário.

2. **Criação do Banco e Tabelas**
   - Execute `create_tables.php` uma vez (via navegador ou terminal) para criar o banco de dados, tabelas e inserir os dados iniciais.

3. **Acesso ao Sistema Web**
   - Abra `index.html` ou `index.php` no navegador para acessar o menu principal.
   - Navegue pelas opções para visualizar usuários, livros, empréstimos e consultas especiais.

---

## Consultas Especiais

As seguintes consultas SQL estão implementadas e podem ser visualizadas em `consultas.php`:
1. **Empréstimos com nome do usuário e título do livro** (JOIN)
2. **Livros, seus autores e a categoria** (consulta com 3 tabelas)
3. **Usuários que não devolveram livros ainda**
4. **Quantidade de livros emprestados por usuário**

---

## Diagrama ER
O diagrama Entidade-Relacionamento está disponível em `diagrama_ER_biblioteca.mmd` (pode ser visualizado em https://mermaid.live/ ou convertido para PNG).

---

## Observações
- O sistema é apenas para demonstração acadêmica.
- Para inserir dados via web ou adicionar novas funcionalidades, basta pedir!

---

**Dúvidas ou sugestões:** Fale com Pedro Galhardi ou Matheus Moreno. 