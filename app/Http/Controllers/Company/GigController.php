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
use Carbon\Carbon;

class GigController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new GigRepository();
    }

    /**
     * @OA\Get(
     *     path="/api/company/{id}/gig",
     *     description="Returns list of gigs",
     *     tags={"Company/Gig"},
     *     summary="GET (all) gigs",
     *     operationId="GetGigs",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *          name="id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/GigResource")
     *      )
     * )
     *
     */
    public function index(Company $company)
    {
        $this->authorize('viewAny',  [Gig::class, $company]);

        $gigs = $company->gigs()->get();

        $data = GigResource::collection($gigs);

        return response()->json($data, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/company/{company_id}/gig/{gig_id}",
     *     description="Show Gig",
     *     tags={"Company/Gig"},
     *     summary="GET Gig",
     *     operationId="showGig",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *          name="company_id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="gig_id",
     *          description="Gig id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/GigResource")
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */
    public function show(Company $company, Gig $gig)
    {
        $this->authorize('view',  [$gig, $company]);

        $data = new GigResource($gig);

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/company/{id}/gig",
     *      description="Returns gig",
     *      tags={"Company/Gig"},
     *      summary="POST (add) gig",
     *      operationId="addGig",
     *      security={ {"bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/GigRequest"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/GigResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */
    public function store(Company $company, GigRequest $request)
    {
        $this->authorize('create',  [Gig::class, $company]);

        $gig = $this->repo->saveGig($company, $request);

        $data = new GigResource($gig);

        return response()->json($data, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/company/{company_id}/gig/{gig_id}",
     *     description="UPDATE gig",
     *     tags={"Company/Gig"},
     *     summary="UPDATE Gig",
     *     operationId="updateGig",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *          name="company_id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="gig_id",
     *          description="Gig id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/GigUpdateRequest")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/GigResource")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     *
     */
    public function update(UpdateGigRequest $request, Company $company, Gig $gig)
    {
        $this->authorize('update',  [$gig, $company]);

        $this->repo->updateGig($company, $gig, $request);

        $data = new GigResource($gig);

        return response()->json($data, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/company/{company_id}/gig/{gig_id}",
     *      operationId="deleteGig",
     *      tags={"Company/Gig"},
     *      summary="DELETE Gig",
     *      description="Deletes a record and returns no content",
     *      security={ {"bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="company_id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="gig_id",
     *          description="Gig id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="The resource was deleted successfully.",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Company $company, Gig $gig)
    {
        $this->authorize('delete', [$gig, $company]);

        $gig->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/gigs/search/{term}",
     *     description="Search gigs by term (both name and description)",
     *     tags={"Gig/Search"},
     *     summary="GET SearchGigs",
     *     operationId="searchGigs",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *          name="term",
     *          description="Term",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful searching",
     *          @OA\JsonContent(ref="#/components/schemas/GigResource")
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */
    public function search($term)
    {
        //search by name or description
        $gigs = $this->repo->searchGig($term);

        return response()->json($gigs, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/gigs/filter",
     *     description="Filter gigs by company_id, progress(not_started, started, finished) and status(Draft, Posted)",
     *     tags={"Gig/Filter"},
     *     summary="GET FilterGigs",
     *     operationId="filterGigs",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *          name="company_id",
     *          description="Filter by company ID",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="progress",
     *          description="Filter by progress(not_started, started, finished)",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"not_started", "started", "finished"},
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="status",
     *          description="Filter by status(0 - Draft, 1 -Posted)",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              example=0
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful filtering",
     *          @OA\JsonContent(ref="#/components/schemas/GigResource")
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */
    public function filter(Request $request)
    {
        $gigs = $this->repo->filterGigs($request);

        return response()->json($gigs, 200);
    }
}
