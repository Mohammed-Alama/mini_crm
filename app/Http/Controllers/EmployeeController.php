<?php


namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

/**
 * Class EmployeeController
 * @package App\Http\Controllers
 */
class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Company $company
     * @return Response
     */
    public function index(Company $company)
    {
        $employees = DB::table('employees')->where('company_id','=',$company->id);
        
        return view('employees.plural')->with($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Company $company
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Company $company)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @param Company $company
     * @return Response
     */
    public function show(Employee $employee ,Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @param Company $company
     * @return Response
     */
    public function edit(Employee $employee ,Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Employee $employee
     * @param Company $company
     * @return Response
     */
    public function update(Request $request, Employee $employee ,Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @param Company $company
     * @return Response
     */
    public function destroy(Employee $employee ,Company $company)
    {
        //
    }
}
