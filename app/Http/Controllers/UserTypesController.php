<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class UserTypesController extends Controller
{

    /**
     * Display a listing of the user types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $userTypes = UserType::paginate(25);

        return view('user_types.index', compact('userTypes'));
    }

    /**
     * Show the form for creating a new user type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('user_types.create');
    }

    /**
     * Store a new user type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            UserType::create($data);

            return redirect()->route('user_types.user_type.index')
                             ->with('success_message', trans('user_types.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('user_types.unexpected_error')]);
        }
    }

    /**
     * Display the specified user type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $userType = UserType::findOrFail($id);

        return view('user_types.show', compact('userType'));
    }

    /**
     * Show the form for editing the specified user type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $userType = UserType::findOrFail($id);
        

        return view('user_types.edit', compact('userType'));
    }

    /**
     * Update the specified user type in the storage.
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
            
            $userType = UserType::findOrFail($id);
            $userType->update($data);

            return redirect()->route('user_types.user_type.index')
                             ->with('success_message', trans('user_types.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('user_types.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified user type from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $userType = UserType::findOrFail($id);
            $userType->delete();

            return redirect()->route('user_types.user_type.index')
                             ->with('success_message', trans('user_types.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('user_types.unexpected_error')]);
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
            'title' => 'required|string|min:1|max:55',
            'status' => 'boolean',
     
        ];

        
        $data = $request->validate($rules);


        $data['status'] = $request->has('status');


        return $data;
    }

}
