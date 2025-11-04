SELECT grade_str
  FROM climbs
 INNER JOIN climb_grades ON climbs.grade_id = climb_grades.grade_id
 INNER JOIN crags ON climbs.crag_id = crags.crag_id
 INNER JOIN regions ON crags.region_id = regions.region_id
 INNER JOIN owners ON regions.owner_id = owners.owner_id
 WHERE owners.owner_name = "John and Elizabeth Muir"
 GROUP BY climb_grades.grade_str;