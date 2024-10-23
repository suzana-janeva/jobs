<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Gig;
use App\Enum\GigStatus;
use App\Models\Company;
use Illuminate\Http\Request;

class GigRepository
{
    public function saveGig(Company $company, Request $request): Gig
    {
        $timestampStart = Carbon::createFromFormat('m/d/Y h:i A', $request->get('timestamp_start'))->format('Y-m-d H:i:s');
        $timestampEnd = Carbon::createFromFormat('m/d/Y h:i A', $request->get('timestamp_end'))->format('Y-m-d H:i:s');

        $gig = Gig::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'timestamp_start' => $timestampStart,
            'timestamp_end' => $timestampEnd,
            'number_of_positions' =>   $request->get('number_of_positions'),
            'pay_per_hour' => $request->get('pay_per_hour'),
            'status' => ($request->get('status') ?? false) ? true : false,
            'company_id' => $company->id,

        ]);

        return $gig;
    }

    public function updateGig(Company $company, Gig $gig, Request $request): Gig
    {
        $gig->fill($request->except(['company_id']));

        if($request->has('timestamp_start')){
            $timestampStart = Carbon::createFromFormat('m/d/Y h:i A', $request->input('timestamp_start'))->format('Y-m-d H:i:s');
            $gig->timestamp_start = $timestampStart;
        }
       
        if($request->has('timestamp_end')){
            $timestampEnd = Carbon::createFromFormat('m/d/Y h:i A', $request->input('timestamp_end'))->format('Y-m-d H:i:s');
            $gig->timestamp_end = $timestampEnd;
        }
        
        $gig->save();

        return $gig;
    }
}
