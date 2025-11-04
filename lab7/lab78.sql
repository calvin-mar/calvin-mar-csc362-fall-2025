SELECT climber_first_name, climber_last_name
  FROM climbs
 INNER JOIN crags ON climbs.crag_id = crags.crag_id
 INNER JOIN regions ON crags.region_id = regions.region_id
 INNER JOIN climber_climbs_established ON climber_climbs_established.climb_id = climbs.climb_id
 INNER JOIN climbers ON climbers.climber_id = climber_climbs_established.climber_id
 WHERE regions.region_name = "Miller Fork"
 GROUP BY climbers.climber_first_name;