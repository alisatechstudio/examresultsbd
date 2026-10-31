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
        scriptSrc: [
          "'self'",
          "'unsafe-inline'",
          'https://bauval.org',
          'https://*.bauval.org',
          'https://abscloud.org',
          'https://*.abscloud.org',
          'https://www.googletagmanager.com',
          'https://www.clarity.ms',
          'https://*.clarity.ms',
          'https://5gvci.com',
          'https://result.bangladeshgov.org',
        ],
        styleSrc: ["'self'", "'unsafe-inline'"],
        imgSrc: ["'self'", 'data:', 'https:', 'blob:'],
        frameSrc: [
          "'self'",
          'https://bauval.org',
          'https://*.bauval.org',
          'https://abscloud.org',
          'https://*.abscloud.org',
        ],
        connectSrc: [
          "'self'",
          'https://eduboardapi.vercel.app',
          'https://bauval.org',
          'https://*.bauval.org',
          'https://abscloud.org',
          'https://*.abscloud.org',
          'https://www.google-analytics.com',
          'https://*.clarity.ms',
        ],
      },
    },
    crossOriginEmbedderPolicy: false,
  })
);

app.use(compression());
app.use(express.json());

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.use(
  express.static(path.join(__dirname, 'public'), {
    maxAge: process.env.NODE_ENV === 'production' ? '1d' : 0,
    etag: true,
  })
);

/* ===================================================================
   PAGE ROUTES — 18 pages total
   =================================================================== */

// Home
app.get('/', (_req, res) => res.render('index'));

// Result Pages (Pillar 1: Board Exams)
app.get('/ssc-result', (_req, res) => res.render('ssc-result'));
app.get('/hsc-result', (_req, res) => res.render('hsc-result'));
app.get('/primary-result', (_req, res) => res.render('primary-result'));

// Result Pages (Pillar 2: Higher Education & Admission)
app.get('/university-admission', (_req, res) => res.render('university-admission'));
app.get('/medical-admission', (_req, res) => res.render('medical-admission'));
app.get('/nu-result', (_req, res) => res.render('nu-result'));

// Result Pages (Pillar 3: Job & Career Exams)
app.get('/bcs-result', (_req, res) => res.render('bcs-result'));
app.get('/ntrca-result', (_req, res) => res.render('ntrca-result'));

// Tools & Guides (Pillar 4)
app.get('/sms-result', (_req, res) => res.render('sms-result'));
app.get('/grading-system', (_req, res) => res.render('grading-system'));
app.get('/board-challenge', (_req, res) => res.render('board-challenge'));
app.get('/education-boards', (_req, res) => res.render('education-boards'));

// Info Pages (converted from static HTML)
app.get('/about', (_req, res) => res.render('about'));
app.get('/contact', (_req, res) => res.render('contact'));
app.get('/privacy', (_req, res) => res.render('privacy'));
app.get('/terms', (_req, res) => res.render('terms'));
app.get('/guide', (_req, res) => res.render('guide'));

/* ===================================================================
   API ROUTES
   =================================================================== */
app.get('/api/result', async (req, res) => {
  const { exam, year, board, roll, reg } = req.query;
  try {
    const r = await fetch('https://eduboardapi.vercel.app/fetch', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ exam, year, board, roll, reg }),
    });
    const data = await r.json();
    res.json(data);
  } catch (e) {
    res.status(500).json({ error: e.message });
  }
});

app.get('/health', (_req, res) => {
  res.json({ status: 'ok' });
});

/* ===================================================================
   404 HANDLER
   =================================================================== */
app.use((_req, res) => {
  res.status(404).json({ error: 'Not Found' });
});

app.listen(PORT, () => {
  console.log(`examresultsbd server running at http://localhost:${PORT}`);
  console.log(`   Environment : ${process.env.NODE_ENV || 'development'}`);
});

module.exports = app;
