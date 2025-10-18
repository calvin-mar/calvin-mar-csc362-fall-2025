 SELECT instruments.instrument_id, instrument_type, student_name 
   FROM instruments
        LEFT OUTER JOIN student_instruments
        ON (instruments.instrument_id = student_instruments.instrument_id)
        LEFT OUTER JOIN students
        ON (student_instruments.student_id = students.student_id);