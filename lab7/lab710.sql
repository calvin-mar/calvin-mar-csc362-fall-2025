SELECT grade_str, GROUP_CONCAT(climb_name) AS "Route Names"
  FROM climbs
 INNER JOIN climb_grades on climbs.grade_id = climb_grades.grade_id
 INNER JOIN crags on climbs.crag_id = crags.crag_id
 WHERE crags.crag_id = 44
 GROUP BY climb_grades.grade_id