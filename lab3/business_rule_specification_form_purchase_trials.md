# Business Rule Specifications

## Rule Information

| Feature           | Value                     |
|-------------------|---------------------------|
| Rule Statement    | A rug cannot be unreturned|
|                   |  in purchases and be in   |
|                   |  currently trialed        |
| Constraint        | A record with a not null  |
|                   |  return date cannot have  |
|                   |  an identical rug_id to a |
|                   |  record in rug_trials     |
|                   |  that does not have a TRUE|
|                   |  in rug_trial_purchased   |
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
| Field Names       | rug_id, rug_return_date   |
|                   |  rug_trial_purchased      |
| Table Names       | rug_trials, rug_sales     |


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
At the application level, additions cannot be made to rug_sales when a there exists a record in rug_trials with an identical rug_id that does not have TRUE value in rug_trials_purchased or does a non NULL value in rug_trial_actual_return.

## Notes

