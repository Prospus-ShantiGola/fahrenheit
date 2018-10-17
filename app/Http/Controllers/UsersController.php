<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;
use Exception;
use Gate;
use Hash;
use App;
use Config;

class UsersController extends Controller
{


    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index( Request $request)
    {
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, you are not authorized to do this action.");
        }
        $usersObjects = User::where('id', '!=', Auth::id())->paginate(5);

        return view('users.index', compact('usersObjects'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $userTypes = UserType::all();
        return view('users.create', compact('userTypes'));
    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $request['password']= bcrypt($request['password']);
            $data = $this->getDataCreate($request);
            User::create($data);

            return redirect()->route('users.users.index')
                             ->with('success_message', trans('users.user_was_added'));

        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $users = User::with('usertype')->findOrFail($id);

        return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        $userTypes = UserType::all();
        return view('users.edit', compact('users','userTypes'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            $request['password']= bcrypt($request['password']);
            $data = $this->getData($request);
            $user = User::findOrFail($id);
            $user->update($data);
            return redirect()->route('users.users.index')
                             ->with('success_message', trans('users.user_was_updated'));

        } catch (Exception $exception) {
            dd($exception);
            //dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }

    /**
     *  Update user status active/deactivate
     *
     */
    public function updatestatus(Request $request)
    {
        try {
            $status = ($request['status']==1) ? 1 : 0;
            $statusText = ($request['status']==1) ? "Disable" : "Enable";
            //udpate status in database.

            $user= User::where('id', $request['id'])->update(array('status' =>$status));
            $user =User::findOrFail($request['id'])->toArray();
            // print_r($user);
            // die;
            //Send email.
            if($request['status']){
                if(!$user['new_user'])  {
                    $clean_password= str_random(40);
                    $new_password=bcrypt($clean_password);
                    User::where('id', $request['id'])->update(array('password' =>$new_password));
                    $user['password']=$clean_password;
                }
                app('App\Http\Controllers\MailController')->sendActivationEmailUser($user);
                if(!$user['new_user']) $user= User::where('id', $request['id'])->update(array('new_user' =>1));
            }
            return response()->json(['response' => 'This is success method','responsecode'=>1,'enable'=>$statusText]);
            //return 'json response';

        } catch (Exception $exception) {
            dd($exception);
            return response()->json(['response' => 'This is failure method']);
        }
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.user.index')
                             ->with('success_message', trans('users.user_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:191',
            'company' => 'required|string|min:1|max:191',
            'phoneno' => 'required|string|min:1|max:191',
            'email' => 'required|string|min:1|max:191',
            'password' => 'nullable|string|min:1|max:191',
            'user_type_id' => 'required|string|min:1|max:191'

        ];
        $data = $request->validate($rules);
        return $data;
    }
    protected function getDataCreate(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:191',
            'company' => 'required|string|min:1|max:191',
            'phoneno' => 'required|string|min:1|max:191',
            'email' => 'required|string|unique:users,email|min:1|max:191',
            'password' => 'required|string|min:1|max:191',
            'user_type_id' => 'required|string|min:1|max:191'

        ];


        $data = $request->validate($rules);




        return $data;
    }
    public function loginUser(Request $request)
    {

    	$email	       = $request->email;
    	$password      = $request->password;
    	$rememberToken = $request->remember;
        // now we use the Auth to Authenticate the users Credentials

        try {
            if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password], $rememberToken)) {
                if(!Auth::user()->status){
                    $msg = array(
                        'status'  => 'error',
                        'message' => 'Your account has been disabled'
                    );
                    return response()->json($msg);
                }
                $msg = array(
                    'status'  => 'success',
                    'message' => 'Login Successful'
                );
                return response()->json($msg);
            } else {
                $msg = array(
                    'status'  => 'error',
                    'message' => 'These credentials do not match our records.'
                );
                return response()->json($msg);
            }

        } catch (Exception $exception) {
            //dd($exception);
            return response()->json(['response' => 'Please check the credentials !!']);
        }
		// Attempt Login for members

    }
   public function changeLanguage($lang)
    {
        Session::put('applocale', $lang);
        return redirect()->back();
    }

}
