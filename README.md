# Formulário de contato

Formulário feito em **PHP** e em **node** para estudo

em:
[/php-email](#php-email)
Depois da verificaçao da existência das variaveis e seus valores corretos incializamos a o PHOMailer e usamos a $mail passando para ela todos os valores relacionados ao servidor (usamos o mailhog). Depois do envio do email na $email->send() faço o header location para a propria página e termino a execuçao com exit()

### ainda precisa ser feito:

- [ ] Deixar a logica do node no mesmo padrão que o em php

### Tecnologias utilizadas:

[Node.js](https://nodejs.org/en/),
[Docker-compose](https://docs.docker.com/compose/install/),
[PHP](https://www.php.net/manual/pt_BR/install),
[PHPMailer](https://github.com/PHPMailer/PHPMailer),
[MailHog](https://github.com/mailhog/MailHog).

### Rodar no back end

```bash
# Na pasta php-email:
# Para iniciar o script:
$ ./scripts/run.sh

# Na pasta node-email
# Para eniciar o node:
$ npx nodemon index.js

# Em outra janela do terminal, no mesmo arquivo, para rodar o Docker e iniciar o Mailhog
$ docker-compose up

# Para para o Docker:
$ docke-compose down

# O formulario em php esrtara em http://localhost:3000
# O formulario em node esrtara em http://localhost:3001
# E o MailHog em http://0.0.0.0:8025/

```

<img src="https://avatars.githubusercontent.com/dyvaz" width=115><br> <sub>Dyanna Azevedo</sub>
