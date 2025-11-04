SELECT climber_first_name, climber_last_name, cg.grade_str
  FROM climbs
 INNER JOIN 
       (SELECT grade_str, MAX(cg.grade_id) as grade_id 
          FROM climbs
          INNER JOIN climb_grades cg ON cg.grade_id = climbs.grade_id
          INNER JOIN climber_climbs_established ON climbs.climb_id = climber_climbs_established.climb_id
          INNER JOIN climbers ON climber_climbs_established.climber_id = climbers.climber_id
          GROUP BY climbers.climber_id) cg
        ON cg.grade_id = climbs.grade_id
 INNER JOIN climber_climbs_established ON climbs.climb_id = climber_climbs_established.climb_id
 INNER JOIN climbers ON climber_climbs_established.climber_id = climbers.climber_id
 GROUP BY climbers.climber_id;