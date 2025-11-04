SELECT climb_name, grade_str, trad_climb_descent
  FROM climbs
 INNER JOIN climb_grades ON climbs.grade_id = climb_grades.grade_id
 INNER JOIN trad_climbs ON climbs.climb_id = trad_climbs.climb_id;