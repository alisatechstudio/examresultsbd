<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !is_array($data)) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid request data']);
    exit;
}

function toEnglishDigits($str) {
    if ($str === null) return $str;
    $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    $en = ['0','1','2','3','4','5','6','7','8','9'];
    return str_replace($bn, $en, (string)$str);
}

$payload = [
    'exam' => toEnglishDigits($data['exam'] ?? ''),
    'year' => toEnglishDigits($data['year'] ?? ''),
    'board' => toEnglishDigits($data['board'] ?? ''),
    'roll' => toEnglishDigits($data['roll'] ?? ''),
];

$missing = [];
if (($payload['exam'] ?? '') === '') $missing[] = 'exam';
if (($payload['year'] ?? '') === '') $missing[] = 'year';
if (($payload['board'] ?? '') === '') $missing[] = 'board';
if (($payload['roll'] ?? '') === '') $missing[] = 'roll';

if (!empty($missing)) {
    http_response_code(400);
    echo json_encode(['message' => 'Missing required fields: ' . implode(', ', $missing)]);
    exit;
}

if (!empty($data['reg'])) {
    $payload['reg'] = toEnglishDigits($data['reg']);
}

$apiUrl = 'https://eduboardapi.vercel.app/fetch';

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    http_response_code(502);
    echo json_encode(['message' => 'API connection failed: ' . $error]);
    exit;
}

http_response_code($httpCode);
echo $response;
