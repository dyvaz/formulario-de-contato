# Formulário de contato

## Formulário feito em **PHP** e em **node** para estudo

- Vários modelos de um mesmo formulario de contato, até o momento feitos em:

  - node + ejs + mailhog
  - php + PHPMailer + mailhog
  - php + PDO + MYSQL
    - usando DBeaver

# Desenvolvimento

### Em php com mailhog

    Faz o envio para o Mailhog depois de verificar cada campo e validar, usa o PHPMailer usando o **$mail->send()** que faz o envio, após feito as validações e passando os host, port o from e outros dados necessarios para envio do email. Valida o envio do formulario e faz o **header("Location: /?success=1")** para mudar o link e poder verificar a url como forma de decidir se mostra a mensagem de sucesso no envio do formulario.

### Em node com mailhog

    A logica do envio feita no arquivo **.js** e a do front no aquivo **.ejs**(onde esta o código html). Usa o validationResult do express para validar os campos, no array de mensagens de erro cada case do switch aficiona a mensagem no array, que usa o **res.render()** para "mandar" para o ejs os dados que precisa nese, nesse caso, as mensagens dos erros que teve. Faz o envio para o mailhog com o "nodemailer.createTransport" e faz o envio usando o **sendMail** usando tambem o res.render para passar para o ejs os dados que precisará.
    Quando enviado com sucesso faz o **res.redirect("/?success=1")** para mudar o link da pagina que vai ser usado para saber quando enviou o email e poder mostrar a mensagem de sucesso. No aquivo ejs, dentro das tags o codigo em js, pra fazer a hora de mostras os erros na tela.

### Em php com banco de dados

    Depois de criar a o modelo da tabela no MYSQL Workbench, cria a tabela no DBeaver.
    Conectar o PHP com o banco de dados, usando o PDO fazendo o new PDO(dsn, user, pass).
    Fazer o CRUD, (insert, select, update, delete) para teste da conexão com o banco de dados, e dar um retorno util para essas funçoẽs.
    Substituir a conexão do Mailhog pelo MYSQL, fazer a função insert onde seria a lógica de envio para ele.

### TODO

- [ ] Formulario em node com o banco de dados

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
# Para eniciar o node:
$ npx nodemon index.js

# Em outra janela do terminal, no mesmo arquivo, para rodar o Docker e iniciar o Mailhog e o MYSQL
$ docker-compose up

# Para para o Docker:
$ docke-compose down

# O formulario em php esrta em http://localhost:3000
# O formulario em node esrta em http://localhost:3001
# O formulario em php com banco de dados esta em http://localhost:3002
# E o MailHog em http://0.0.0.0:8025
# A porta do MYSQL é 3306
```

<img src="https://avatars.githubusercontent.com/dyvaz" width=80><br> <sub src="https://github.com/dyvaz">Dyanna</sub>
