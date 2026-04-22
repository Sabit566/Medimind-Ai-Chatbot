# 🏥 MediCare — Health & Wellness Platform with AI Chatbot

<div align="center">

![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Active-brightgreen?style=for-the-badge)

A full-stack PHP/MySQL health & wellness website featuring live medicine search, patient registration, and **MediMind** — a healthcare-scoped AI chatbot powered by a custom LLM API.

</div>

---

## ✨ Features

- 🔍 **Live Medicine Search** — Search 100+ medicines by name, generic name, or category with pagination
- 👤 **Patient Registration** — Welcome modal with persistent profile creation (MySQL-backed)
- 🤖 **MediMind AI Chatbot** — Healthcare-only conversational AI with multi-turn chat history
- 🔐 **User Authentication** — Secure register/login with server-side session tokens (64-char)
- 💬 **Chat Management** — Create, rename, and delete consultation sessions; full message history
- 🌙 **Dark / Light Theme** — Toggle persisted via `localStorage`
- 📱 **Responsive Design** — Mobile-friendly layout with real Unsplash photography
- ⚡ **Graceful Fallback** — Pages degrade cleanly if the database is not yet connected

---

## 🗂️ Project Structure

```
medicare/
├── index.php            # Main website (5 pages + theme toggle + chatbot logo)
├── api.php              # MediMind AI backend (auth, chats, messages, AI relay)
├── api_medicines.php    # JSON API — medicine search with pagination
├── api_register.php     # JSON API — patient registration
├── config.php           # Environment config (DB, API key, models, session TTL)
├── db.php               # PDO singleton + UUID/token helpers
├── database.sql         # Full MySQL schema (users, sessions, chats, messages, logs)
├── schema.sql           # Medicare schema + 100 seed medicines
└── README.md            # This file
```

---

## 🚀 Getting Started

### Prerequisites

| Requirement | Version |
|-------------|---------|
| PHP | 7.4+ (with `mysqli` & `pdo_mysql`) |
| MySQL / MariaDB | 5.7+ |
| Web Server | Apache (XAMPP / WAMP / Laragon) or Nginx |

---

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/medicare.git
cd medicare
```

### 2. Import the Database Schemas

**For the medicine & patient features:**
```sql
-- In phpMyAdmin or MySQL CLI:
source /path/to/schema.sql
```

**For the MediMind AI chatbot (auth + chats):**
```sql
source /path/to/database.sql
```

### 3. Configure Environment

Edit **`config.php`** with your settings:

```php
define('DB_HOST',    'localhost');
define('DB_PORT',    3306);
define('DB_NAME',    'doss_ai');
define('DB_USER',    'root');       // ← your MySQL username
define('DB_PASS',    '');           // ← your MySQL password

define('API_URL', 'https://api.longcat.chat/openai/v1/chat/completions');
define('API_KEY', 'your_api_key_here');  // ← your LLM API key
```

Edit **`db.php`** (legacy mysqli connection for medicine/registration APIs):

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'medicare_db');
```

### 4. Deploy

Place all files in your web server root and open:

```
http://localhost/medicare/
```

---

## 🤖 MediMind AI Chatbot

MediMind is a **healthcare-scoped** AI assistant — it refuses all non-medical queries at the system-prompt level.

### Supported Topics
- Symptoms, conditions, and diseases
- Medication info (uses, dosage guidance, side effects)
- Preventive care, nutrition, and wellness
- Mental health awareness and coping strategies
- First aid and emergency guidance
- Chronic disease management (diabetes, hypertension, etc.)
- Women's health, pediatric & geriatric care
- Understanding lab results and medical terminology

### AI API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `api.php?action=register` | Create a new user account |
| `POST` | `api.php?action=login` | Authenticate and receive a session token |
| `GET` | `api.php?action=me` | Get the current authenticated user |
| `POST` | `api.php?action=logout` | Invalidate the session token |
| `GET` | `api.php?action=chats` | List all chat sessions |
| `POST` | `api.php?action=chats` | Create a new chat session |
| `GET` | `api.php?action=chat&uuid=` | Get a specific chat |
| `POST` | `api.php?action=chat&uuid=` | Rename / update a chat |
| `DELETE` | `api.php?action=chat&uuid=` | Delete a chat and its messages |
| `GET` | `api.php?action=messages&uuid=` | Fetch full message history |
| `POST` | `api.php?action=send` | Send a message and receive an AI reply |
| `POST` | `api.php?action=profile` | Update display name, avatar color, or password |

All protected endpoints require an `X-Auth-Token` header with the 64-character session token.

### Supported AI Models

Configured in `config.php`:

```php
define('ALLOWED_MODELS', [
    'LongCat-Flash-Chat',
    'LongCat-Flash-Thinking',
    'LongCat-Flash-Thinking-2601',
]);
```

---

## 💊 Medicine API

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `api_medicines.php` | List / search medicines |
| `GET` | `api_medicines.php?q=paracetamol` | Search by name or generic |
| `GET` | `api_medicines.php?cat=Antibiotic` | Filter by category |
| `GET` | `api_medicines.php?page=2` | Paginate results (12 per page) |

**Response schema:**
```json
{
  "success": true,
  "data": [...],
  "total": 100,
  "page": 1,
  "limit": 12,
  "pages": 9
}
```

---

## 🗃️ Database Schema

### `medicare_db` (medicine & patients)
- **`medicines`** — brand name, generic name, category, dosage form, strength, price (TK), manufacturer
- **`patients`** — full name, email, phone, date of birth, blood group

### `doss_ai` (AI chatbot)
- **`users`** — username, email, hashed password, display name, avatar color
- **`sessions`** — 64-char tokens with 30-day TTL
- **`chats`** — UUID-keyed sessions with title auto-generation
- **`messages`** — role/content pairs with token counts
- **`api_logs`** — per-request model usage, token counts, latency, HTTP status

---

## 🔒 Security Notes

- Passwords are hashed with `PASSWORD_BCRYPT` (never stored in plain text)
- Session tokens are 64 hex characters generated via `random_bytes(32)`
- All SQL queries use **prepared statements** — no raw interpolation
- API model selection is **whitelisted** server-side; client input is sanitized
- CORS headers are set to `*` — restrict in production to your domain

---

## 📋 Medicine Database

100 medicines pre-loaded covering major categories:

| Category | Examples |
|----------|---------|
| Antibiotic | Amoxicillin, Ciprofloxacin |
| Analgesic | Paracetamol, Ibuprofen |
| Antidiabetic | Metformin, Glibenclamide |
| Antihypertensive | Amlodipine, Losartan |
| Antihistamine | Cetirizine, Loratadine |
| Antacid | Omeprazole, Ranitidine |
| And more… | |

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

## ⚠️ Disclaimer

MediMind provides **general health information only** and is not a substitute for professional medical advice, diagnosis, or treatment. Always consult a qualified healthcare provider for medical decisions.

---

<div align="center">
Made with ❤️ for better health outcomes
</div>
