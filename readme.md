Deploying

Set environment variables;
Create a google map api key and fill the MAP_API_KEY env property as well.
generate app key and set the app key. 

run ``php artisan key:generate``

run ``php artisan migrate`` to make the database tables.

run ``php artisan storage:link`` create the link with media library and storage.

run ``php artisan db:seed`` to fill the default data to database.

run ``php artisan serve``
