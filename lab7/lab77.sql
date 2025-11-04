SELECT  climb_name, sport_climb_bolts, GROUP_CONCAT(climber_forum_handle) AS "FA Party"
  FROM climbs
 INNER JOIN sport_climbs ON climbs.climb_id = sport_climbs.climb_id
 INNER JOIN climber_first_ascents ON climbs.climb_id = climber_first_ascents.climb_id
 INNER JOIN climbers ON climber_first_ascents.climber_id = climbers.climber_id
 GROUP BY climber_first_ascents.climb_id