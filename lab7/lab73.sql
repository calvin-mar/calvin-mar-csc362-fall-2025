SELECT climb_name, grade_str
  FROM climbs
 INNER JOIN climb_grades ON climbs.grade_id = climb_grades.grade_id
 INNER JOIN crags ON climbs.crag_id = crags.crag_id
 INNER Join sport_climbs ON climbs.climb_id = sport_climbs.climb_id
 WHERE crags.crag_name = "Slab City";