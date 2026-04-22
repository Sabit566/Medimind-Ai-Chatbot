<?php
// config.php — DoSS AI Configuration
// ── Edit ONLY this file for environment settings ──

define('DB_HOST',    'localhost');
define('DB_PORT',    3306);
define('DB_NAME',    'doss_ai');
define('DB_USER',    'root');         // ← your MySQL username
define('DB_PASS',    '');             // ← your MySQL password
define('DB_CHARSET', 'utf8mb4');

// LongCat AI API
define('API_URL', 'https://api.longcat.chat/openai/v1/chat/completions');
define('API_KEY', 'ak_26A6mP5wW2DA0bO1ur6px7nR5Gy73');

// Allowed models (whitelist)
define('ALLOWED_MODELS', [
    'LongCat-Flash-Chat',
    'LongCat-Flash-Thinking',
    'LongCat-Flash-Thinking-2601',
]);

// Session / auth
define('SESSION_TTL',    86400 * 30);  // 30 days
define('MAX_TOKENS',     2000);
define('MAX_TEMP',       1.0);
define('APP_NAME',       'DoSS AI');
