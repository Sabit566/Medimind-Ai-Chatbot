# MediCare – Health & Wellness Website

## 📁 Files
| File | Purpose |
|------|---------|
| `index.php` | Main website (all 5 pages + theme toggle + welcome modal + 3D chatbot logo) |
| `db.php` | Database connection config |
| `api_medicines.php` | JSON API: search medicines with pagination |
| `api_register.php` | JSON API: register new patient |
| `schema.sql` | MySQL schema + 100 seed medicines |
| `README.md` | This file |

## 🚀 Setup

### 1. Requirements
- PHP 7.4+ (with MySQLi extension)
- MySQL / MariaDB 5.7+
- Any web server: Apache (XAMPP / WAMP / Laragon) or Nginx

### 2. Database Setup
```sql
-- In phpMyAdmin or MySQL CLI:
source /path/to/schema.sql
```
Or copy-paste the contents of `schema.sql` into phpMyAdmin's SQL tab.

### 3. Configure DB Connection
Edit `db.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // your MySQL username
define('DB_PASS', '');           // your MySQL password
define('DB_NAME', 'medicare_db');
```

### 4. Deploy
Place all files in your web server root (e.g. `htdocs/medicare/`) and open:
```
http://localhost/medicare/
```

## 🤖 Chatbot Setup
In `index.php`, find this line and replace with your chatbot URL:
```html
<a href="https://YOUR_CHATBOT_URL_HERE" target="_blank">
```

## 🎨 Features
- ✅ Multi-page: Home, Diseases, Medicine, Prevention, Cure, Doctors
- ✅ Live MySQL medicine search with pagination
- ✅ Dark / Light theme toggle (persisted in localStorage)
- ✅ Welcome modal with patient registration (PHP + MySQL)
- ✅ 3D animated chatbot logo (hyperlink to your chatbot)
- ✅ Real human photos via Unsplash
- ✅ Fully responsive design
- ✅ Graceful fallback if DB not connected

## 📋 Medicine Database
100 medicines pre-loaded with:
- Brand name
- Generic name
- Category
- Dosage form & strength
- Price per tablet (TK)
- Manufacturer
