# BMI Calculation API

This repository is an API for BMI Calculation using Laravel Lumen Micro-Framework. This project didn't require any database connection.

## Prequisite

### Using Native PHP
1. PHP >= 7.3
2. OpenSSL PHP Extension
3. PDO PHP Extension
4. Mbstring PHP Extension
5. Composer installed

### Using Container
1. Docker installed
2. Minikube ( optional )

## Installation using Native PHP
1. Clone this repo
2. `cd` to this repo and then run `composer install`
3. copy .env.example to .env
4. run `php -S localhost:80 -t public`

## Usage
Calculate the BMI and show the Label.
* **URL**
    `/`

* **Method**
    `GET`

* **URL Params**
    | Field | Type | Description |
    | ------ | ------ | ------ | 
    | weight | Numeric | Weight input in kg |
    | height | Numeric | Height input in cm |

* **Success Response**
  ```
  HTTP/1.1 200 OK
  {
    "bmi":20.6,
    "label":"normal"
  }
  ```
  
* **Error Response**
  ```
  HTTP/1.1 422 Unprocessable Entity
  {
    "height": ["The input must be a number."]
    "weight": ["The weight field is required."]
  }
  ```
  
## License

This work is under [MIT license](https://opensource.org/licenses/MIT).
