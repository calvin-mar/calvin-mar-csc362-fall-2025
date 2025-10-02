# Business Rule Specifications

## Rule Information

| Feature           | Value                     |
|-------------------|---------------------------|
| Rule Statement    | Dates must valid, returns |
|                   |  cannot occur before      |
|                   |  purchases or trials      |
| Constraint        | rug_return_date and       |
|                   |  rug_trial_actual_return  |
|                   |  may not be earlier than  |   
|                   |  rug_trial_date or        |
|                   |  rug_sale_date            |
| Type              | [ ] Database Oriented     |
|                   | [X] Application Oriented  |
|                   |                           |
| Category          | [X] Field Specific        |
|                   | [ ] Relationship Specific |
|                   |                           |
| Test On           | [ ] Insert                |
|                   | [ ] Delete                |
|                   | [X] Update                |


## Structures Affected

| Feature           | Value                     |
|-------------------|---------------------------|
| Field Names       | rug_trial_date,           |
|                   | rug_return_date,          |
|                   | rug_sale_date  ,          |
|                   | rug_trial_actual_return   |
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
- [X] Range of Values
- [ ] Edit Rule


## Relationship Characteristics Affected
- [ ] Deletion rule
- [ ] Type of participation
- [ ] Degree of participation

    
## Action Taken
List changes made to database structure or application in order to implement this rule.
At application level, disallow dates to be added to the field rug_trial_actual_return and rug_return_date that are earlier than rug_trial_date and rug_sale_date respectively.

## Notes

