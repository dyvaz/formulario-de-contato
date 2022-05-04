const bodyParser = require("body-parser");
const express = require("express");
const { body, validationResult } = require("express-validator");
const app = express();
const port = 3001;
const mysql = require("mysql2");

function insert(name, email, message, visualized, connection, callback) {
  connection.query(
    "INSERT INTO contact_form ( name, email, message, visualized) VALUES (?, ?, ?, ?)",
    [name, email, message, visualized],
    function (err, results) {
      if (err) {
        return callback(err);
      }
      callback(null, results.insertId);
    }
  );
}

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
      res.render("index", { errors: allErrors, values, errorServ, sucesso });
      return;
    }

    //CONEXAO COM O BANCO DE DADOS
    let connection = mysql.createConnection({
      host: "localhost",
      user: "Fm7ZKtSoYaBbXeZT5wGYAnZU4Uz979",
      password: "WvPpZGiA8edUP7Qb77Q535JfZa36do",
      database: "contact_form",
    });

    connection.connect(function (err) {
      if (err) {
        allErrors = ["Error establishing a database connection"];
        res.render("index", {
          errors: allErrors,
          values,
          errorServ: true,
          sucesso: false,
        });
        console.error("error-conection: " + err);
        return;
      }
      insert(name, email, message, visualized, connection, function (err) {
        connection.end();
        if (err) {
          allErrors = ["Error inserting into database"];
          res.render("index", {
            errors: allErrors,
            values,
            errorServ: true,
            sucesso: false,
          });
          console.error("error-conection: " + err);
          return;
        }
        res.redirect("/?success=1");
      });
    });
  }
);

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});
