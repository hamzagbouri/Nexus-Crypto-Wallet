CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    date_naissance DATE NOT NULL,
    nexus_id VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    usdt_balance DECIMAL(18,8) DEFAULT 0.0
);

CREATE TABLE cryptos (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    symbol VARCHAR(10) UNIQUE NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    max_supply DECIMAL(18,8),
    market_cap DECIMAL(18,8),
    price DECIMAL(18,8) NOT NULL,
    volume_24h DECIMAL(18,8),
    circulating_supply DECIMAL(18,8),
    total_supply DECIMAL(18,8)
);

CREATE TABLE wallets (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE wallet_cryptos (
    wallet_id INT REFERENCES wallets(id) ON DELETE CASCADE,
    crypto_id INT REFERENCES cryptos(id) ON DELETE CASCADE,
    balance DECIMAL(18,8) DEFAULT 0.0,
    PRIMARY KEY (wallet_id, crypto_id)
);

CREATE TABLE transactions (
    id SERIAL PRIMARY KEY,
    sender_id INT REFERENCES users(id) ON DELETE SET NULL,
    receiver_id INT REFERENCES users(id) ON DELETE SET NULL,
    crypto_id INT REFERENCES cryptos(id) ON DELETE CASCADE,
    amount DECIMAL(18,8) NOT NULL,
    transaction_type VARCHAR(10) CHECK (transaction_type IN ('buy', 'sell', 'send')) NOT NULL,
    status VARCHAR(20) CHECK (status IN ('pending', 'completed', 'failed')) NOT NULL DEFAULT 'pending',
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE notifications (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    message TEXT NOT NULL,
    read BOOLEAN DEFAULT FALSE
);

CREATE TABLE watchlists (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE watchlist_cryptos (
    watchlist_id INT REFERENCES watchlists(id) ON DELETE CASCADE,
    crypto_id INT REFERENCES cryptos(id) ON DELETE CASCADE,
    PRIMARY KEY (watchlist_id, crypto_id)
);
