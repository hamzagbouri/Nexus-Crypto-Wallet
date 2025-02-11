CREATE DATABASE nexus;
\c nexus;

CREATE TABLE user (
  id_user SERIAL PRIMARY KEY, 
  full_name VARCHAR(255),
  date_naissance VARCHAR(255),  
  nexus_id VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  usdt_balance FLOAT
);

CREATE TABLE crypto (
  id_crypto SERIAL PRIMARY KEY,
  nom VARCHAR(255),
  symbol VARCHAR(255),
  slug VARCHAR(255),
  max_supply FLOAT,
  min_supply FLOAT,
  market_cap FLOAT,  
  price FLOAT,
  volume_24h FLOAT,  
  circulating_supply FLOAT  
);

CREATE TABLE transaction (
  id_trans SERIAL PRIMARY KEY,
  amount FLOAT,
  transaction_type VARCHAR(255),
  status VARCHAR(255),
  date DATE,
  id_user INT,
  id_crypto INT,
  FOREIGN KEY (id_user) REFERENCES user(id_user),
  FOREIGN KEY (id_crypto) REFERENCES crypto(id_crypto)
);

CREATE TABLE watchList (  
  id_watchList SERIAL PRIMARY KEY,
  id_crypto INT,
  id_user INT,
  FOREIGN KEY (id_crypto) REFERENCES crypto(id_crypto),
  FOREIGN KEY (id_user) REFERENCES user(id_user)
);

CREATE TABLE notification (
  id_notif SERIAL PRIMARY KEY,
  date DATE,
  id_user INT,
  FOREIGN KEY (id_user) REFERENCES user(id_user)  
);

CREATE TABLE wallet (
  id_wallet SERIAL PRIMARY KEY,
  amount FLOAT,
  id_user INT,
  FOREIGN KEY (id_user) REFERENCES user(id_user)
);