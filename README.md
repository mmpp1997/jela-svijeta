# Jela Svijeta Projekt

Meals project that returns data related to a specific query for a specific meal, the category it belongs to, ingredients, tags and status, all in JSON format.

e.g. query http://127.0.0.1:8000/api/meals?per_page=2&lang=en&category=5&tags=1,2,3,4&with=ingredients,tags,category&page=1

repopulate database command: php artisan migrate:refresh --seed
start command: php artisan serve        
