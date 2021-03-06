const bodyParser = require("body-parser");
const express = require("express");
const { body, validationResult } = require("express-validator");
const app = express();
const port = 3001;

const knex = require("knex")({
  client: "mysql2",
  connection: {
    host: "127.0.0.1",
    port: 3306,
    user: "Fm7ZKtSoYaBbXeZT5wGYAnZU4Uz979",
    password: "WvPpZGiA8edUP7Qb77Q535JfZa36do",
    database: "contact_form",
  },
});

app.use(express.static("../public"));
app.use(bodyParser.urlencoded({ extended: true }));

app.set("view engine", "ejs");

app.get("/", (req, res) => {
  res.render("index", {
    errors: [],
    values: { name: "", email: "", message: "" },
    errorServ: false,
    success: req.query.success === "1" ? true : false,
  });
});
app.post(
  "/",
  body("field-name").trim().notEmpty(),
  body("field-email").trim().isEmail(),
  body("field-message").trim().notEmpty(),
  async (req, res) => {
    const errors = validationResult(req);
    let errorServ = false;
    let success = req.query.success === "1" ? true : false;
    let name = req.body["field-name"];
    let email = req.body["field-email"];
    let message = req.body["field-message"];
    let visualized = false;
    let allErrors = [];
    let i;
    for (i = 0; i < errors.errors.length; i++) {
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
      res.render("index", { errors: allErrors, values, errorServ, success });
      return;
    }
    try {
      await knex("contact_form").insert({
        name: name,
        email: email,
        message: message,
        visualized: false,
      });
      res.redirect("/?success=1");
    } catch (err) {
      console.log("cath");
      allErrors = ["Error establishing a database connection"];
      res.render("index", {
        errors: allErrors,
        values,
        errorServ: true,
        success: false,
      });
      console.error("error: " + err.message);
    }
  }
);

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});
