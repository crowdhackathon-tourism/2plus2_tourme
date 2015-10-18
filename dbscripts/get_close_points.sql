DROP PROCEDURE IF EXISTS `get_close_points`;
DELIMITER //
-- based on http://www.plumislandmedia.net/mysql/haversine-mysql-nearest-loc/



-- distance_unit is NULL or any value to default to km, 'miles' to use miles
CREATE PROCEDURE get_close_points (IN latpoint DECIMAL(10,6), longpoint DECIMAL(10,6),
									IN radius DECIMAL(8,3), IN distance_units CHAR(10), 
									IN `limit` INT,  IN exclude_user_id BIGINT(20))

BEGIN
DECLARE distance_constant DECIMAL(8,3) DEFAULT 111.045;
	IF distance_units = 'miles' THEN SET distance_constant = 69.0; END IF;
	IF ISNULL(`limit`) THEN SET `limit` = 10; END IF;
	IF ISNULL(exclude_user_id) THEN SET exclude_user_id = -1; END IF;

SELECT * FROM (
	SELECT meta.meta_value as user_photo_url, z.*, distance_constant
				* DEGREES(ACOS(COS(RADIANS(latpoint))
				* COS(RADIANS(z.loc_latitude))
				* COS(RADIANS(longpoint - z.loc_longitude))
				+ SIN(RADIANS(latpoint))
				* SIN(RADIANS(z.loc_latitude)))) AS distance
	FROM tm_adventures AS z
	LEFT JOIN (SELECT user_id, meta_value FROM wp_usermeta fp WHERE meta_key='oa_social_login_user_picture') 
		AS meta ON (z.user_id = meta.user_id) 
	WHERE z.loc_latitude
		BETWEEN latpoint  - (radius / distance_constant)
			AND latpoint  + (radius / distance_constant)
	AND z.loc_longitude
		BETWEEN longpoint - (radius / (distance_constant * COS(RADIANS(latpoint))))
			AND longpoint + (radius / (distance_constant * COS(RADIANS(latpoint))))
 AND z.user_id <> exclude_user_id
) AS d
WHERE distance <= radius
ORDER BY distance
LIMIT `limit`;
END //
DELIMITER ;

-- Get points close to Athens,Greeece
-- CALL get_close_points(37.983917, 23.7293599, 500.0, NULL, NULL, NULL);

-- Get points close to Greenwich
-- CALL get_close_points(51.482577, 0.0, 2000.0, 'miles', 100, NULL);