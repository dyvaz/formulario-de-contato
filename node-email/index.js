const nodemailer = require("nodemailer");
const bodyParser = require("body-parser");
const express = require("express");
const { body, validationResult } = require("express-validator");
const app = express();
const port = 3000;

app.use(express.static("../public"));
app.use(bodyParser.urlencoded({ extended: true }));

app.post(
  "/api/contact",
  body("field-name").trim().notEmpty(),
  body("field-message").trim().notEmpty(),
  body("field-email").trim().isEmail(),
  (req, res) => {
    const errors = validationResult(req);

    var allErrors = [];
    let i;
    for (i = 0; i < errors.errors.length; i++) {
      let a = errors.errors[i].param;
      allErrors.push(a);
    }
    if (i > 0) {
      res.redirect("/index.html?error=" + allErrors);
      res.end();
      return;
    }

    var name = req.body["field-name"];
    var email = req.body["field-email"];
    var message = req.body["field-message"];

    const transport = nodemailer.createTransport({
      host: "localhost",
      port: 1025,
      secure: false,
    });

    const emailOptions = {
      from: email,
      to: "dy@dyvaz.com",
      subject: "Testando Mailhog",
      text: message,
    };

    transport.sendMail(emailOptions, (error, info) => {
      if (error) {
        res.redirect("/index.html?error=1");
      } else {
        res.redirect("/index.html?error=0");
      }
      res.end();
    });
  }
);

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});
