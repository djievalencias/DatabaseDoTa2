<?php
    
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function index()
    {
        $joins = DB::table('heroes')
            ->join('atributs', 'heroes.id_atribut', '=', 'atributs.id_atribut')
            ->join('posisis', 'heroes.id_posisi', '=', 'posisis.id_posisi')
            ->select('heroes.nama_hero as nama_hero', 'atributs.nama_atribut as nama_atribut','posisis.nama_posisi as nama_posisi')
            ->paginate(6);
            return view('totals.index',compact('joins'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    }
}