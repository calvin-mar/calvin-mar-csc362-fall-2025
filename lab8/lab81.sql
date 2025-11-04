/*This update use subqueries to determine which grade_id is pairerd with the appropriate string
It then changes the id that is in the climbs record to the necessary one.
*/
UPDATE climbs
   SET climbs.grade_id = (SELECT grade_id FROM climb_grades WHERE grade_str="5.10b")
 WHERE climbs.grade_id = (SELECT grade_id FROM climb_grades WHERE grade_str="5.10a");
