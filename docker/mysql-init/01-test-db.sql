-- Separate database for the test suite (DATABASE_TEST_URL)
CREATE DATABASE IF NOT EXISTS cake_test;
GRANT ALL PRIVILEGES ON cake_test.* TO 'cake'@'%';
