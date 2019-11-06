<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompaniesRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

use Storage;

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
     *
     * @return Response
     */
    public function index()
    {
        $companies = (new Company)->paginate(2);

        return view('companies.plural')->with('companies', $companies);
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

//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required',
//            'logo' => 'required|mimes:jpg,jpeg,png|max:20000',
//            'website' => 'required',
//        ]);

        $path = '';
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = $logo->getClientOriginalName();
            if (! empty($request->name)) {
                $request_name = str_replace(" ", "_", strtolower($request->name));
                $path = Storage::putFileAs('logos', new UploadedFile($logo, $logo_name), $request_name . '_' . $logo_name);
            }
        }
        if (! empty($request->email)) {
            if (! empty($request->website)) {
                Company::create([
                    'name' => $request->name,
                    'email' => $request->email,


                    'logo' => $path,
                    'website' => $request->website,
                ]);
            }
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
        return view('companies.single')->with('company', $company);
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
     * @param Request $request
     * @param Company $company
     *
     * @return Response
     * @throws
     */
    public function update(Request $request, Company $company)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|max:20000',
            'website' => 'required',
        ]);

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
                'success' => 'Record deleted successfully!',
            ]);
        }

        return response()->json([
            'failed' => 'Record does not deleted successfully!',
        ]);
    }
}
