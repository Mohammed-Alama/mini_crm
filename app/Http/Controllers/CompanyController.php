<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompaniesRequest;
use DB;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Storage;
use Yajra\DataTables\DataTables;

/**
 * Class CompanyController
 * @package App\Http\Controllers
 */
class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     * @throws
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Company::query())
                ->setRowClass(function ($company) {
                    return $company->id % 2 == 0 ? 'alert-primary' : 'alert-danger';
                })
                ->setRowId(function ($company) {
                    return 'company_' . $company->id;
                })
                ->setRowAttr(['align' => 'center'])
                ->setRowData([
                    'data-id' => function ($company) {
                        return $company->id;
                    },
                ])
                ->addColumn('logo', function ($company) {
//                    return '<div class="logo"><button class="btn btn-info">Show Logo</button><figure><img src="' . asset('storage/' . $company->image) . '" alt="logo of ' . $company->name . '" class="img-rounded company-logo" /></figure></div>';
//                    return '<img src="' . asset('storage/' . $company->image) . '" alt="logo of ' . $company->name . '" class="img-rounded company-logo" />';
return $company->logo;
                })->addColumn('action', function ($company) {
                    return '<a class="btn btn-sm btn-warning" role="button" aria-disabled="true" href="' . route('companies.edit', $company->id) . '"><i class="glyphicon glyphicon-edit"></i>Edit</a>' .
                        '<a class="btn btn-sm btn-danger" id="destroyCompany" role="button" aria-disabled="true" href="javascript:void(0);" data-id="' . $company->id . '"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                })->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('companies.plural');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompaniesRequest $request
     *
     * @return Response
     * @throws
     */
    public function store(CompaniesRequest $request)
    {

        $request->validated();
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = $logo->getClientOriginalName();
            $request_name = str_replace(" ", "_", strtolower(request('name')));
            $path = Storage::putFileAs('logos', new UploadedFile($logo, $logo_name), $request_name . '_' . $logo_name);
        }


        if (! empty($path)) {
            Company::create([
                'name' => request('name'),
                'email' => request('email'),
                'logo' => $path,
                'website' => request('website'),
            ]);
        }


        session()->flash('SuccessMassage', 'Company Created Successfully');

        return redirect()->to(route('companies.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     *
     * @return Response
     */
    public function show(Company $company)
    {
        $employees = DB::table('employees')->where('company_id', '=', $company->id)->get();

        return view('companies.single')->with(['company' => $company, 'employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     *
     * @return Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompaniesRequest $request
     * @param Company          $company
     *
     * @return Response
     * @throws
     */
    public function update(CompaniesRequest $request, Company $company)
    {

        $request->validated();

        if ($request->hasFile('logo')) {
            Storage::delete($company->logo);
            $logo = $request->file('logo');
            $logo_name = $logo->getClientOriginalName();
            if (! empty($request->name)) {
                $request_name = str_replace(" ", "_", strtolower($request->name));
                $path = Storage::putFileAs('logos', new UploadedFile($logo, $logo_name), $request_name . '_' . $logo_name);
                $company->update(['logo' => $path]);
            }
        }

        if (! empty($request->email)) {
            if (! empty($request->website)) {
                $company->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'website' => $request->website,
                ]);
            }
        }

        return redirect()->to(route('companies.show', $company->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     *
     * @return Response
     * @throws
     */
    public function destroy(Company $company)
    {
        Storage::delete($company->logo);
        if ($company->delete()) {
            return response()->json([
                'success' => 'Company deleted successfully!',
            ]);
        }

        return response()->json([
            'failed' => 'Company does not deleted successfully!',
        ]);
    }
}
