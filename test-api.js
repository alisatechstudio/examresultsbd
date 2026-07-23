const http = require('http');

const data = JSON.stringify({
  exam: 'ssc',
  board: 'dhaka',
  year: '2025',
  roll: '123456',
  reg: '123456',
  resultType: '1',
  captcha: '10',
  sessionId: ''
});

const options = {
  hostname: 'localhost',
  port: 3000,
  path: '/api/check-result',
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Content-Length': Buffer.byteLength(data)
  }
};

const req = http.request(options, (res) => {
  let body = '';
  res.on('data', (chunk) => body += chunk);
  res.on('end', () => {
    console.log('Status:', res.statusCode);
    console.log('Body:', body);
  });
});

req.on('error', (e) => {
  console.error('Request error:', e.message);
});

req.write(data);
req.end();
