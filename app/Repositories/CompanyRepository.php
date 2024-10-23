<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyRepository
{
    public function saveCompany(Request $request) : Company
    {
        $company = Company::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'address'     => $request->get('address'),
            'user_id' =>   Auth::guard('api')->user()->id,
        ]);

        return $company;
    }

    public function updateCompany(Request $request, Company $company) : Company
    {
        $company->fill($request->except(['user_id']));

        $company->save();

        return $company;
    }
}