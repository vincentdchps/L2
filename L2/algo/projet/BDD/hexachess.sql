-- 1
CREATE DATABASE hexachess;
USE hexachess;

-- 2
CREATE TABLE players (
    player_id CHAR(11) PRIMARY KEY,
    handle VARCHAR(32) NOT NULL,
    email VARCHAR(254) NOT NULL,
    password_hash VARCHAR(64) NOT NULL,
    display_name VARCHAR(1024),
    avatar VARCHAR(260),
    birthday DATE,
    sex VARCHAR(32),
    rating INT DEFAULT 1200,
    location VARCHAR(128),
    joined_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME,
    last_login DATETIME,
    is_verified BOOLEAN DEFAULT 0,
    is_banned BOOLEAN DEFAULT 0,


    CONSTRAINT uq_players_handle UNIQUE (handle),
    CONSTRAINT uq_players_email UNIQUE (email),

    CONSTRAINT chk_players_rating CHECK (rating >= 0)
);

SELECT handle, COUNT(*) 
FROM players 
GROUP BY handle 
HAVING COUNT(*) > 1;

SELECT email, COUNT(*) 
FROM players 
GROUP BY email 
HAVING COUNT(*) > 1;

-- 3
CREATE TABLE achievements (
    achievement_id CHAR(11) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255)
);

-- 4
CREATE TABLE puzzles (
    puzzle_id CHAR(11) PRIMARY KEY,
    moves TEXT NOT NULL,
    solutions TEXT NOT NULL,
    rating INT,
    theme VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT chk_puzzles_rating CHECK (rating >= 0)
);

-- 5
CREATE TABLE tournaments (
    tournament_id CHAR(11) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    start_time DATETIME,
    end_time DATETIME,
    winner_id CHAR(11),

    CONSTRAINT fk_tournaments_winner FOREIGN KEY (winner_id) REFERENCES players(player_id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT chk_tournaments_dates CHECK (end_time >= start_time)
);


SELECT * FROM tournaments WHERE end_time < start_time;

-- 6
CREATE TABLE games (
    game_id CHAR(11) PRIMARY KEY,
    white_player_id CHAR(11) NOT NULL,
    black_player_id CHAR(11) NOT NULL,
    winner_id CHAR(11),
    tournament_id CHAR(11),
    moves TEXT,
    start_time DATETIME,
    end_time DATETIME,
    victory_type CHAR(9), 

    CONSTRAINT fk_games_white FOREIGN KEY (white_player_id) REFERENCES players(player_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_games_black FOREIGN KEY (black_player_id) REFERENCES players(player_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_games_winner FOREIGN KEY (winner_id) REFERENCES players(player_id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_games_tournament FOREIGN KEY (tournament_id) REFERENCES tournaments(tournament_id)
        ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT chk_games_players_diff CHECK (white_player_id <> black_player_id),
    CONSTRAINT chk_games_dates CHECK (end_time >= start_time)
);

SELECT * FROM games WHERE white_player_id = black_player_id;

-- 7
CREATE TABLE settings (
    player_id CHAR(11) PRIMARY KEY, 
    theme VARCHAR(255) DEFAULT 'default',
    show_legal_moves BOOLEAN DEFAULT 1,
    auto_promote_queen BOOLEAN DEFAULT 0,
    ai_difficulty_level INT DEFAULT 1,

    CONSTRAINT fk_settings_player FOREIGN KEY (player_id) REFERENCES players(player_id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT chk_settings_ai_level CHECK (ai_difficulty_level BETWEEN 1 AND 20)
);

