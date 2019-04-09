<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\LoginController;
use App\User;
use App\Categorie;
use App\ContractCategorie;
use App\BusinessHours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Contract;
use App\MerchantImage;
class AdminsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index(){
        if(Session::get('username') != ""){
            return redirect()->route('admin-dashboard');
        }
        return view('admin.login');
    }

    public function dashboard(){
        if(Session::get('username') == ""){
            return redirect()->route('admin-login');
        }
        Session::put('page_name', 'dashboard');
        // Session::put('page_class', 'active');
        $merchants = User::where('isAdmin', '!=', 1)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.dashboard')->with('merchants', $merchants);
    }

    public function login(Request $request){
        $validate = $request->validate([
            'username' => 'required|email|max:255',
            'password' => 'required',
        ]);
        $credentials = array(
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        );
        if (Auth::attempt($credentials)) {
            $username = $request->get('username');
            $user = User::where('username', $username)->first();
            Auth::loginUsingId($user->id);
            Session::put('username', auth()->user()->username);
            Session::put('name', auth()->user()->nome_cognome);
            Session::put('id', auth()->user()->id);
            return Redirect::route('admin-dashboard');
        }else{
            Session::flash( 'message', "Invalid Credentials , Please try again." );
            Session::flash('alert-class', 'alert-danger');
//            Session::put('username', $request->get('username'));
            return Redirect::back();
        }
    }

    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect()->route('admin-login');
    }

    public function profile(Request $request, $id){
        if(!empty($id)){

            if(Session::get('id') != $id){
                return redirect()->back();
            }
            $admin = User::whereId($id)->first();

            return view('admin.profile')->with('admin', $admin);
        }
        return redirect()->back();
    }

    public function editProfile(Request $request){
        if(empty($request->username)){
            Session::flash('message', 'Username cannot be empty');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        $nome_cognome = $request->get('nome_cognome');
        $username = $request->get('username');
        $old_password = $request->get('old_password');
        $new_password = $request->get('new_password');
        $repeat_password = $request->get('repeat_password');
        $admin = User::Where('username', $username)->first();
        if(!empty($nome_cognome)){
            $admin->nome_cognome = $nome_cognome;
        }
        if(!empty($old_password) && !empty($new_password) && !empty($repeat_password)){
            if($new_password != $repeat_password){
                Session::flash('message', "repeat password should be same as new password");
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
            if(Hash::check($old_password, $admin->password)){
                $admin->password = Hash::make($new_password);
                Session::flash('message', "Profile Updated Successfully");
                Session::flash('alert-class', 'alert-success');
                $admin->save();
                return redirect()->back();
            }else{
                Session::flash( 'message', "Wrong Password" );
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
        }
        $admin->save();
        Session::flash( 'message', "Profile Updated Successfully" );
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }



    public function approve($id){
        if(empty($id)){
            Session::flash('message', 'Empty ID');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        $user = User::whereId($id)->first();
        $email = $user->username;
        // $user_code = $user->unique;
        $user->email_code = md5(time());
        $user->email_verified_at = Carbon::now();
        $user->save();
        
        $complete = route('final-form', $user->email_code);
       
        $to = $email;
        $subject = "Conferma registrazione da Gate  Network";
        $message = "<html><head><title>Register</title></head><body>
                    <p>Grazi per aver scelto Gate Network, clicca sul link qui sotto per completare la registrazione</p>
                    <a href='".$complete."'>Completa Registrazione</a>
                    </body></html>";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "From: no-reply@gatenetwork.it" . "\r\n" .
            "CC: no-reply@gatenetwork.it";

        mail($to, $subject, $message, $headers);
        
        // Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user){
        //     $message->from('info@example.com', 'Smart Contract System');

        //     $message->to($user->username)->cc('info@example.com');
        // });
        Session::flash('message', 'Email inviata correttamente');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }


    public function viewMerchant($id){
        $user = User::whereId($id)->first();
        $merchant = Contract::whereUserId($id)->first();
        $con_cat = ContractCategorie::whereIdContract($id)->first();
        if(!empty($con_cat)){
            $cat = Categorie::whereId($con_cat->id_categoria)->first();
        }else{
            $cat = '';
        }

        $business_hours = BusinessHours::whereIdContract($id)->get();
        $images = MerchantImage::where('user_id', $id)->get();
        $day_list = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('admin.view-merchant', compact('merchant', 'cat', 'business_hours', 'day_list', 'images'));
    }


    public function removeMerchant($id){  
        $merchant = User::whereId($id)->first();
        $merchant->delete();
        return redirect()->back();
    }



    public function category(){
        Session::put('page_name', 'Categorie');
        $categories = Categorie::paginate(10);
        return view('admin.category', compact('categories'));
    }



    public function addCategory(Request $request){
        if(!$request->get('category')){
            Session::flash('message', 'Name Cannot be Empty');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        $category = new Categorie();
        $category->nome = $request->get('category');
        $category->save();

        Session::flash('message', 'Category Has Been Added');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();

    }


    public function removeCategory($id){
        if(empty($id)){
            Session::flash('message', 'Category Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        $category = Categorie::whereId($id)->first();
        if(empty($category)){
            Session::flash('message', 'Category Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        $category->delete();
        Session::flash('message', 'Category Deleted Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function editCategory($id){
        if(empty($id)){
            Session::flash('message', 'Category Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        $category = Categorie::whereId($id)->first();
        if(empty($category)){
            Session::flash('message', 'Category Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        return view('admin.edit-category', compact('category'));
    }

    public function updateCategory(Request $request){
        $id = $request->get('cat_id');
        if(empty($id)){
            Session::flash('message', 'Category Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        $category = Categorie::whereId($id)->first();
        if(empty($category)){
            Session::flash('message', 'Category Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        $category_name = $request->get('category');
        if(empty($category_name)){
            Session::flash('message', 'Category Not Found');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        $category->nome = $category_name;
        $category->save();
        Session::flash('message', 'Category updated Successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('category');

    }

}
