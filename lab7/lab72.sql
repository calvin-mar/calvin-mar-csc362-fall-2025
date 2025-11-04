SELECT climb_name, crag_name
  FROM climbs
 INNER JOIN crags on climbs.crag_id = crags.crag_id