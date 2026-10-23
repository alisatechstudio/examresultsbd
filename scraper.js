'use strict';
const https = require('https');

function fetchResult({ exam, year, board, roll, reg }) {
  return new Promise((resolve, reject) => {
    const body = new URLSearchParams({ exam, year, board, roll, reg }).toString();
    const req = https.request('https://educationboardresults.gov.bd/', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'Content-Length': Buffer.byteLength(body) },
    }, (res) => {
      let data = '';
      res.on('data', (c) => (data += c));
      res.on('end', () => resolve(data));
    });
    req.on('error', reject);
    req.write(body);
    req.end();
  });
}

module.exports = { fetchResult };
