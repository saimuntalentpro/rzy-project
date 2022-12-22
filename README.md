## Real State Application
A simple application where try to do maintain best practices

## Ports

Ports used in the project:
| Project| Port |
|-------------- | -------------- |
| **real-state-boilerplate** | 8000 |


### Project

To get started, make sure you have to clone this repository.

1. Clone this project:

   ```sh
   git clone https://github.com/saimunhossain/real-state-boilerplate.git
   ```
2. Inside the folder `real-state-boilerplate` and run the next command:

   ```sh
   composer update
   ```

3. Generate your own `.env` with the next command:

   ```sh
   cp .env.example .env
   ```
4. Generate your own application `key` with the next command:

   ```sh
   php artisan key:generate
   ```
5. Make sure you have **Connected** your database to `.env` file and run the next command to migrate database and seeds data:

   ```sh
   php artisan migrate --seed
   ```

6. Run the project whit the next commands and open the project in this port `http://localhost:8000/api/v1/product` :

   ```sh
   php artisan serve
   ```
6. For Swagger go to this link `http://localhost:8000/api/documentation` :
---
