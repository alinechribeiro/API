# PHP-API
API project using Laravel/Lumen framework to provide REST API server

## Instructions

1. Clone the project 

2. Create database "rockar"

3. Create database user

4. Open the file .env and change the fields 

  DB_DATABASE=<CHANGE HERE>
  DB_USERNAME=<CHANGE HERE>
  DB_PASSWORD=<CHANGE HERE>
  
5. Go to the project directory and run the database migration with the command line: php artisan migrate

6. Inside the project directory enter the command line to start the server on port 5555
  ```$ php -S localhost:5555 -t public```

### Testing the API:
**/getCustomerRequest (POST)**

	The following fields are mandatory to be sent on the request.
		 *  identifier: string. > Column to be searched. Possible values: 'forename', 'surname', 'email', 'contact_number', 'postcode'.
		 *  identifierField: string. > Value to search for e.g.: 'Tom'.
		 *  fields: array. > Which fields will be returned on the response. Possible values: ['forename', 'surname', 'email', 'contact_number', 'postcode'] or use ['*'] for all.
		 
	Sample wget call: 
	
	```$ wget --no-check-certificate --quiet --method POST --timeout=0 --header 'Content-Type: application/json' --body-data '{"identifier": "forename", "identifierField": "Tom", "fields": ["surname","postcode"]}' 'http://localhost:5555/getCustomerRequest/'```
	
	
**/getProductRequest  (POST)**

	The following fields are mandatory to be sent on the request.
		 *  identifier: string. > Column to be searched. Possible values: 'vin', 'make', 'model', 'colour', 'price'.
		 *  identifierField: string. > Value to search for e.g.: 'Ford'.
		 *  fields: array. > Which fields will be returned on the response. Possible values: ['vin', 'make', 'model', 'colour', 'price'] or use ['*'] for all.
		 
	Sample wget call: 
	
	```$ wget --no-check-certificate --quiet --method POST --timeout=0 --header 'Content-Type: application/json' --body-data '{"identifier": "vin", "identifierField": "ASDF123456", "fields": ["colour","make"]}' 'http://localhost:5555/getProductRequest/'```
	
#### PHP Unit Tests: 
1. On the project root directory, run: 
```$ vendor/bin/phpunit```
Expected result: 5 tests, 7 assertions.
