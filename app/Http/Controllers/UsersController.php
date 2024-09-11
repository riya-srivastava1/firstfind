<?php

namespace Modules\Users\App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalItems = User::count();
        $itemsPerPage = $request->query('itemsPerPage', $totalItems);
        $users = User::with('getRole')->orderBy('id', 'desc')->paginate($itemsPerPage);
        return view('users::index', compact('users', 'totalItems', 'itemsPerPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users::create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'contact_number' => "required|digits:10",
            'role' => "required",
        ]);
        try {
            // $user = Auth::user()->id;
            $password = Hash::make('123456');

            $user = new User();
            $user->name = $validated["name"];
            $user->email = $validated["email"];
            $user->password = $password;
            $user->contact_number = $validated["contact_number"];
            $user->role = $validated["role"];
            $user->created_by = Auth::user()->id;
            $user->is_active = 1;
            $user->save();
            $toUser = $validated['email'];
            $subject = "Itinerary Planner LOGIN CREDENTIAL";

            Mail::send('emails.user-credential', ['email' => $validated['email'], 'password' => $password], function ($message) use ($toUser, $subject) {
                $message->to($toUser)
                    ->subject($subject);
            });

            if ($user) {
                $notification = array(
                    'message' => 'User Added Successfully !!',
                    'alert-type' => 'success'
                );
                return redirect(route('user.index'))->with($notification);
            } else {
                $notification = array(
                    'message' => 'Something Went Wrong !!',
                    'alert-type' => 'error'
                );
                return redirect(route('user.index'))->with($notification);
            }
        } catch (Exception $e) {
            Log::error('User creation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the role: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        $role_values = Role::all();
        return view('users::edit', compact('users', 'role_values'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'contact_number' => 'required|digits:10',
        ]);

        try {
            // $selectedValues = $request->input('permission');
            // $jsonString = json_encode($selectedValues);
            $user = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'role' => $request->role ?? null,
                // 'permission' => $jsonString ?? null
            ]);
            if ($user) {
                $notification = array(
                    'message' => 'User Updated Successfully !!',
                    'alert-type' => 'success'
                );
                return redirect(route('user.index'))->with($notification);
            } else {
                $notification = array(
                    'message' => 'Something Went Wrong !!',
                    'alert-type' => 'error'
                );
                return redirect(route('user.index'))->with($notification);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while editing the role: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Something went wrong']);
        }
    }
    public function status($id)
    {
        $status = User::findOrFail($id);
        $status->is_active = $status->is_active == 1 ? 0 : 1;
        $status->save();
        return response()->json(['status' => 'success']);
    }
    public function search(Request $request)
    {
        $totalItems = User::count();
        $searchTerm = $request->input('search');
        $itemsPerPage = $request->query('itemsPerPage', $totalItems);
        $itemsPerPage = intval($itemsPerPage);

        if ($searchTerm != '') {
            $users = User::where('name', 'LIKE', "%$searchTerm%")
                ->orWhere('email', 'LIKE', "%$searchTerm%")
                ->orWhere('contact_number', 'LIKE', "%$searchTerm%")
                ->orWhere('role', 'LIKE', "%$searchTerm%")
                ->orderBy('created_at','DESC')
                ->paginate($itemsPerPage);
        } else {
            $users = User::orderBy('created_at','DESC')->paginate($itemsPerPage);
        }

        return view('users::user-index', compact('users', 'itemsPerPage', 'totalItems'));
    }
}
