<?php

namespace Src\App\Services;

use App\Models\Model;
use Src\App\Models\Employee;

class EmployeeService
{
    public function create(array $data): Employee
    {
        $employee = new Employee([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'position' => $data['position'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'manager_id' => $data['managerId'],
            'notes' => $data['notes'],
        ]);
        $employee->save();

        return $employee;
    }

    public function update($data, $id): Employee
    {
        $employee = Employee::firstOrFail($id);

        $employee->update([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'position' => $data['position'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'manager_id' => $data['managerId'],
            'notes' => $data['notes'],
        ]);

        return $employee->refresh();
    }

    public function destroy($id): void
    {
        $employee = Employee::firstOrFail($id);
        $children = $employee->getChildren();

        foreach ($children as $child) {
            /**
             * @var Model $child
             */
            $child->update(['manager_id' => $employee->manager_id]);
        }

        $employee->delete();
    }
}