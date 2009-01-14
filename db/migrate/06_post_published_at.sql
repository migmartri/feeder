ALTER TABLE posts DROP COLUMN created_at;
ALTER TABLE posts ADD published_at DATETIME;
