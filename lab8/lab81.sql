UPDATE climbs
   SET climbs.grade_id = (SELECT grade_id FROM climb_grades WHERE grade_str="5.10b")
 WHERE climbs.grade_id = (SELECT grade_id FROM climb_grades WHERE grade_str="5.10a");
