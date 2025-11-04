SELECT  climb_name, grade_str, climb_len_ft, crag_name 
  FROM climbs
 INNER JOIN climb_grades ON climbs.grade_id = climb_grades.grade_id
 INNER JOIN crags ON climbs.crag_id = crags.crag_id
 WHERE climb_grades.grade_str = "5.9";