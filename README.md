# User Activities CRM

*  Create an user-friendly admin panel with super admin login feature.
- In the admin panel the super admin should be able to create an activity for each day. The admin may add a maximum of 4 activities for each day.
- Each activity may be edited and deleted from the admin panel
- When an activity is added/edited/deleted, it should reflect for each of the users. 
- The admin should see all the registered users with their activities.
- The admin should be able to edit the activity that is added for the user. 
- The admin can also add an activity for the given user, without adding a global activity.


## Deployment

To deploy this project run

  git clone 

  .env configurations for db

  composer install

  php artisan key:generate

  php artisan migrate

  php artisan db:seed

  npm install

  npm run dev

  php artisan serve

  php artisan storage:link

