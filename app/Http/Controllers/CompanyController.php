<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Repositories\CompanyRepository;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new CompanyRepository();
    }

    /**
     * @OA\Get(
     *     path="/api/company",
     *     description="Returns list of companies for auth user",
     *     tags={"Company"},
     *     summary="GET (all) companies",
     *     operationId="GetCompanies",
     *     security={ {"bearerAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Company")
     *          )
     *      ),
     *     @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     */
    public function index()
    {
        $user = Auth::user();

        $companies = Company::where('user_id', $user->id)->get();

        $data = CompanyResource::collection($companies);

        return response()->json($data, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/company/{id}",
     *     description="Show company",
     *     tags={"Company"},
     *     summary="GET Company",
     *     operationId="showCompany",
     *     security={ {"bearerAuth": {} }},
     *    @OA\Parameter(
     *          name="id",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *     @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */
    public function show(Company $company)
    {
        $this->authorize('view', $company);

        $data = new CompanyResource($company);

        return response()->json($data, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/company",
     *      description="Returns company",
     *      tags={"Company"},
     *      summary="POST (add) company",
     *      operationId="addCompany",
     *      security={ {"bearerAuth": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CompanyRequest"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
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
    public function store(CompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        $company = $this->repo->saveCompany($request);

        $data = new CompanyResource($company);

        return response()->json($data, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/company/{id}",
     *     description="UPDATE Company",
     *     tags={"Company"},
     *     summary="UPDATE Company",
     *     operationId="updateCompany",
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
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CompanyUpdateRequest")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
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
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        $this->repo->updateCompany($request, $company);

        $dataResource = new CompanyResource($company);

        return response()->json($dataResource, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/company/{id}",
     *      operationId="deleteCompany",
     *      tags={"Company"},
     *      summary="DELETE Company",
     *      description="Deletes a record and returns no content",
     *      security={ {"bearerAuth": {} }},
     *       @OA\Parameter(
     *          name="id",
     *          description="Company id",
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
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return response(null, 204);
    }
}
