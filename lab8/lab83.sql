/*
This script uses CONCAT_WS to format the climbers names properly
Additionaly the script groups each climber
*/
SELECT CONCAT_WS(" ", climber_first_name, climber_last_name) as "Climber Name", COUNT(climber_climbs_established.climber_id)
  FROM climbers
 INNER JOIN climber_climbs_established ON climbers.climber_id = climber_climbs_established.climber_id
 GROUP BY climbers.climber_id
 ORDER BY COUNT(climber_climbs_established.climber_id) DESC
 LIMIT 3;