<?php
    
namespace App\Http\Controllers;
    
use App\Models\Posisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
class PosisiController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:posisi-list|posisi-create|posisi-edit|posisi-delete', ['only' => ['index','show']]);
         $this->middleware('permission:posisi-create', ['only' => ['create','store']]);
         $this->middleware('permission:posisi-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:posisi-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $keyword = $request->keyword;
        // $posisis = posisi::where('nama_posisi','LIKE','%'.$keyword.'%')->paginate(5);
        // return view('posisis.index',compact('posisis'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        $keyword = $request->keyword;
        $posisis = DB::table('posisis')
                    ->where('nama_posisi','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        return view('posisis.index',compact('posisis'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posisis.create');
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
            'id_posisi' => 'required',
            'nama_posisi' => 'required',
        ]);
    
        Posisi::create($request->all());
    
        return redirect()->route('posisis.index')
                        ->with('success','Posisi created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function show(Posisi $posisi)
    {
        return view('posisis.show',compact('posisi'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Posisi $posisi)
    {
        $posisis = DB::table('posisis')->where('id_posisi', $posisi)->first();
        return view('posisis.edit',compact('posisi'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         request()->validate([
            'nama_posisi' => 'required',
            'id_posisi' => 'required',
        ]);
    
        //$posisi->update($request->all());
        $posisi = DB::update('UPDATE posisis SET id_posisi = :id_posisi, nama_posisi = :nama_posisi WHERE id_posisi = :id',
        [
            'id' => $id,
            'id_posisi' => $request->id_posisi,
            'nama_posisi' => $request->nama_posisi,
           
        ]
        );
    
        return redirect()->route('posisis.index')
                        ->with('success','Posisi updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posisi  $posisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE posisis SET deleted_at = NOW() WHERE id_posisi = :id_posisi', ['id_posisi' => $id]);
    
        return redirect()->route('posisis.index')
                        ->with('success','Posisi deleted successfully');
    }
    public function deletelist()
    {
        $posisis = DB::table('posisis')
                    ->whereNotNull('deleted_at')
                    ->paginate(5);
        return view('/posisis/trash',compact('posisis'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function restore($id)
    {
        DB::update('UPDATE posisis SET deleted_at = NULL WHERE id_posisi = :id_posisi', ['id_posisi' => $id]);
    
        return redirect()->route('posisis.index')
                        ->with('success','Posisi Restored successfully');
    }
    public function deleteforce($id)
    {
        DB::delete('DELETE FROM posisis WHERE id_posisi=:id_posisi', ['id_posisi' => $id]);
        return redirect()->route('posisis.index')
                        ->with('success','Posisi Deleted Permanently');
    }

}


