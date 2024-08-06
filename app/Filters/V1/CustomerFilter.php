<?php

namespace  App\Filters\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerFilter{

    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'addres' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];

    public function transform(Request $request){

        $eloQuery = [];


        foreach($this->safeParams as $parm => $operators){

            $query = $request->query($parm);

            Log::info($query);

            if (!isset($query)){
                continue;
            };

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator){
                if (isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }

        }

        return $eloQuery;

    }

}
