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
2. docker-compose installed

## Installation

### Development Environment using Native PHP
1. Clone this repo
2. `cd` to this repo and then run `composer install`
3. copy .env.example to .env
4. run `php -S localhost:80 -t public`
5. api now accessible locally for development environment

### Development Environment using Container
1. Clone this repo
2. `cd` to this repo and copy .env.example file into .env file and edit the configuration
3. in root directory, run `docker-compose up -d`
4. for the first installation, execute `docker-compose exec bmi-calculation-api composer install` to install the vendor & library
5. api now accessible locally for development environment

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
* **Example**
  `curl 'http://localhost/?height=167&weight=70'`
  **Response**
  ```
  HTTP/1.1 200 OK
  {
    "bmi":25.1,
    "label":"overweight"
  }
  ```

## Deploy

### Stack
The stack that used in this image are :
- PHP+apache
- Laravel Lumen
- PaperTrail Centralize Logging
- NewRelic
- Sentry Error Tracking ( Also Integrated with Gitlab )

### Deploy Stage
CI/CD only consist 2 stage :
1. build docker image and then push into gitlab container registry 
2. deploy using docker-compose into server using Gitlab-CI Runner Shell Executor

### Deployed Container
The deployed container would be 3 container, which is :
- BMI-API Container
- PaperTrail Logging
- Newrelic-Daemon

## Current Live API
This API was deployed on this server below
`https://bmi.aripratama.com`
The container sit behind NGINX reverse proxy

## License

This work is under [MIT license](https://opensource.org/licenses/MIT).
