# Business Rule Specifications

## Rule Information

| Feature           | Value                     |
|-------------------|---------------------------|
| Rule Statement    | A customer may have a     |
|                   | maximum of 4 rugs on trial|
| Constraint        | A customer_ID may appear  |
|                   |  no more than 4 times in  |
|                   |  the rug_trials table     |
|                   |  where there is a NULL    |
|                   | in rug_trial_actual_return|
|                   | or rug_trial_purchased.   |
| Type              | [ ] Database Oriented     |
|                   | [X] Application Oriented  |
|                   |                           |
| Category          | [ ] Field Specific        |
|                   | [X] Relationship Specific |
|                   |                           |
| Test On           | [X] Insert                |
|                   | [ ] Delete                |
|                   | [ ] Update                |


## Structures Affected

| Feature           | Value                     |
|-------------------|---------------------------|
| Field Names       | customer_id               |
|                   |  rug_trial_actual_return  |
|                   |  rug_trial_purchased      |
| Table Names       | rug_trials                |


## Field Elements Affected
Mark each element which is affected by this rule.

### Physical Elements
- [ ] Data Type
- [ ] Length
- [ ] Character Support

### Logical Elements
- [ ] Key Type
- [ ] Key Structure
- [ ] Uniqueness
- [ ] Null Support
- [ ] Values Entered By
- [ ] Range of Values
- [ ] Edit Rule


## Relationship Characteristics Affected
- [ ] Deletion rule
- [ ] Type of participation
- [X] Degree of participation

    
## Action Taken
List changes made to database structure or application in order to implement this rule.

At application level, disallow additions to the rug_trials table if there are 4 records
in the table that contain the same customer_id and do not have a TRUE value in rug_trial_purchased or a date in rug_trial_actual_return

## Notes

