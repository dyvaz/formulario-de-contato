const nodemailer = require("nodemailer");
const bodyParser = require("body-parser");
const express = require("express");
const { body, validationResult } = require("express-validator");
const app = express();
const port = 3001;
app.use(express.static("../public"));
app.use(bodyParser.urlencoded({ extended: true }));

app.set("view engine", "ejs");

app.get("/", (req, res, next) => {
  res.render("index", {
    errors: [],
    values: { name: "", email: "", message: "" },
    errorServ: false,
    sucesso: req.query.success === "1" ? true : false,
  });
});

app.post(
  "/",
  body("field-name").trim().notEmpty(),
  body("field-email").trim().isEmail(),
  body("field-message").trim().notEmpty(),
  (req, res, next) => {
    const errors = validationResult(req);

    let errorServ = false;
    let sucesso = req.query.success === "1" ? true : false;

    let name = req.body["field-name"];
    let email = req.body["field-email"];
    let message = req.body["field-message"];

    let allErrors = [];
    let i;
    for (i = 0; i < errors.errors.length; i++) {
      //allErrors.push(errors.errors[i].param);
      switch (errors.errors[i].param) {
        case "field-name":
          name = errors.errors[i].value;
          allErrors.push("There was an error filling in the name");
          break;

        case "field-email":
          email = errors.errors[i].value;
          allErrors.push("There was an error filling in the email");
          break;

        case "field-message":
          message = errors.errors[i].value;
          allErrors.push("There was an error filling in the message");
          break;
      }
    }
    const values = { name, email, message };

    if (i > 0) {
      res.render("index", { errors: allErrors, values, errorServ, sucesso });
      return;
    }

    const transport = nodemailer.createTransport({
      host: "localhost",
      port: 1025,
    });

    const emailOptions = {
      from: name + " " + email,
      to: "dy@dyvaz.com",
      subject: "Testando Mailhog",
      text: message,
    };

    transport.sendMail(emailOptions, (error, info) => {
      if (error) {
        allErrors = ["We had a server error, please try again later"];
        res.render("index", {
          errors: allErrors,
          values,
          errorServ: true,
          sucesso: false,
        });
      } else {
        res.redirect("/?success=1");
        res.renderedView("index", {
          errors: [],
          values: { name: "", email: "", message: "" },
          errorServ: false,
          sucesso: true,
        });
      }
      return;
    });
  }
);

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});
