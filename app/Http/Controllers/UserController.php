<?php
/**
 * @package    User Controller
 *
 * @copyright  2016 metamorphosis.tv
 * @author     Ajith, sparksupport.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use App\Company_user;
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
        $user->role         = 1;
        // Insert data;
        $user->save();

        // Specifying the role of new user.
        $role = new Role;
        $role->role = 1; // Role 1 for super admin.
        $user->role()->save($role);
        return redirect('users');        
    }

    /**
     * Create a new admin user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    protected function updateAdminInline(Request $request)
    {
        $user[$request->field] = $request->value;
        if($request->field == "password"){
            $user[$request->field] = bcrypt($request->value);
        }
        // Insert data;
        DB::table('users')->where('id', $request->userid)->update($user);
    }

    /**
     * Create a new User and Company details.
     *
     * @param  array  $data
     * @return User
     */

    protected function createCompany(Request $request)
    {
        $number = "";
        for($i=0; $i<19; $i++) {
            $min = ($i == 0) ? 1:0;
            $number .= mt_rand($min,9);
        }

        $company = new Company;
        // Company Details
        $company->address       = $request->address;
        $company->address1      = $request->address1;
        $company->api_key       = $number;
        $company->city          = $request->city;
        $company->company_name  = $request->company_name;
        $company->country       = $request->country;
        $company->email         = $request->email;
        $company->fax           = $request->fax;
        $company->mobile        = $request->mobile;
        $company->phone         = $request->phone;
        $company->twitter       = $request->twitter;
        $company->website       = $request->website;
        $company->zipcode       = $request->zipcode;
        $company->save(); 

        return  $company->id;      
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
        if($request->userid != '') {
            $user = User::find($request->userid);
        } else {
            $exist = DB::table('users')->where('email', $request->email)->get();
            if(isset($exist[0])){
                return "email";
                die;
            }            $user = new User;
        }
        $user->email        = $request->email;
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->mobile       = $request->mobile;
        $user->name         = $request->name;
        $user->notification = serialize($request->notifications);
        $user->access       = serialize($request->access);
        $user->password     = bcrypt($request->password);
        if($request->user_type == '') {
            $user->role     = 5;
        }
        else {        
            $user->role     = $request->user_type;
        }
        // Insert data.
        $user->save();
        if($request->company_id != null && $request->userid == null){
            $companyuser = new Company_user;
            $companyuser->userid    = $user->id;
            $companyuser->companyid = $request->company_id;
            $companyuser->save();
        }
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
        $users = DB::table('users')->select('*')
                ->where([['role', '!=', '1'],])
                ->get();

        return view('user/index', array('users' => $users));
    }
    public function customer()
    {
        // Get Customer users list
        $data['users'] = DB::table('users')->where('active', 1)->orderBy('created_at', 'desc')->get();
        $data['country'] = DB::table('countries')->get();

        return view('user/customer', array('data' => $data));
    }

    /**
     * Show the admin users list.
     *
     * @param  int
     * @return Response
     */

    public function adminUser()
    {
        // Get amdin users list
        $users = DB::table('users')->select('*')->join('roles', 'users.id', '=', 'roles.user_id')
                ->where([['roles.role', '=', '1'],])
                ->paginate(20);

        return view('admin/index', array('users' => $users));
    }

    /**
     * Show the admin users list.
     *
     * @return Response
     */

    public function adminCustomer()
    {
        // Get Customer users list
        $data['companies'] = DB::table('companies')->select('*')->orderBy('created_at', 'desc')->paginate(20);
        foreach ($data['companies'] as $key => $value) {
            $data['users'][$key] = DB::table('company_users')->select('*')
                                ->rightJoin('users', 'company_users.userid', '=', 'users.id')
                                ->where('companyid',$value->id)
                                ->get();

            $data['products'][$key] = DB::table('products')->select('*')
                                ->where('company_id',$value->id)
                                ->get();
        }
        $data['country'] = DB::table('countries')->get();

        return view('admin/customer', array('data' => $data));
    }

    /**
     * Delete User.
     *
     * @param  id
     * @return redirect back
     */

    public function deleteUser($id)
    {
        $user = User::find($id);    
        $user->delete();    
        return redirect()->back();
    }

    /**
     * Delete Company.
     *
     * @param  Company id
     * @return Company name
     */

    public function deleteCompany($companyid)
    {
        $Company = Company::find($companyid);   
        $Company->delete();    
        return $Company['company_name'];
    }

    /**
     * Update adminUser.
     *
     * @param  id
     * @return redirect back
     */

    public function updateAdmin(Request $request)
    {
        $user['email']        = $request->email;
        $user['first_name']   = $request->first_name;
        $user['last_name']    = $request->last_name;
        $user['mobile']       = $request->mobile;
        $user['name']         = $request->name;
        if($request->password != null) {
            $user['password']     = bcrypt($request->password);
        }
        // Insert data;
        DB::table('users')->where('id', $request->user_id)->update($user);
        return redirect()->back();
    }

    /**
     * Update Company.
     *
     * @param  Company id
     * @return Company name
     */

    public function updateCompany(Request $request)
    {
        $company['address']       = $request->address;
        $company['address1']      = $request->address1;
        $company['city']          = $request->city;
        $company['company_name']  = $request->company_name;
        $company['country']       = $request->country;
        $company['email']         = $request->email;
        $company['fax']           = $request->fax;
        $company['mobile']        = $request->mobile;
        $company['phone']         = $request->phone;
        $company['twitter']       = $request->twitter;
        $company['website']       = $request->website;
        $company['zipcode']       = $request->zipcode;
        
        // Insert data;
        DB::table('companies')->where('id', $request->company_id)->update($company);
    }


    /**
     * Update Company timezone.
     *
     * @param  Company id
     * @return null
     */

    public function updateTimezone(Request $request)
    {
        $company['timezone'] = $request->timezone;
        echo $company['timezone'];
        // Insert data;
        DB::table('companies')->where('id', $request->company_id)->update($company);
    }    
}
