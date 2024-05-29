<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Trip;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function index()
    {
        $tables = ['trainings'];

        return view('admin.index', compact('tables'));
    }

    public function showTable($table)
    {
        // Sprawdzanie, czy tabela istnieje w bazie danych
        if (!Schema::hasTable($table)) {
            return redirect()->route('admin.index')->with('error', 'Tabela nie istnieje.');
        }

        // Pobranie wszystkich rekordów z wybranej tabeli
        $records = DB::table($table)->get();

        // Przekazanie rekordów do widoku
        return view('admin.table', compact('table', 'records'));
    }
}
