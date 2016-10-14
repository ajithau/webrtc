<?php
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date       12-10-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Company;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new admin user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function createAdmin(Request $request)
    {
        $user = new User;
        $user->email        = $request->email;
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->mobile       = $request->mobile;
        $user->name         = $request->name;
        $user->password     = bcrypt($request->password);
        // Insert data;
        $user->save();

        // Specifying the role of new user.
        $role = new Role;
        $role->role = 1; // Role 1 for super admin.
        $user->role()->save($role);
    }

    /**
     * Create a new User and Company details.
     *
     * @param  array  $data
     * @return User
     */
    protected function createCustomer(Request $request)
    {
        // User Details
        $user = new User;
        $user->email        = $request->email;
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->mobile       = $request->mobile;
        $user->name         = $request->name;
        $user->password     = bcrypt($request->password);
        // Insert data.
        $user->save();

        //Company Details.
        $company = new Company;
        $company->company_name = $request->company_name;
        $company->save();        
    }
    /**
     * Show the users list.
     *
     * @param  int
     * @return Response
     */
    public function show()
    {
        // Get amdin users list
        $users = DB::table('users')->where('active', 1)->orderBy('created_at', 'desc')->get();
        // Join tables
        $role = User::find(1)->role;
        return view('user/index', array('users' => $users, 'role' => $role));
    }
    public function customer()
    {
        // Get Customer users list
        $data['users'] = DB::table('users')->where('active', 1)->orderBy('created_at', 'desc')->get();
        $data['country'] = DB::table('countries')->get();
        return view('user/customer', array('data' => $data));
    }
}
