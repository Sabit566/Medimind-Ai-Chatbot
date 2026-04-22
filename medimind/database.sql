-- DoSS AI — MySQL Database Schema v2 (with Auth)
-- Run once: mysql -u root -p < database.sql

CREATE DATABASE IF NOT EXISTS doss_ai CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE doss_ai;

-- ─────────────────────────────────────────────
-- USERS (auth)
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username        VARCHAR(40) NOT NULL UNIQUE,
    email           VARCHAR(191) NOT NULL UNIQUE,
    password_hash   VARCHAR(255) NOT NULL,
    display_name    VARCHAR(80) NOT NULL DEFAULT '',
    avatar_color    VARCHAR(7) NOT NULL DEFAULT '#10a37f',
    created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_login      DATETIME NULL,
    INDEX idx_email    (email),
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────
-- SESSIONS (server-side auth tokens)
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS sessions (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    token       CHAR(64) NOT NULL UNIQUE,
    user_id     INT UNSIGNED NOT NULL,
    expires_at  DATETIME NOT NULL,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_token (token),
    INDEX idx_user  (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────
-- CHATS
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS chats (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    chat_uuid    CHAR(36) NOT NULL UNIQUE,
    user_id      INT UNSIGNED NOT NULL,
    title        VARCHAR(255) NOT NULL DEFAULT 'New chat',
    model        VARCHAR(100) NOT NULL DEFAULT 'LongCat-Flash-Chat',
    title_edited TINYINT(1) NOT NULL DEFAULT 0,
    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user    (user_id),
    INDEX idx_updated (updated_at),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────
-- MESSAGES
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS messages (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    chat_uuid  CHAR(36) NOT NULL,
    role       ENUM('user','assistant','system') NOT NULL,
    content    MEDIUMTEXT NOT NULL,
    tokens     INT UNSIGNED DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_chat (chat_uuid),
    FOREIGN KEY (chat_uuid) REFERENCES chats(chat_uuid) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────
-- API USAGE LOG
-- ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS api_logs (
    id                INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    chat_uuid         CHAR(36) NOT NULL,
    user_id           INT UNSIGNED NOT NULL,
    model             VARCHAR(100) NOT NULL,
    prompt_tokens     INT UNSIGNED DEFAULT 0,
    completion_tokens INT UNSIGNED DEFAULT 0,
    total_tokens      INT UNSIGNED DEFAULT 0,
    response_ms       INT UNSIGNED DEFAULT 0,
    status            SMALLINT UNSIGNED DEFAULT 200,
    created_at        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_chat (chat_uuid),
    INDEX idx_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
