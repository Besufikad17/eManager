# eManager

Simple REST API for employee management system made by using laravel.

## Installation

1. Clonning the repo
   
   ```bash
    git clone https://github.com/Besufikad17/eManager.git
   ```

2. Installing packages
   
   ```bash
    cd eManager && php composer install
    ```
3. Connecting database
   
   ```.env
   // storing DB config in .env file
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ASTU
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Running
    ```bash 
    php artisan serve
    ```

## Usage

  base-url : http://localhost:8000/api

  ### Endpoints

| Endpoint           | Request Type | Body/Params                                                            | Response            | Route                       |
|--------------------|--------------|------------------------------------------------------------------------|---------------------|-----------------------------|
| Register           | POST         | Body : { fname, lname, email,   phonenumber, password }                | { user, token }     | /signup                     |
| Login              | POST         | Body : { email, password }                                             | { user, token }     | /login                      |
| EditProfile        | PUT          | Param: { id }  Body : { fname, lname, email,   phonenumber, password } | { user }            | /edit_profile/{id}          |
| UploadProfile      | POST         | Body : { title, image, user_id }                                       | { image }           | /images/upload              |
| GetProfileByUserId | GET          | Param: { id }                                                          | [ img_url ]         | /images/{id}                |
| DeleteProfile      | DELETE       | Param: { id }                                                          | True(1) or False(0) | /delete_profile/{id}        |
| AddEmployee        | POST         | Body : { fname, lname, email,   phonenumber, password, salary }        | { employee }        | /add                        |
| GetEmployees       | GET          |                                                                        | { employee[] }      | /employees                  |
| GetEmployeeById    | GET          | Param: { id }                                                          | { employee }        | /employee/{id}              |
| GetEmployeeByEmail | GET          | Param: { email }                                                       | { employee }        | /employee/email/{email}     |
| Search             | GET          | Param: { text, limit?, offset? }                                       | { employee[] }      | /search/{text}?limit&offset |
| EditEmployee       | PUT          | Param: { id }  Body : { fname, lname, email,   phonenumber, salary }   | { employee }        | /edit/{id}                  |
| RemoveEmployee     | DELETE       | Param: { id }                                                          | True(1) or False(0) | /remove/{id}                |