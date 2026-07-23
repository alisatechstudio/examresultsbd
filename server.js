const express = require('express');
const fetch = (...args) => import('node-fetch').then(({default: fetch}) => fetch(...args));

async function main() {
  const app = express();
  app.use(express.json({ limit: '1mb' }));
  app.use(express.static('.'));

  const OFFICIAL_AJAX = 'https://eboardresultsgovbd.com/wp-admin/admin-ajax.php';
  const OFFICIAL_HOME = 'https://eboardresultsgovbd.com/';
  const FALLBACK_NONCE = 'ec2b9112ea';

  const cookieJar = new Map();

  async function fetchWithCookies(url, options = {}) {
    const res = await fetch(url, options);
    const setCookie = res.headers.raw()['set-cookie'] || [];
    for (const cookie of setCookie) {
      const [pair] = cookie.split(';');
      if (pair && pair.includes('=')) {
        const [name, value] = pair.split('=');
        cookieJar.set(name.trim(), value.trim());
      }
    }
    return res;
  }

  function getCookieHeader() {
    const pairs = [];
    for (const [name, value] of cookieJar.entries()) {
      pairs.push(`${name}=${value}`);
    }
    return pairs.join('; ');
  }

  async function getFreshNonce() {
    const res = await fetchWithCookies(OFFICIAL_HOME, {
      headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language': 'en-US,en;q=0.9',
      },
    });
    if (!res.ok) throw new Error(`Homepage fetch failed: ${res.status}`);
    const html = await res.text();
    const match = html.match(/var\s+BDRC\s*=\s*(\{.*?\});/s);
    if (!match) throw new Error('BDRC config not found');
    const config = JSON.parse(match[1]);
    return config.nonce || FALLBACK_NONCE;
  }

  function buildFormData(values) {
    const fd = new URLSearchParams();
    fd.append('action', 'result_check');
    fd.append('result_type', values.resultType || '1');
    fd.append('exam', values.exam || '');
    fd.append('board', values.board || '');
    fd.append('year', values.year || '');
    if (values.resultType === '2') {
      fd.append('eiin', values.eiin || '');
    } else if (values.resultType === '5') {
      fd.append('dcode', values.district || '');
    } else {
      fd.append('roll', values.roll || '');
      fd.append('reg', values.reg || '');
    }
    fd.append('captcha', values.captcha || '');
    fd.append('session_id', values.sessionId || '');
    return fd;
  }

  app.post('/api/check-result', async (req, res) => {
    try {
      const values = req.body || {};
      if (!values.exam || !values.board || !values.year) {
        return res.status(400).json({ ok: false, message: 'Missing exam, board or year.' });
      }

      let nonce = values.nonce;
      if (!nonce) {
        try {
          nonce = await getFreshNonce();
        } catch (e) {
          console.warn('Nonce refresh failed, using fallback', e.message);
          nonce = FALLBACK_NONCE;
        }
      }

      const formData = buildFormData(values);
      const ajaxRes = await fetchWithCookies(OFFICIAL_AJAX, {
        method: 'POST',
        headers: {
          'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
          'Referer': OFFICIAL_HOME,
          'X-Requested-With': 'XMLHttpRequest',
          'Origin': OFFICIAL_HOME,
          'Cookie': getCookieHeader(),
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
        body: formData.toString(),
        redirect: 'follow',
      });

      const contentType = ajaxRes.headers.get('content-type') || '';
      let body = '';
      try {
        body = await ajaxRes.text();
      } catch (e) {
        body = '';
      }

      if (!ajaxRes.ok) {
        return res.status(502).json({ ok: false, message: `Upstream responded ${ajaxRes.status}`, raw: body });
      }

      let data = {};
      if (contentType.includes('application/json')) {
        try {
          data = JSON.parse(body);
        } catch (e) {
          data = { raw: body };
        }
      } else {
        data = { raw: body };
      }

      res.json({
        ok: true,
        status: ajaxRes.status,
        contentType,
        data,
        nonce,
      });
    } catch (err) {
      console.error('Result proxy error', err);
      res.status(500).json({ ok: false, message: err.message });
    }
  });

  const PORT = process.env.PORT || 3000;
  app.listen(PORT, () => {
    console.log(`Result proxy running at http://localhost:${PORT}`);
  });
}

main().catch((err) => {
  console.error('Fatal error:', err);
  process.exit(1);
});
