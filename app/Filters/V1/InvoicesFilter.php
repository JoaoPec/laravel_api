<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\apiFilter;

class InvoicesFilter extends apiFilter{

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

}
