DELIMITER //

CREATE TRIGGER hash_password_trigger
BEFORE INSERT ON TaiKhoan
FOR EACH ROW
BEGIN
    DECLARE salt VARCHAR(255);
    DECLARE hashed_password VARCHAR(255);

    -- Generate a random salt
    SET salt = SHA2(UUID(), 256);

    -- Concatenate the password and salt, then hash
    SET hashed_password = SHA2(CONCAT(NEW.MatKhauTK, salt), 256);

    -- Update the NEW password with the hashed password
    SET NEW.MatKhauTK = hashed_password;
    SET NEW.MaSaltTK = salt;
END;
//

-- DROP TRIGGER TR_HASH_MK;