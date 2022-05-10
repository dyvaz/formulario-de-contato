# Formulário de contato

## Formulário feito em **PHP** e em **node** para estudo

- Vários modelos de um mesmo formulário de contato, até o momento feitos em:

- node + ejs + mailhog
- php + PHPMailer + mailhog
- php + PDO + MYSQL

# Desenvolvimento

### Em php com mailhog

Faz o envio para o Mailhog depois de verificar cada campo e validar, usa o PHPMailer
usando o **$mail->send()** que faz o envio, após feito as validações e passando os
host, port o from e outros dados necessários para envio do email. Valida o envio do
formulário e faz o **header("Location: /?success=1")** para mudar o link e poder
verificar a url como forma de decidir se mostra a mensagem de sucesso no envio do
formulário.

### Em node com mailhog

A lógica do envio feita no arquivo **.js** e a do front no arquivo **.ejs**(onde está
o código html). Usa o validationResult do express para validar os campos, no array de
mensagens de erro cada case do switch adiciona a mensagem no array, que usa o **res.
render()** para "mandar" para o ejs os dados que precisa nesse, nesse caso, as
mensagens dos erros que teve. Faz o envio para o mailhog com o "nodemailer.
createTransport" e faz o envio usando o **sendMail** usando também o res.render para passar para o ejs os dados que precisará.
Quando enviado com sucesso faz o **res.redirect("/?success=1")** para mudar o link da
pagina que vai ser usado para saber quando enviou o email e poder mostrar a mensagem
de sucesso. No arquivo ejs, dentro das tags o código em js, para fazer a hora de mostrar os erros na tela.

### Em php com banco de dados

Conectar o PHP com o banco de dados, usando o PDO fazendo o new PDO(dsn, user, pass).
Fazer o CRUD, (insert, select, update, delete) para teste da conexão com o banco de dados, e dar um retorno útil para essas funçoẽs.
Substituir a conexão do Mailhog pelo MYSQL, fazer a função insert onde seria a lógica de envio para ele.

### TODO

- [ ] Formulário em node com o banco de dados

### Tecnologias utilizadas:

[Node.js](https://nodejs.org/en/),
[Docker-compose](https://docs.docker.com/compose/install/),
[PHP](https://www.php.net/manual/pt_BR/install),
[PHPMailer](https://github.com/PHPMailer/PHPMailer),
[MailHog](https://github.com/mailhog/MailHog),
[PDO](https://www.php.net/manual/pt_BR/book.pdo.php).

# Executando

```bash
# Na pasta php-email:
# Para iniciar o script:
$ ./scripts/run.sh

# Na pasta node-email
# Para iniciar o node:
$ npx nodemon index.js

# Em outra janela do terminal, na mesma pasta, para rodar o Docker e iniciar o Mailhog e o MYSQL
$ docker-compose up

# Para para o Docker:
$ docker-compose down

# O formulário em php esta em http://localhost:3000
# O formulário em node esta em http://localhost:3001
# O formulário em php com banco de dados está em http://localhost:3002
# E o MailHog em http://0.0.0.0:8025
# A porta do MYSQL é 3306
```
