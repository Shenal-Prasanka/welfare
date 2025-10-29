<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Regement;
use App\Models\Unit;
use App\Models\Rank;
use App\Models\Welfare;
use Illuminate\Support\Str;



class UserController extends Controller
{
    public function index()
    {
        $users = User::with('regement')->get(); // eager load regement
        $regements = Regement::with('users')->get(); // Fetch all regements

        // Fetch all userss with their ranks
        $users = User::with('rank')->get(); // eager load rank
        $ranks = Rank::with('users')->get(); // Fetch all ranks

        // Fetch all userss with their units
        $users = User::with('unit')->get(); // eager load unit
        $units = Unit::with('users')->get(); // Fetch all units

         // Fetch all userss with their welfares
        $users = User::with('welfare')->get(); // eager load welfare
        $welfares = Welfare::with('users')->get(); // Fetch all welfares

        $roles = Role::all();
        
        $users = User::where('is_deleted', 0)->get(); // Return all non-deleted records
        return view('users.index', compact('users', 'regements', 'ranks', 'units', 'welfares','roles'));
    }

     //Active Deactive section
     public function active($userId)
    {
        $user = User::find($userId); // Find the user by ID
            if ($user) {
                if ($user->active) {
                    $user->active = 0;
                } else {
                    $user->active = 1; 
                }
                $user->save(); // Save the changes
            }
        return back()->with('info', 'User created successfully.');
    }

   public function create() 
    {
        $regements = Regement::all();
        $ranks = Rank::all();
        $units = Unit::all();
        $welfares = Welfare::all();
        $roles = Role::all();
        $users = User::all();

        return view('users.add', compact('users', 'roles', 'regements', 'ranks', 'units', 'welfares'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'],
            'mobile' => 'required|string|unique:users,mobile',
            'address' => 'required|string',
            'employee_no' => 'required|string|unique:users,employee_no',
            'regement_no' => 'required|string|unique:users,regement_no',
            'regement_id' => 'required|exists:regements,id',
            'unit_id' => 'required|exists:units,id',
            'rank_id' => 'required|exists:ranks,id',
            'password' => 'required|string|min:6',
            'nic'=> 'required|string|min:10|unique:users,nic',
            'armyId'=> 'required|string|min:12|unique:users,armyId',
            'officeAddress'=> 'required|string|min:6',
            'enlistedDate'=> 'required|date',
            'retireDate'=> 'nullable|date',
            'welfare_id'=> 'nullable|string',
            'roles'=> 'required|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'employee_no' => $request->employee_no,
            'regement_no' => $request->regement_no,
            'regement_id' => $request->regement_id,
            'unit_id' => $request->unit_id,
            'rank_id' => $request->rank_id,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
            'email_verified_at' => now(),
            'nic'=> $request->nic,
            'armyId'=> $request->armyId,
            'officeAddress'=> $request->officeAddress,
            'enlistedDate'=> $request->enlistedDate,
            'retireDate'=> $request->retireDate,
            'welfare_id'=> $request->welfare_id,
            'role' => implode(',', $request->roles),
        ]);

        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(string $id)
    {
        $regements = Regement::all();
        $units = Unit::all();
        $ranks = Rank::all();
        $user = User::find($id);
        $roles = Role::all();
        $welfares = Welfare::all();
        return view('users.edit', compact('user', 'roles', 'regements', 'units', 'ranks', 'welfares'));
    }

   public function update(Request $request, string $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:users,name,' . $id,
        'email' => ['required','email','regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i','unique:users,email,' . $id],
        'mobile' => 'required|string|unique:users,mobile,' . $id,
        'address' => 'required|string',
        'employee_no' => 'required|string|unique:users,employee_no,' . $id,
        'regement_no' => 'required|string|unique:users,regement_no,' . $id,
        'regement_id' => 'required|exists:regements,id',
        'unit_id' => 'required|exists:units,id',
        'rank_id' => 'required|exists:ranks,id',
        'password' => 'nullable|string|min:6',
        'nic'=> 'required|string|min:10|unique:users,nic,' . $id,
        'armyId'=> 'required|string|min:12|unique:users,armyId,' . $id,
        'officeAddress'=> 'required|string|min:6',
        'enlistedDate'=> 'required|date',
        'retireDate'=> 'nullable|date',
        'welfare_id'=> 'nullable|exists:welfares,id',
        'roles'=> 'required|array',
    ]);

    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->mobile = $request->mobile;
    $user->address = $request->address;
    $user->employee_no = $request->employee_no;
    $user->regement_no = $request->regement_no;
    $user->regement_id = $request->regement_id;
    $user->unit_id = $request->unit_id;
    $user->rank_id = $request->rank_id;
    $user->welfare_id = $request->welfare_id;
    $user->nic = $request->nic;
    $user->armyId = $request->armyId;
    $user->officeAddress = $request->officeAddress;
    $user->enlistedDate = $request->enlistedDate;
    $user->retireDate = $request->retireDate;
    $user->role = implode(',', $request->roles);

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    $user->syncRoles($request->roles);

    return redirect()->route('users.index')->with('warning', 'User updated successfully!');
}

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete = 1;
        $user->save();;

        return redirect()->route('users.index')->with('error', 'User deleted successfully.');
    }

     public function show(string $id)
    {
        
    }

    public function welfareshopAccess()
    {
        $users = User::all();
        $welfares = Welfare::where('active', 0)->get();

        // Fetch users with their relationships
        $users = User::with('welfare')
                ->role(['Welfare Shop Clerk', 'Welfare Shop OC'])
                ->get();

        return view('users.welfareshop-access', compact('users', 'welfares'));
    }


   public function editWelfareshopAccess($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all();
    $welfares = Welfare::all();

    return view('users.edit-welfareshop-access', compact('user', 'roles', 'welfares'));
}


   public function updateWelfareshopAccess(Request $request, string $id)
{
   $request->validate([
            'welfare_id' => 'nullable|exists:welfares,id',
            'email' => 'required|email|unique:users,email,' . $id,
            'welfare_id' => 'nullable|exists:welfares,id',
            
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->welfare_id = $request->welfare_id;

        $user->save();

       return redirect()->route('users.welfareshopaccess')->with('info', 'welfare Access updated successfully!');
}
}
