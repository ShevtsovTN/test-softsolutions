## Test project for a Software Solutions Inc.

You can use `git clone ...` command for installing the app from the GitHub repository.
After that you must use `cd test-softsolutions && ./vendor/bin/sail up`.

### For startup project

Use `php artisan migrate:fresh --seed` for create a database tables
with a test data.

Use `php artisan serve` for running a project.

## Test assignment:

### Closed catalogue of cars
https://docs.google.com/document/d/13wr-vYCecVf6KVqUdAXZGFN2FYjX8f3cl1ndHoKeNxw/edit - rus description.

#### Description:
The system allows you to add cars to the catalog

##### Technologies:
PHP, HTML, MySQL, Laravel 8, CSS, Bootstrap 4, JavaScript, Backpack/Orchid/AdminLTE

##### Notes:
PHP code must be written according to PSR standards
You can use the Backpack, Orchid, AdminLTE and other admins
There must be separate Request classes to validate requests
Put the finished code into the GitHub or bitbucket repository
Create your readme.md and project brief and a list of commands to start the project
Administrative panel:

1. Migrate to create a user table in the database.
2. Create an Administrator Guide.
3. Make the login page/admin/login to the admin panel. The page contains the login form
4. Create migrations, models, CRUD controllers for brand, model, cars with the following data:

    Brand:
The name is input

    Model
The name is input
The brand is select

    Car
The model is select
The photo is file
Year of input production
Vehicle number input
Color is input
Transmission (Automatic/Mechanical) - select
Rent price per day - input


5. Create a seat for 3 brands, 3 models, 3 cars
    
6. Make items in the menu:
Brands
Models
Cars
Exit

7. The tag page contains the Add Tag button (leads to the tag page) and a table with a list of tags
Brand ID
Brand name
Edit button (leads to the edit page)
Delete button

8. The models page contains the Add Model button (leads to the model creation page) a table with a list of models
ID
Brand
Model
Edit button (leads to the edit page)
Delete button

9. The car page contains a button to add a car (leading to the car creation page) and a table with a list of cars

Photo
Brand
Model
Year of issue
License plate
Color
Automatic/mechanical transmission
Price per night
Edit button (leads to the edit page)
Delete button

10. Make a page-by-page navigation.

We wish you a successful test task:)
Sincerely, Software Solutions Inc.
