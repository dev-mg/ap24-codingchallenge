# TODO / Improvements

- directory structure
- phpunit tests
- api auth etc.

# Comments

- HTTP methods: POST vs PUT
	
# HOWTO
	
## Docker

    docker build -t api .
    docker -dp 80:8080 api

OR

    docker compose up
	
## CURL

    curl -L http://localhost/test/1234 -X POST -H "Accept: application/json" -H "Content-Type: application/json" -d "{\"mileage\":12,\"preowners\":1}"
    curl -L http://localhost/test/1234 -X POST -H "Accept: application/json" -H "Content-Type: application/json" -d "{\"mileage\":"asdf",\"preowners\":0}"
    curl -L http://localhost/test/AB -X POST -H "Accept: application/json" -H "Content-Type: application/json" -d "{\"mileage\":12,\"preowners\":1}"
