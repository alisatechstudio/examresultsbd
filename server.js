'use strict';

const express = require('express');
const compression = require('compression');
const helmet = require('helmet');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

app.use(
  helmet({
    contentSecurityPolicy: {
      directives: {
        defaultSrc: ["'self'"],
        scriptSrc: ["'self'", "'unsafe-inline'"],
        styleSrc: ["'self'", "'unsafe-inline'"],
        imgSrc: ["'self'", 'data:', 'https:', 'blob:'],
        connectSrc: ["'self'"],
      },
    },
    crossOriginEmbedderPolicy: false,
  })
);

app.use(compression());
app.use(express.json());

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', (_req, res) => res.render('index'));

app.use(
  express.static(path.join(__dirname, 'public'), {
    maxAge: process.env.NODE_ENV === 'production' ? '1d' : 0,
    etag: true,
  })
);
app.get('/health', (_req, res) => {
  res.json({ status: 'ok' });
});

app.use((_req, res) => {
  res.status(404).json({ error: 'Not Found' });
});

app.listen(PORT, () => {
  console.log(`examresultsbd server running at http://localhost:${PORT}`);
  console.log(`   Environment : ${process.env.NODE_ENV || 'development'}`);
});

module.exports = app;

