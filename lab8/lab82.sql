SET foreign_key_checks = 0;

DELETE FROM climbs
    WHERE YEAR(climbs.climb_established_date) > 2010;

SET foreign_key_checks = 1;