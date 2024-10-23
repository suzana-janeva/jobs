<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Gig;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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

        if ($request->has('timestamp_start')) {
            $timestampStart = Carbon::createFromFormat('m/d/Y h:i A', $request->input('timestamp_start'))->format('Y-m-d H:i:s');
            $gig->timestamp_start = $timestampStart;
        }

        if ($request->has('timestamp_end')) {
            $timestampEnd = Carbon::createFromFormat('m/d/Y h:i A', $request->input('timestamp_end'))->format('Y-m-d H:i:s');
            $gig->timestamp_end = $timestampEnd;
        }

        $gig->save();

        return $gig;
    }

    public function searchGig($term): Collection
    {
        $gigs = Gig::where('name', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')->get();

        return $gigs;
    }

    public function filterGigs(Request $request): Collection
    {
        $gigs = Gig::query();

        // filter by company_id
        if ($request->has('company_id')) {
            $gigs->where('company_id', $request->input('company_id'));
        }

        // filter by progress, acceptable values: not_started, started, finished
        if ($request->has('progress')) {

            $now = Carbon::now();
            
            if ($request->input('progress') === 'not_started') {
                $gigs->where('timestamp_start', '>', $now);
            } elseif ($request->input('progress') === 'started') {
                $gigs->where('timestamp_start', '<=', $now)
                      ->where('timestamp_end', '>=', $now);
            } elseif ($request->input('progress') === 'finished') {
                $gigs->where('timestamp_end', '<', $now);
            }
        }

        // filter by status
        if ($request->has('status')) {
            $gigs->where('status', $request->input('status'));
        }

        $allGigs = $gigs->get();

        return $allGigs;
    }
}
