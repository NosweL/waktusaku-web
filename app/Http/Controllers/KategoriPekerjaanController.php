<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use App\Http\Requests\Storekategori_pekerjaanRequest;
use App\Http\Requests\Updatekategori_pekerjaanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriPekerjaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kategori.index')->only('index');
        $this->middleware('permission:kategori.create')->only('create', 'store');
        $this->middleware('permission:kategori.edit')->only('edit', 'update');
        $this->middleware('permission:kategori.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $kategoris = DB::table('kategori_pekerjaans')
        ->when($request->input('kategori'), function ($query, $kategori) {
            return $query->where('kategori', 'like', '%' . $kategori . '%');
        })
        ->select('id', 'kategori', DB::raw("DATE_FORMAT(created_at, '%d %M %Y') as created_at"))
        ->paginate(10);

    return view('kategori.index', compact('kategoris'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storekategori_pekerjaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storekategori_pekerjaanRequest $request)
    {
        //simpan data
        KategoriPekerjaan::create([
            'kategori' => $request['kategori'],
        ]);
        return redirect(route('kategori.index'))->with('success', 'Data Berhasil Ditambahkan');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategori_pekerjaan  $kategori_pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(kategori_pekerjaan $kategori_pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategori_pekerjaan  $kategori_pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriPekerjaan $kategori)
    {
        return view('kategori.edit')
            ->with('kategori', $kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatekategori_pekerjaanRequest  $request
     * @param  \App\Models\kategori_pekerjaan  $kategori_pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatekategori_pekerjaanRequest $request, KategoriPekerjaan $kategori)
    {
        $validate = $request->validated();

        $kategori->update($validate);
        return redirect()->route('kategori.index')->with('success', 'User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kategori_pekerjaan  $kategori_pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriPekerjaan $kategori)
    {
        //delete data
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'User Deleted Successfully');
    }
}
