require('dotenv').config();
const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();
const port = process.env.PORT || 3000;

const db = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME
});

db.connect(err => {
  if (err) throw err;
  console.log('MySQL connected');
});

app.use(bodyParser.json());
app.use(express.static(path.join(__dirname, 'public')));

app.post('/contact', (req, res) => {
  const { name, email, message } = req.body;
  const sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
  db.query(sql, [name, email, message], (err) => {
    if (err) {
      console.error(err);
      res.status(500).send("Database error");
    } else {
      res.send("Message received!");
    }
  });
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});

