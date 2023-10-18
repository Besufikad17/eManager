<?php

namespace App\Filters\V1;

use App\Filters\AppFilter;
use Illuminate\Http\Request;

class EmployeeFilter extends AppFilter {
    protected $safeParams = [
        'fname' => ['like'],
        'lname' => ['like'],
        'email' => ['like'],
        'phonenumber' => ['like'],
        'salary' => ['gt', 'lt', 'eq']
    ];

    protected $columnMap = [
        'addedAt' => 'created_at'
    ];

    protected $operatorMap = [
        'like' => 'like',
        'eq' => '=',
        'lt' => '<',
        'gt' => '>'
    ];

    public function transform(Request $request) {
        $eloQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if(!isset($query)) {
                continue;
            }

            $column = $columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if(isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
