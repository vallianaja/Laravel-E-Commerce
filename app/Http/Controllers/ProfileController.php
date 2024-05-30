<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $validasi = Validator::make($data, [
            'nomor_hp' => 'required|max:15|min:10',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'foto_profile' => 'required|mimes:png,jpg,jpeg,heic'
        ]);
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }
        if($request->hasFile('foto_profile'))
        {
            $folder = 'public/image/profile'; //Membuat Folder Penyimpanan
            $gambar = $request->file('foto_profile'); // Mengambil Data Dari Request Foto_Profile
            $nama_gambar = $gambar->getClientOriginalName(); // Mengambil Nama Pada File Yang Diupload
            $path = $request->file('foto_profile')->storeAs($folder, $nama_gambar); // Mengirimkan Gambar Ke Folder
            $data['foto_profile'] = $nama_gambar; // Memberikan Nama Yang Dikirim Ke Database
        }

        Profile::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
