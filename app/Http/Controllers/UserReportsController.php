<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Exception;
use Auth;

class UserReportsController extends Controller
{

    /**
     * Display a listing of the user reports.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $userReports = UserReport::where('user_id', '=', Auth::id())->with('user')->paginate(5);

        return view('user_reports.index', compact('userReports'));
    }

    /**
     * Show the form for creating a new user report.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();

        return view('user_reports.create', compact('users'));
    }

    /**
     * Store a new user report in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            UserReport::create($data);

            return redirect()->route('user_reports.user_report.index')
                             ->with('success_message', trans('user_reports.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('user_reports.unexpected_error')]);
        }
    }

    /**
     * Display the specified user report.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $userReport = UserReport::with('user')->findOrFail($id);

        return view('user_reports.show', compact('userReport'));
    }

    /**
     * Show the form for editing the specified user report.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $userReport = UserReport::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('user_reports.edit', compact('userReport','users'));
    }

    /**
     * Update the specified user report in the storage.
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

            $userReport = UserReport::findOrFail($id);
            $userReport->update($data);

            return redirect()->route('user_reports.user_report.index')
                             ->with('success_message', trans('user_reports.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('user_reports.unexpected_error')]);
        }
    }

    /**
     * Remove the specified user report from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $userReport = UserReport::findOrFail($id);
            $userReport->delete();

            return redirect()->route('user_reports.user_report.index')
                             ->with('success_message', trans('user_reports.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('user_reports.unexpected_error')]);
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
            'user_id' => 'required',
            'title' => 'required|string|min:1|max:255',
            'status' => 'boolean',
            'timestamp' => 'required|date_format:j/n/Y g:i A',

        ];


        $data = $request->validate($rules);


        $data['status'] = $request->has('status');


        return $data;
    }

}
