<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Exception;
use Gate;
use Hash;

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
            $request['password'] = Hash::make($request['password']);
            $data = $this->getDataCreate($request);
            User::create($data);

            return redirect()->route('users.users.index')
                             ->with('success_message', trans('users.model_was_added'));

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

            $data = $this->getData($request);
            $user = User::findOrFail($id);
            $user->update($data);
            return redirect()->route('users.users.index')
                             ->with('success_message', trans('users.model_was_updated'));

        } catch (Exception $exception) {
            dd($data);
            //dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }
    public function updatestatus(Request $request)
    {
        try {
            $status = ($request['status']==1) ? 1 : 0;
            $statusText = ($request['status']==1) ? "Disable" : "Enable";
            User::where('id', $request['id'])->update(array('status' =>$status));
            return response()->json(['response' => 'This is success method','responsecode'=>1,'enable'=>$statusText]);

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
                             ->with('success_message', trans('users.model_was_deleted'));

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

}
