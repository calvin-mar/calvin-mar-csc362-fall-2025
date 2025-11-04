/*
This script selects the appropriate fields from each table, for some tables it fills in a blank if the actual value is NULL.
To get the list of names for both ascents and equips, subqueries are necessary to group by specific climb and concat the distinct climbers and their first and last names.
The subqueries outer joined because not every climb is has been ascended or equipped, yet they should still be shown.
*/
SELECT climbs.climb_name as "Name", climb_grades.grade_str as "Grade", climbs.climb_len_ft as "Length (ft)", crags.crag_name as "Crag", IFNULL(ascenders.all_climbers,"") as "First ascent by", IFNULL(equippers.all_climbers,"") as "Equipped by" 
 FROM climbs
INNER JOIN climb_grades ON climb_grades.grade_id = climbs.grade_id
INNER JOIN crags ON crags.crag_id = climbs.crag_id
LEFT OUTER JOIN (SELECT GROUP_CONCAT(CONCAT_WS(" ",climber_first_name, climber_last_name)) as all_climbers, climber_climbs_established.climb_id as climb_id
              FROM climbers 
             INNER JOIN climber_climbs_established ON climbers.climber_id = climber_climbs_established.climber_id
             GROUP BY climb_id
            ) equippers ON equippers.climb_id = climbs.climb_id
LEFT OUTER JOIN (SELECT GROUP_CONCAT(CONCAT_WS(" ",climber_first_name, climber_last_name)) as all_climbers, climber_first_ascents.climb_id as climb_id
              FROM climbers 
             INNER JOIN climber_first_ascents ON climbers.climber_id = climber_first_ascents.climber_id
             GROUP BY climb_id
            ) ascenders ON ascenders.climb_id = climbs.climb_id