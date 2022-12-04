<?php
    
namespace App\Http\Controllers;
    
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
    
class HeroController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:hero-list|hero-create|hero-edit|hero-delete', ['only' => ['index','show']]);
         $this->middleware('permission:hero-create', ['only' => ['create','store']]);
         $this->middleware('permission:hero-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:hero-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $heros = Hero::where('nama_hero','LIKE','%'.$keyword.'%')->paginate(5);
        return view('heros.index',compact('heros'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // $keyword = $request->keyword;
        // $heros = DB::table('heroes')
        //             ->where('nama_hero','LIKE','%'.$keyword.'%')
        //             ->paginate(5);
        // return view('heros.index',compact('heros'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('heros.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_hero' => 'required',
            'nama_hero' => 'required',
            'id_atribut' => 'required',
            'id_posisi' => 'required',
        ]);
    
        DB::insert('INSERT INTO heroes(id_hero, nama_hero, id_atribut, id_posisi) VALUES (:id_hero, :nama_hero, :id_atribut, :id_posisi)',
        [
            'id_hero' => $request->id_hero,
            'nama_hero' => $request->nama_hero,
            'id_atribut' => $request->id_atribut,
            'id_posisi' => $request->id_posisi,
        ]
        );
    
        return redirect()->route('heros.index')
                        ->with('success','Hero created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Hero $hero)
    {
        return view('heros.show',compact('hero'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hero = DB::table('heroes')->where('id_hero', $id)->first();
        return view('heros.edit',compact('hero'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
         $request->validate([
            'id_hero' => 'required',
            'nama_hero' => 'required',
            'id_atribut' => 'required',
            'id_posisi' => 'required'
        ]);
       //$hero->update($request->all());
        $hero = DB::update('UPDATE heroes SET id_hero = :id_hero, nama_hero = :nama_hero, id_atribut = :id_atribut, id_posisi = :id_posisi WHERE id_hero = :id',
        [
            'id' => $id,
            'id_hero' => $request->id_hero,
            'nama_hero' => $request->nama_hero,
            'id_atribut' => $request->id_atribut,
            'id_posisi' => $request->id_posisi,
           
        ]
        );
        return redirect()->route('heros.index')
                        ->with('success','Hero updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    // public function soft($id)
    // {
    //     DB::update('UPDATE heroes SET is_delete = 1 WHERE id_hero = :id_hero', ['id_hero' => $id]);

    //     return redirect()->route('heros.index')->with('success', 'Data Barang berhasil dihapus');
    // }


    public function destroy(Hero $hero)
    {
        $hero->delete();
    
        return redirect()->route('heros.index')
                        ->with('success','Hero deleted successfully');
    }
    public function deletelist()
    {
        $heros = Hero::onlyTrashed()->paginate(5);
        return view('/heros/trash',compact('heros'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        $hero = Hero::withTrashed()->where('id_hero',$id)->restore();
        return redirect()->route('heros.index')
                        ->with('success','Hero Restored successfully');
    }
    public function deleteforce( $id)
    {
        DB::delete('DELETE FROM heroes WHERE id_hero=:id_hero', ['id_hero' => $id]);
        return redirect()->route('heros.index')
                        ->with('success','Hero Deleted Permanently');
    }   
 }