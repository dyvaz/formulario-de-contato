const nodemailer = require("nodemailer");
const bodyParser = require("body-parser");
const express = require("express");
const { body, validationResult } = require("express-validator");
const app = express();
const port = 3001;
let errorServ = false;
app.use(express.static("../public"));
app.use(bodyParser.urlencoded({ extended: true }));

app.set("view engine", "ejs");

app.get("/", (req, res) => {
  res.render("index", {
    errors: [],
    values: { name: "", email: "", message: "", errorServ },
  });
});

app.post(
  "/",
  body("field-name").trim().notEmpty(),
  body("field-email").trim().isEmail(),
  body("field-message").trim().notEmpty(),
  (req, res) => {
    const errors = validationResult(req);

    let name = req.body["field-name"];
    let email = req.body["field-email"];
    let message = req.body["field-message"];

    const allErrors = [];
    let i;
    for (i = 0; i < errors.errors.length; i++) {
      allErrors.push(errors.errors[i].param);
      switch (errors.errors[i].param) {
        case "field-name":
          name = errors.errors[i].value;

          break;

        case "field-email":
          email = errors.errors[i].value;
          break;

        case "field-message":
          message = errors.errors[i].value;
          break;
      }
    }
    const values = { name, email, message };

    if (i > 0) {
      res.render("index", { errors: allErrors, values, errorServ });
      return;
    }

    const transport = nodemailer.createTransport({
      host: "localhost",
      port: 1025,
    });

    const emailOptions = {
      from: email,
      to: "dy@dyvaz.com",
      subject: "Testando Mailhog",
      text: message,
    };

    transport.sendMail(emailOptions, (error, info) => {
      if (error) {
        res.render("index", {
          errors: allErrors,
          values,
          errorServ: true,
        });
      } else {
        res.render("index", {
          errors: [],
          values: { name: "", email: "", message: "" },
          errorServ: false,
        });
      }

      return;
    });
  }
);

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});
