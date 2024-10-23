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

    public function index()
    {
        $user = Auth::user();

        $companies = Company::where('user_id', $user->id)->get();

        $data = CompanyResource::collection($companies);

        return response()->json($data, 200);
    }

    public function show(Company $company)
    {
        $this->authorize('view', $company);

        $data = new CompanyResource($company);

        return response()->json($data, 200);
    }

    public function store(CompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        $company = $this->repo->saveCompany($request);

        $data = new CompanyResource($company);

        return response()->json($data, 201);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        $this->repo->updateCompany($request, $company);

        $dataResource = new CompanyResource($company);

        return response()->json($dataResource, 200);
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return response(null, 204);
    }
}
