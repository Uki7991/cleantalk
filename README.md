cp .env.example .env

docker-compose up -d --build

http available in 8080 port

### Routes:
- http://localhost:8080/api/employees [GET] - Get list of paginated parent employees
- http://localhost:8080/api/employees/:id/childre [GET] - Get list of children of employee
- http://localhost:8080/api/employees/search [GET] - Get list of employees by search query
- http://localhost:8080/api/employees [POST] - Create an employee
- http://localhost:8080/api/employees/:id [PUT] - Update employee
- http://localhost:8080/api/employees/:id [DELETE] - Delete employee
