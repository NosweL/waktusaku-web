<?php

namespace App\Http\Controllers;

use App\Models\LowonganPekerjaan;
use App\Models\Perusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\ProfileUser;
use App\Models\User;
use App\Http\Requests\StoreLowonganPekerjaanRequest;
use App\Http\Requests\UpdateLowonganPekerjaanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LowonganPekerjaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:loker.index')->only('index');
        $this->middleware('permission:loker.create')->only('create', 'store');
        $this->middleware('permission:loker.edit')->only('edit', 'update');
        $this->middleware('permission:loker.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $allResults = DB::table('lowongan_pekerjaans as lp')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->join('kategori_pekerjaans as kp', 'lp.id_kategori', '=', 'kp.id')
            ->join('profile_users as pu', 'lp.user_id', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select(
                'lp.id',
                'lp.user_id',
                'lp.id_perusahaan',
                'lp.id_kategori',
                'p.nama',
                'kp.kategori',
                'lp.judul',
                'lp.deskripsi',
                'lp.requirement',
                'lp.tipe_pekerjaan',
                'lp.gaji',
                'lp.jumlah_pelamar',
                'lp.status',
                'u.name',
            )
            ->paginate(10);

        $loggedInUserId = Auth::id();

        $loggedInUserResults = DB::table('lowongan_pekerjaans as lp')
            ->join('perusahaan as p', 'lp.id_perusahaan', '=', 'p.id')
            ->join('kategori_pekerjaans as kp', 'lp.id_kategori', '=', 'kp.id')
            ->join('profile_users as pu', 'lp.user_id', '=', 'pu.id')
            ->join('users as u', 'pu.user_id', '=', 'u.id')
            ->select('lp.id', 'lp.user_id', 'lp.id_perusahaan', 'lp.id_kategori', 'p.nama', 'kp.kategori', 'lp.judul', 'lp.deskripsi', 'lp.requirement', 'lp.tipe_pekerjaan', 'lp.gaji', 'lp.jumlah_pelamar', 'lp.status')
            ->where('u.id', $loggedInUserId)
            ->paginate(10);

        return view('loker.index', ['allResults' => $allResults, 'loggedInUserResults' => $loggedInUserResults]);
    }

    public function create()
    {
        $kategoris = KategoriPekerjaan::all();

        $user = auth()->user();
        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker.create', [
            'kategoris' => $kategoris,
            'user' => $user,
            'perusahaan' => $perusahaan,
            'profileUser' => $profileUser,
        ])->with(['kategoris' => $kategoris]);
    }

    public function store(StoreLowonganPekerjaanRequest $request)
    {
        LowonganPekerjaan::create([
            'user_id' => $request->user_id,
            'id_perusahaan' => $request->id_perusahaan,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'requirement' => $request->requirement,
            'tipe_pekerjaan' => $request->tipe_pekerjaan,
            'gaji' => $request->gaji,
            'jumlah_pelamar' => $request->jumlah_pelamar,
            'status' => $request->status,
        ]);

        return redirect()->route('loker.index')
            ->with('success', 'Lowongan Pekerjaan berhasil ditambahkan');
    }

    public function show(LowonganPekerjaan $lowonganPekerjaan)
    {
    }

    public function edit(LowonganPekerjaan $loker)
    {
        $kategoris = KategoriPekerjaan::all();
        $user = auth()->user();
        $profileUser = ProfileUser::where('user_id', $user->id)->first();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        return view('loker.edit', [
            'loker' => $loker,
            'kategoris' => $kategoris,
            'user' => $user,
            'perusahaan' => $perusahaan,
            'profileUser' => $profileUser,
        ])->with(['kategoris' => $kategoris]);
    }

    public function update(UpdateLowonganPekerjaanRequest $request, LowonganPekerjaan $loker)
    {
        $loker->update($request->all());

        return redirect()->route('loker.index')
            ->with('success', 'Data lowongan pekerjaan berhasil diperbarui.');
    }


    public function destroy(LowonganPekerjaan $loker)
    {
        try {
            $loker->delete();
            return redirect()->route('loker.index')->with('success', 'Data Lowongan Berhasil Di Hapus');
        } catch (\Exception $e) {
            return redirect()->route('loker.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

}