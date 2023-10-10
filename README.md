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

| Endpoint           | Request Type | Body/Params                                                            | Response                                          | Route                       |
|--------------------|--------------|------------------------------------------------------------------------|---------------------------------------------------|-----------------------------|
| Register           | POST         | Body : { fname, lname, email,   phonenumber, password }                | { <a href="#user">user</a>, token }               | /signup                     |
| Login              | POST         | Body : { email, password }                                             | { <a href="#user">user</a>, token }               | /login                      |
| EditProfile        | PUT          | Param: { id }  Body : { fname, lname, email,   phonenumber, password } | { <a href="#user">user</a> }                      | /edit_profile/{id}          |
| UploadProfile      | POST         | Body : { title, image, user_id }                                       | { <a href="#image">image</a> }                    | /images/upload              |
| GetProfileByUserId | GET          | Param: { id }                                                          | [ img_url ]                                       | /images/{id}                |
| DeleteProfile      | DELETE       | Param: { id }                                                          | True(1) or False(0)                               | /delete_profile/{id}        |
| AddEmployee        | POST         | Body : { fname, lname, email,   phonenumber, password, salary }        | { <a href="#employee">employee</a> }              | /add                        |
| GetEmployees       | GET          |                                                                        | { <a href="#employee">employee</a>[] }            | /employees                  |
| GetEmployeeById    | GET          | Param: { id }                                                          | { <a href="#employee">employee</a> }              | /employee/{id}              |
| GetEmployeeByEmail | GET          | Param: { email }                                                       | { <a href="#employee">employee</a> }              | /employee/email/{email}     |
| Search             | GET          | Param: { text, limit?, offset? }                                       | { <a href="#employee">employee</a>[] }            | /search/{text}?limit&offset |
| EditEmployee       | PUT          | Param: { id }  Body : { fname, lname, email,   phonenumber, salary }   | { <a href="#employee">employee</a> }              | /edit/{id}                  |
| RemoveEmployee     | DELETE       | Param: { id }                                                          | True(1) or False(0) | /remove/{id}                |

### Models

<h3 id="user">user</h3>

```json
   {
      id: "user id",
      fname: "first name",
      lname: "last name",
      email: "email",
      phonenumber: "phone number",
      created_at: "timestamp for new user",
      updated_at: "timestamp for last uppdate of user"
   }
```

<h3 id="employee">employee</h3>

```json
   {
      id: "user id",
      fname: "first name",
      lname: "last name",
      email: "email",
      salary: "salary",
      phonenumber: "phone number",
      created_at: "timestamp for new employee",
      updated_at: "timestamp for last uppdate of employee"
   }
```

<h3 id="image">image</h3>

```json
   {
      title: "title of the image",
      img_path: "file path in disk",
      user_id: "uploader id",
      created_at: "timestamp for new image",
      updated_at: "timestamp for last uppdate of image"
   }
```