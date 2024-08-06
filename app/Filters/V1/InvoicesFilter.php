<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;

class InvoicesFilter{

    protected $safeParams = [
        'id' => ['eq', 'gt', 'lt'],
        'customerId' => ['eq', 'gt', 'lt'],
        'amount' => ['eq', 'gt', 'lt'],
        'status' => ['eq'],
        'billedDate' => ['eq', 'gt', 'lt'],
        'paidDate' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'customer_id' => 'customerId',
        'billed_date' => 'billedDate',
        'paid_date' => 'paidDate'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];

    public function transform(Request $request)
    {

        $eloQuery = [];

        foreach ($this->safeParams as $parm => $operators){

            $query = $request->query($parm);

            if (!isset($query)){
                continue;
            }

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
