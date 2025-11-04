SELECT grade_str, COUNT(climbs.climb_id) AS "Num Routes"
  FROM climb_grades 
  LEFT JOIN climbs ON climbs.grade_id = climb_grades.grade_id
 GROUP BY climb_grades.grade_str