-- Create Database
CREATE DATABASE nexus;
\c nexus;

-- Users Table
CREATE TABLE users (
                       id_user SERIAL PRIMARY KEY,
                       full_name VARCHAR(255),
                       date_naissance VARCHAR(255),
                       nexus_id VARCHAR(255) UNIQUE,
                       email VARCHAR(255) UNIQUE,
                       password VARCHAR(255),
                       usdt_balance FLOAT DEFAULT 0,
                       date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crypto Table

-- Wallet Table (One Wallet per User)
CREATE TABLE wallet (
                        id_wallet SERIAL PRIMARY KEY,
                        id_user INT UNIQUE,
                        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Wallet-Crypto Junction Table (Many-to-Many)
CREATE TABLE wallet_crypto (
                               id_wallet INT,
                               id_crypto varchar(255),
                               amount FLOAT DEFAULT 0,
                               FOREIGN KEY (id_wallet) REFERENCES wallet(id_wallet) ON DELETE CASCADE
);

-- Transactions Table (User ↔ Crypto)
CREATE TABLE transaction (
                             id_trans SERIAL PRIMARY KEY,
                             amount FLOAT,
                             transaction_type VARCHAR(255),
                             status VARCHAR(255),
                             transaction_date DATE,
                             id_user INT,
                             id_receiver INT,
                             id_crypto varchar(255) unique ,
                             prix_crypto FLOAT,
                             date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
                             FOREIGN KEY (id_receiver) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Watchlist Table (One Watchlist per User)
CREATE TABLE watchlist (
                           id_watchlist SERIAL PRIMARY KEY,
                           id_user INT ,
                           id_crypto varchar(255) ,
                           date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                           FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);

-- Watchlist-Crypto Junction Table (Many-to-Many)
CREATE TABLE watchlist_crypto (
                                  id_watchlist INT,
                                  id_crypto varchar(255),
                                  PRIMARY KEY (id_watchlist, id_crypto),
                                  FOREIGN KEY (id_watchlist) REFERENCES watchlist(id_watchlist) ON DELETE CASCADE
);

-- Notification Table (User ↔ Notifications)
CREATE TABLE notification (
                              id_notif SERIAL PRIMARY KEY,
                              message TEXT NOT NULL,
                              date DATE,
                              id_user INT,
                              date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE
);
