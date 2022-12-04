<?php
    
namespace App\Http\Controllers;
    
use App\Models\Atribut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
class AtributController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:atribut-list|atribut-create|atribut-edit|atribut-delete', ['only' => ['index','show']]);
         $this->middleware('permission:atribut-create', ['only' => ['create','store']]);
         $this->middleware('permission:atribut-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:atribut-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $keyword = $request->keyword;
        // $atributs = atribut::where('nama_atribut','LIKE','%'.$keyword.'%')->paginate(5);
        // return view('atributs.index',compact('atributs'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        $keyword = $request->keyword;
        $atributs = DB::table('atributs')
                    ->where('nama_atribut','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        return view('atributs.index',compact('atributs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('atributs.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'id_atribut' => 'required',
            'nama_atribut' => 'required',
        ]);
    
        Atribut::create($request->all());
    
        return redirect()->route('atributs.index')
                        ->with('success','Atribut created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Atribut  $atribut
     * @return \Illuminate\Http\Response
     */
    public function show(Atribut $atribut)
    {
        return view('atributs.show',compact('atribut'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atribut  $atribut
     * @return \Illuminate\Http\Response
     */
    public function edit(Atribut $atribut)
    {
        $atributs = DB::table('atributs')->where('id_atribut', $atribut)->first();
        return view('atributs.edit',compact('atribut'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atribut  $atribut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         request()->validate([
            'nama_atribut' => 'required',
            'id_atribut' => 'required',
        ]);
    
        //$atribut->update($request->all());
        $posisi = DB::update('UPDATE atributs SET id_atribut = :id_atribut, nama_atribut = :nama_atribut WHERE id_atribut = :id',
        [
            'id' => $id,
            'id_atribut' => $request->id_atribut,
            'nama_atribut' => $request->nama_atribut,
           
        ]
        );
    
        return redirect()->route('atributs.index')
                        ->with('success','Atribut updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atribut  $atribut
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE atributs SET deleted_at = NOW() WHERE id_atribut = :id_atribut', ['id_atribut' => $id]);
    
        return redirect()->route('atributs.index')
                        ->with('success','Atribut deleted successfully');
    }
    public function deletelist()
    {
        $atributs = DB::table('atributs')
                    ->whereNotNull('deleted_at')
                    ->paginate(5);
        return view('/atributs/trash',compact('atributs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        DB::update('UPDATE atributs SET deleted_at = NULL WHERE id_atribut = :id_atribut', ['id_atribut' => $id]);
    
        return redirect()->route('atributs.index')
                        ->with('success','Atribut Restored successfully');
    }
    public function deleteforce($id)
    {
        DB::delete('DELETE FROM atributs WHERE id_atribut=:id_atribut', ['id_atribut' => $id]);
        return redirect()->route('atributs.index')
                        ->with('success','Atribut Deleted Permanently');
    }


}

