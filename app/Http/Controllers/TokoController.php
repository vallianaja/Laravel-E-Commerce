<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Toko::all();
        $user = User::all();
        return view('toko/index', compact('toko', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validasi = Validator::make($input,[
            'nama_toko' => 'required|max:128|min:5|string',
            'desc_toko' => 'required',
            'kategori_toko' => 'required',
            'hari_buka' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'icon_toko' => "required|mimes:png, jpeg, jpg, svg|max:5048"

        ]);
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        // input untuk hari
        // gambar icon toko

        if($request->hasFile('icon_toko'))
        {
            $folder = 'public/image/toko'; //Membuat Folder Penyimpanan
            $gambar = $request->file('icon_toko'); // Mengambil Data Dari Request icon_toko
            $nama_gambar = $gambar->getClientOriginalName(); // Mengambil Nama Pada File Yang Diupload
            $path = $request->file('icon_toko')->storeAs($folder, $nama_gambar); // Mengirimkan Gambar Ke Folder
            $input['icon_toko'] = $nama_gambar; // Memberikan Nama Yang Dikirim Ke Database
        }
        // Konversi nilai array ke dalam sring :
        $hari = implode(',', $request->input('hari_buka'));
        $input['hari_buka'] = $hari;

        Toko::create($input);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Toko::find($id);
        return view('toko.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $toko = Toko::find($id);

    // Ambil semua input kecuali _token, _method, dan files
    $data = $request->except(['_token', '_method', 'files', 'hari_buka']);
    
    // Menangani file icon_toko
    if ($request->hasFile('icon_toko')) {
        $request->validate([
            'icon_toko' => 'mimes:png,jpg,jpeg,svg|max:5048'
        ]);

        if ($toko->icon_toko) {
            $filelama = 'public/image/toko/' . $toko->icon_toko;
            Storage::delete($filelama);
        }

        $gambar = $request->file('icon_toko');
        $nama_gambar = $gambar->getClientOriginalName();
        $gambar->storeAs('public/image/toko', $nama_gambar);

        $data['icon_toko'] = $nama_gambar;
    } else {
        // Tetap gunakan icon_toko yang sudah ada jika tidak ada file baru diunggah
        $data['icon_toko'] = $toko->icon_toko;
    }

    // Menangani hari_buka sebagai string atau JSON
    if ($request->has('hari_buka')) {
        $data['hari_buka'] = implode(',', $request->input('hari_buka'));
    }

    // Update data toko
    $toko->update($data);

    return redirect('/toko');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Toko::find($id);
        $data->delete();
        return back();
    }
}
