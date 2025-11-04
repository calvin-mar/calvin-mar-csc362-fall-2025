/*
Foreign keys cause problems, when the children still exist. So this script delets all the children of a climb first and then deletes the appropriate climb.
*/
DELETE FROM climber_climbs_established
 WHERE climber_climbs_established.climb_id IN (SELECT climb_id FROM climbs WHERE YEAR(climbs.climb_established_date) > 2010);

 DELETE FROM climber_first_ascents
 WHERE climber_first_ascents.climb_id IN (SELECT climb_id FROM climbs WHERE YEAR(climbs.climb_established_date) > 2010);

 DELETE FROM sport_climbs
 WHERE sport_climbs.climb_id IN (SELECT climb_id FROM climbs WHERE YEAR(climbs.climb_established_date) > 2010);

 DELETE FROM trad_climbs
 WHERE trad_climbs.climb_id IN (SELECT climb_id FROM climbs WHERE YEAR(climbs.climb_established_date) > 2010);

DELETE FROM climbs
    WHERE YEAR(climbs.climb_established_date) > 2010;