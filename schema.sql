--Creation de database 
create database spotify ;

--creation de tableau users 
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL, -- Mot de passe hashé avec bcrypt
    role VARCHAR(20) NOT NULL CHECK (role IN ('guest', 'user', 'artist', 'admin')), -- Rôle de l'utilisateur
    artist_name VARCHAR(100), -- Nom de l'artiste (si l'utilisateur est un artiste)
    bio TEXT, -- Biographie de l'artiste (si l'utilisateur est un artiste)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--creation de tableau des chansons 
CREATE TABLE songs (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE, -- L'utilisateur qui a uploadé la chanson
    file_path VARCHAR(255) NOT NULL, -- Chemin du fichier audio
    duration INT NOT NULL, -- Durée en secondes
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--  creation de tableau des playlists
CREATE TABLE playlists (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    is_public BOOLEAN DEFAULT TRUE, -- Visibilité de la playlist
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- creation de tableau de liaison entre les playlists et les chansons
CREATE TABLE playlist_songs (
    playlist_id INT NOT NULL REFERENCES playlists(id) ON DELETE CASCADE,
    song_id INT NOT NULL REFERENCES songs(id) ON DELETE CASCADE,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (playlist_id, song_id)
);

-- creation de tableau des chansons aimées par les utilisateurs
CREATE TABLE liked_songs (
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    song_id INT NOT NULL REFERENCES songs(id) ON DELETE CASCADE,
    liked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, song_id)
);

-- creation de tableau des playlists suivies par les utilisateurs
CREATE TABLE followed_playlists (
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    playlist_id INT NOT NULL REFERENCES playlists(id) ON DELETE CASCADE,
    followed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, playlist_id)
);

-- creation de tableau des commentaires sur les chansons
CREATE TABLE song_comments (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    song_id INT NOT NULL REFERENCES songs(id) ON DELETE CASCADE,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- creation de tableau des notes attribuées aux chansons
CREATE TABLE song_ratings (
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    song_id INT NOT NULL REFERENCES songs(id) ON DELETE CASCADE,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5), -- Note entre 1 et 5
    rated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, song_id)
);

--creation de tableau des notifications 
CREATE TABLE notifications (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


--insertion dans users 
INSERT INTO users (username, email, password_hash, role, artist_name, bio, created_at)
VALUES
    ('john_doe', 'john@example.com', 'hashed_password_123', 'user', NULL, NULL, NOW()),
    ('jane_doe', 'jane@example.com', 'hashed_password_456', 'artist', 'Jane Doe', 'A talented musician.', NOW()),
    ('alice_smith', 'alice@example.com', 'hashed_password_789', 'user', NULL, NULL, NOW()),
    ('bob_jones', 'bob@example.com', 'hashed_password_101', 'artist', 'Bob Jones', 'Rock and roll enthusiast.', NOW()),
    ('charlie_brown', 'charlie@example.com', 'hashed_password_112', 'admin', NULL, NULL, NOW()),
    ('diana_ross', 'diana@example.com', 'hashed_password_131', 'artist', 'Diana Ross', 'Soul and R&B legend.', NOW());

--insetion dans tableau songs 
INSERT INTO songs (title, user_id, file_path, duration, created_at)
VALUES
    ('Song One', 2, '/path/to/song1.mp3', 240, NOW()),
    ('Song Two', 2, '/path/to/song2.mp3', 180, NOW()),
    ('Song Three', 4, '/path/to/song3.mp3', 210, NOW()),
    ('Song Four', 4, '/path/to/song4.mp3', 300, NOW()),
    ('Song Five', 6, '/path/to/song5.mp3', 150, NOW()),
    ('Song Six', 6, '/path/to/song6.mp3', 270, NOW());

--insertion dans tableau playlist 
INSERT INTO playlists (name, user_id, is_public, created_at)
VALUES
    ('My Favorite Songs', 1, TRUE, NOW()),
    ('Rock Classics', 3, TRUE, NOW()),
    ('Chill Vibes', 5, FALSE, NOW()),
    ('Workout Playlist', 1, TRUE, NOW()),
    ('90s Hits', 3, TRUE, NOW()),
    ('Soulful Tunes', 5, FALSE, NOW());

--insertion dans playlist songs 
INSERT INTO playlist_songs (playlist_id, song_id, added_at)
VALUES
    (1, 1, NOW()),
    (1, 2, NOW()),
    (2, 3, NOW()),
    (2, 4, NOW()),
    (3, 5, NOW()),
    (3, 6, NOW()),
    (4, 1, NOW()),
    (4, 3, NOW()),
    (5, 2, NOW()),
    (5, 4, NOW()),
    (6, 5, NOW()),
    (6, 6, NOW());

--insertion like songs 
INSERT INTO liked_songs (user_id, song_id, liked_at)
VALUES
    (1, 1, NOW()),
    (1, 2, NOW()),
    (3, 3, NOW()),
    (3, 4, NOW()),
    (5, 5, NOW()),
    (5, 6, NOW());

--insertion dans followed playlist    
INSERT INTO followed_playlists (user_id, playlist_id, followed_at)
VALUES
    (1, 2, NOW()),
    (1, 3, NOW()),
    (3, 1, NOW()),
    (3, 4, NOW()),
    (5, 2, NOW()),
    (5, 5, NOW());     

--insertion dans songs-commments
INSERT INTO song_comments (user_id, song_id, comment, created_at)
VALUES
    (1, 1, 'Great song!', NOW()),
    (1, 2, 'Love this one!', NOW()),
    (3, 3, 'Awesome track!', NOW()),
    (3, 4, 'Perfect for my playlist.', NOW()),
    (5, 5, 'So relaxing!', NOW()),
    (5, 6, 'A true classic.', NOW());

--insertion dans song-rating 
INSERT INTO song_ratings (user_id, song_id, rating, rated_at)
VALUES
    (1, 1, 5, NOW()),
    (1, 2, 4, NOW()),
    (3, 3, 5, NOW()),
    (3, 4, 3, NOW()),
    (5, 5, 4, NOW()),
    (5, 6, 5, NOW());

--insertions dans songs-notification 
INSERT INTO notifications (user_id, message, is_read, created_at)
VALUES
    (1, 'Your playlist has been updated.', FALSE, NOW()),
    (2, 'Your song has been added to a playlist.', FALSE, NOW()),
    (3, 'A new song is available.', FALSE, NOW()),
    (4, 'Your song has received a new rating.', FALSE, NOW()),
    (5, 'A user followed your playlist.', FALSE, NOW()),
    (6, 'Your song has been commented on.', FALSE, NOW());