<?php


namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\EmployeesRequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     *
     * @return Response
     */
    public function index(Company $company)
    {

        $employees = DB::table('employees')->where('company_id', '=', $company->id)->get();

        return view('employees.plural')->with(['employees' => $employees, 'company' => $company]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * @param Company $company
     *
     * @return Response
     */
    public function create(Company $company)
    {
        return view('employees.create')->with('company', $company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeesRequest $request
     * @param Company          $company
     *
     * @return Response
     */
    public function store(EmployeesRequest $request, Company $company)
    {
        $request->validated();

        $employee = Employee::create([
            'company_id' => $company->id,
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'name' => request('first_name') . request('last_name'),
            'phone' => request('phone'),
        ]);
        $employee->save();

        session()->flash('SuccessMassage', 'Employee Added Successfully');


        return redirect()->to(route('employees.index', $company));

    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @param Company  $company
     *
     * @return Response
     */
    public function show(Employee $employee, Company $company)
    {
        return view('employees.single')->with(['company'=>$company,'employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company  $company
     * @param Employee $employee
     *
     * @return Response
     */
    public function edit(Company $company, Employee $employee)
    {
        return view('employees.edit')->with(['company' => $company, 'employee' => $employee,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeesRequest  $request
     * @param Employee $employee
     * @param Company  $company
     *
     * @return Response
     */
    public function update(EmployeesRequest $request, Employee $employee, Company $company)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @param Company  $company
     *
     * @return Response
     */
    public function destroy(Employee $employee, Company $company)
    {
        //
    }
}
