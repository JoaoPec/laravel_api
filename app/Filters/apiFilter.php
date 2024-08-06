<?php


namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class apiFilter{
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request)
    {

        $eloQuery = [];


        foreach ($this->safeParams as $parm => $operators) {

            $query = $request->query($parm);

            Log::info($query);

            if (!isset($query)) {
                continue;
            };

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }

        }

        return $eloQuery;

    }

}
