# Formulário de contato

Formulário feito em **PHP** e em **node** para estudo

em:
[/php-email](#php-email)
Depois da verificaçao da existência das variaveis e seus valores corretos incializamos a o PHOMailer e usamos a $mail passando para ela todos os valores relacionados ao servidor (usamos o mailhog). Depois do envio do email na $email->send() faço o header location para a propria página e termino a execuçao com exit()

### ainda precisa ser feito:

- [x]fazer a mensagem de falha/sucesso aparecer no momento correto.
- [x]estilizar as mensagens de falha/sucesso
- [x] Deixar envolta dos campos vermelhos
- [x] mostrar todos os erros?
- [x] colocar os erros em ingles
- [ ] nao aparecer a mensagem de sucesso antes de enviar

### Pré-requiaitos

> Tecnologias utilizadas:

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

# O formulario esrtara em http://localhost:3000
# E o MailHog em http://0.0.0.0:8025/

```

| <img src="https://avatars.githubusercontent.com/dyvaz" width=115><br><sub>Dyanna Azevedo</sub> |
