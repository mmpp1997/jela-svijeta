# Jela Svijeta Projekt

Meals project that returns data related to a specific query for a specific meal, the category it belongs to, ingredients, tags and status, all in JSON format.

### e.g. query http://127.0.0.1:8000/api/meals?per_page=2&lang=fr&category=3&tags=1,2,3&with=ingredients,tags,category&page=1&diff_time=1709376492

### repopulate database command: php artisan migrate:refresh --seed
### start command: php artisan serve      

## Additional Fixes:
### - filter meals where category !null
### - improve migration order
### - remove getContent() for response in case of error
### - return soft deleted only when there is diff_time in query
### - add request validation  
