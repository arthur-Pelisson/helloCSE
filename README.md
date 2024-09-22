# HelloCSE test technique 

Technique test made withLaravel.

Feel free to use my Postman collection and set up the Postman environment => [<img src="https://run.pstmn.io/button.svg" alt="Run In Postman" style="width: 128px; height: 32px;">](https://app.getpostman.com/run-collection/4965583-11f53d4b-7cc8-458a-a738-2c8258288ff1?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D4965583-11f53d4b-7cc8-458a-a738-2c8258288ff1%26entityType%3Dcollection%26workspaceId%3D1d6284f1-b336-444b-9d20-661dd7650725#?env%5Blocal%5D=W3sia2V5IjoidG9rZW4iLCJ2YWx1ZSI6IiIsImVuYWJsZWQiOnRydWUsInR5cGUiOiJkZWZhdWx0Iiwic2Vzc2lvblZhbHVlIjoiIiwic2Vzc2lvbkluZGV4IjowfSx7ImtleSI6InByb2ZpbGlEIiwidmFsdWUiOiIiLCJlbmFibGVkIjp0cnVlLCJ0eXBlIjoiZGVmYXVsdCIsInNlc3Npb25WYWx1ZSI6IiIsInNlc3Npb25JbmRleCI6MX1d)

## Run Locally  

Clone the project  

~~~bash  
  git clone https://github.com/arthur-Pelisson/helloCSE.git
~~~

Go to the project directory  

~~~bash  
  cd helloCSE
~~~

Install dependencies  

~~~bash  
composer install
~~~

Configure .env to connect with mysql database

Then migrate it
~~~bash  
php artisan migrate
~~~

Seed database 

~~~bash  
php artisan db:seed
~~~

Start the server  

~~~bash  
php artisan serve
~~~

## Test 

~~~bash  
php artisan test
~~~

## Documentation
~~~bash  
http://{uri}:{post}/docs/api
~~~
## Debug tools 
~~~bash  
http://{uri}:{port}/telescope
~~~