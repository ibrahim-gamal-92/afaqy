
## How to install and run your task

git clone https://github.com/ibrahim-gamal-92/afaqy

add database name to .env file

composer install

## How to expose the Endpoint

You can access the endpoint through base_url/api/v1/expenses

just add Accept:application/json to headers

## How to make a search, filter, and sorting

name param is mandatory 

types is coma sperated values of fuel,insurance,service [one or more]

minCost & maxCost are numiric values

minDate & maxDate are date values

sort is text value from cost or createdAt values

direction is text value from asc or desc

http://localhost:8000/api/v1/expenses?name=Prof&types=fuel,insurance&sort=cost&direction=asc&minCost=2&maxCost=5&minDate=2017-01-01&maxDate=2020-01-01
