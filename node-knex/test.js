async function test() {
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

  await knex("contact_form").insert({
    name: "dy",
    email: "dy@dy.com",
    message: "test knex",
    viualized: false,
  });

  await knex.destroy();
}
//o destroy precisa de um await porque ele retorna uma promise
test();
