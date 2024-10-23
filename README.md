# Gigs API

## Passport Implementation
Add the following in `.env` file for password grant:
- `PASSWORD_GRANT_CLIENT_ID=`
- `PASSWORD_GRANT_CLIENT_SECRET=`

## Swagger implementation 
Add this to your `.env` file for Swagger:
- `L5_SWAGGER_UI_PERSIST_AUTHORIZATION=true`

To generate Swagger documentation, execute:
- `php artisan l5-swagger:generate`

- Example for displaying docs: [http://gigs.devs/api/documentation]

## Command Line
Execute this command in the terminal to calculate the posted rate:
- `php artisan app:posted-rate` - This command calculates the posted rate for gigs.


## Start APP
1. Run `composer install` to install dependencies.
2. Run `php artisan migrate` to migrate the database.
3. Generate Swagger documentation: `php artisan l5-swagger:generate`
4. Calculate the posted rate: `php artisan app:posted-rate`

## Challenge
 For handling large quantities of data, it's best to use:
- **Database Optimization**: Improve query performance and indexing.
- **Caching(Redis or Memcached)**: Store accessed data in memory.