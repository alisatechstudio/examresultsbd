'use strict';

const express = require('express');
const compression = require('compression');
const helmet = require('helmet');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

// ─── Security Headers (Helmet) ────────────────────────────────────────────────
// Configured to allow inline scripts/styles used by the existing static pages
// and to allow Google Fonts, Google Ads, and other third-party resources.
app.use(
  helmet({
    contentSecurityPolicy: {
      directives: {
        defaultSrc: ["'self'"],
        scriptSrc: [
          "'self'",
          "'unsafe-inline'",
          'https://pagead2.googlesyndication.com',
          'https://www.googletagmanager.com',
          'https://www.google-analytics.com',
          'https://adservice.google.com',
          'https://partner.googleadservices.com',
          'https://tpc.googlesyndication.com',
        ],
        styleSrc: [
          "'self'",
          "'unsafe-inline'",
          'https://fonts.googleapis.com',
        ],
        fontSrc: ["'self'", 'https://fonts.gstatic.com'],
        imgSrc: ["'self'", 'data:', 'https:', 'blob:'],
        connectSrc: ["'self'", 'https://www.google-analytics.com'],
        frameSrc: [
          'https://googleads.g.doubleclick.net',
          'https://tpc.googlesyndication.com',
        ],
      },
    },
    // Allow the site to be embedded in its own iframes (e.g. ad frames)
    crossOriginEmbedderPolicy: false,
  })
);

// ─── Gzip Compression ─────────────────────────────────────────────────────────
app.use(compression());

// ─── Static Assets ───────────────────────────────────────────────────────────
// Serve everything in the project root as static files.
// This covers CSS, JS, images, manifests, txt files, etc.
app.use(
  express.static(path.join(__dirname), {
    // Cache static assets for 1 day in production, no cache in dev
    maxAge: process.env.NODE_ENV === 'production' ? '1d' : 0,
    // Let the browser know ETags are valid
    etag: true,
    // Return index.html for directory requests
    index: false, // We handle index ourselves below for clean routing
  })
);

// ─── HTML Page Routes ─────────────────────────────────────────────────────────

const pages = {
  '/':          'index.html',
  '/about':     'about.html',
  '/contact':   'contact.html',
  '/privacy':   'privacy.html',
  '/terms':     'terms.html',
};

for (const [route, file] of Object.entries(pages)) {
  app.get(route, (_req, res) => {
    res.sendFile(path.join(__dirname, file));
  });

  // Also accept trailing slashes (e.g. /about/)
  if (route !== '/') {
    app.get(route + '/', (_req, res) => {
      res.sendFile(path.join(__dirname, file));
    });
  }
}

// ─── Redirect .html extensions to clean URLs ─────────────────────────────────
const htmlRedirects = ['about', 'contact', 'privacy', 'terms'];
for (const page of htmlRedirects) {
  app.get(`/${page}.html`, (req, res) => {
    res.redirect(301, `/${page}`);
  });
}

// ─── 404 Handler ─────────────────────────────────────────────────────────────
app.use((_req, res) => {
  res.status(404).sendFile(path.join(__dirname, 'index.html'));
});

// ─── Start Server ─────────────────────────────────────────────────────────────
app.listen(PORT, () => {
  console.log(`✅  ফলাফল সেতু server running at http://localhost:${PORT}`);
  console.log(`   Environment : ${process.env.NODE_ENV || 'development'}`);
});

module.exports = app; // for testing
