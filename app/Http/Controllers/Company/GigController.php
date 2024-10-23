<?php

namespace App\Http\Controllers\Company;

use App\Models\Gig;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\GigRequest;
use App\Http\Resources\GigResource;
use App\Repositories\GigRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGigRequest;

class GigController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new GigRepository();
    }

    public function index(Company $company)
    {
        $this->authorize('viewAny',  [Gig::class, $company]);

        $gigs = $company->gigs()->get();

        $data = GigResource::collection($gigs);

        return response()->json($data, 200);
    }

    public function show(Company $company, Gig $gig)
    {
        $this->authorize('view',  [$gig, $company]);

        $data = new GigResource($gig);

        return response()->json($data, 200);
    }

    public function store(Company $company, GigRequest $request)
    {
        $this->authorize('create',  [Gig::class, $company]);
        
        $gig = $this->repo->saveGig($company, $request);

        $data = new GigResource($gig);

        return response()->json($data, 201);
    }

    public function update(UpdateGigRequest $request, Company $company, Gig $gig)
    {
        $this->authorize('update',  [$gig, $company]);

        $this->repo->updateGig($company, $gig, $request);
       
        $data = new GigResource($gig);

        return response()->json($data, 200);
    }
    
    public function destroy(Company $company, Gig $gig)
    {
        $this->authorize('delete', [$gig, $company]);

        $gig->delete();

        return response()->json(null, 204);
    }
}
