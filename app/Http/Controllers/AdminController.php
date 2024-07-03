<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Trip;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Role;
use App\Models\Sport;
use App\Models\Event;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $tables = ['trainings'];
        $users = User::where('approved', false)->get();


        return view('admin.index', compact('tables', 'users'));
    }

    public function showTable($table)
    {
        if (!Schema::hasTable($table)) {
            return redirect()->route('admin.index')->with('error', 'Tabela nie istnieje.');
        }

        $records = DB::table($table)->get();

        return view('admin.table', compact('table', 'records'));
    }


    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $sports = Sport::all();
        $roles = Role::all();
        $categories = Category::all();
        return view('admin.approve', compact('user', 'sports', 'roles', 'categories'));
    }

    public function storeApproval(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        
        $request->validate([
            'points' => 'required|integer',
            'sport_id' => 'required|exists:sports,sport_id',
            'role_id' => 'required|exists:roles,role_id',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $user->update([
            'points' => $request->points,
            'sport_id' => $request->sport_id,
            'role_id' => $request->role_id,
            'category_id' => $request->category_id,
            'approved' => true,
        ]);

        return redirect()->route('admin.index')->with('success', 'Użytkownik zatwierdzony.');
    }

    public function reject($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'Użytkownik odrzucony.');
    }

    public function showEventRegistration()
    {
        $events = Event::where('date', '>', now())->get();
        return view('admin.event_registration', compact('events'));
    }

    }