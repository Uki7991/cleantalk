<?php

namespace Src\App\Http\Controllers\API;

use Src\App\Models\Employee;
use Src\App\Services\EmployeeService;
use Src\App\Services\TaskService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController
{
    private EmployeeService $employeeService;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }

    public function index(Request $request)
    {
        $perPage = $request->query->get('per_page', 10);
        $page = $request->query->get('page', 1) - 1;

        $query = qb()
            ->select('*')
            ->from('employees')
            ->where('manager_id IS NULL')
            ->setFirstResult($page * $perPage)
            ->setMaxResults($perPage)
            ->getSQL();

        return new JsonResponse(
            [
                'data' => Employee::get($query, []),
                'last_page' => ceil(db()->fetchNumeric(qb()->select('COUNT(id)')->from('employees')->where('manager_id IS NULL'))[0] / $perPage)
            ]
        );
    }

    public function search(Request $request)
    {
        $q = $request->query->get('q');
        return new JsonResponse(
            $q ? Employee::get("SELECT * FROM employees where first_name LIKE ? OR last_name LIKE ? OR position LIKE ? OR CONCAT(first_name, ' ', last_name) LIKE ? LIMIT 10", ['%'.$q.'%', '%'.$q.'%', '%'.$q.'%', '%'.$q.'%']) : []
        );
    }

    public function getChildren(Request $request, $id)
    {
        $employee = Employee::firstOrFail($id);

        return new JsonResponse(
            $employee->getChildren()
        );
    }

    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $employee = $this->employeeService->create($data);

        return new JsonResponse(
            $employee,
            201
        );
    }

    public function update(Request $request, $id)
    {
        $data = json_decode($request->getContent(), true);
        $employee = $this->employeeService->update($data, $id);

        return new JsonResponse(
            $employee
        );
    }

    public function destroy(Request $request, $id)
    {
        $this->employeeService->destroy($id);

        return new JsonResponse();
    }
}