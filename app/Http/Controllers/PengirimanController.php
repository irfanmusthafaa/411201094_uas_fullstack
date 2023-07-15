<?php

namespace App\Http\Controllers;

use App\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Jsonable;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Pengiriman::orderBy('tanggal', 'desc')->paginate(10); // Change '10' to the desired number of items per page
        return view('pengiriman.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kurirQuery = DB::table('kurir');
        $defaultKurirID = null;

        if (Auth::user()->level == 2) {
            $userKurirId = DB::table('kurir')->where('email', Auth::user()->email)->value('id');
            $kurirQuery->where('id', $userKurirId);
            $defaultKurirID = $userKurirId;
        }
        
        $kurir = $kurirQuery->pluck('name', 'id');
        $barang = DB::table('barang')->pluck('nama_barang','id');
        $lokasi = DB::table('lokasi')->pluck('nama_lokasi','id');
        
        return view('pengiriman.create', compact('barang', 'kurir', 'lokasi', 'defaultKurirID'));
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $messages = [
                'no_pengiriman.required' => 'Silakan isi no pengiriman',
                'no_pengiriman.unique' => 'Kode no pengiriman terdaftar',
                'tanggal.required' => 'Silakan isi tanggal',
                'tanggal.date' => 'Silakan isi tanggal dengan format yang sesuai',
                'lokasi_id.required' => 'Silakan isi lokasi id',
                'lokasi_id.numeric' => 'Silakan isi lokasi id dengan angka',
                'barang_id.required' => 'Silakan isi barang id',
                'barang_id.numeric' => 'Silakan isi barang id dengan angka',
                'kurir_id.required' => 'Silakan isi kurir id',
                'kurir_id.numeric' => 'Silakan isi kurir id dengan angka',
            ];
            $validator = Validator::make($request->all(), [
                'no_pengiriman'=> 'required|unique:pengiriman',
                'tanggal'=> 'required|date',
                'lokasi_id'=> 'required|numeric',
                'barang_id'=> 'required|numeric',
                'kurir_id'=> 'required|numeric',
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
           }

            $barang_id = $request->input('barang_id');
            $barang = DB::table('barang')->where('id',$barang_id)->first();
            if (empty($barang)) {
                return Redirect::back()->withErrors(['error_msg'=> 'Barang tidak terdaftar']);
            }

            $lokasi_id = $request->input('lokasi_id');
            $lokasi= DB::table('lokasi')->where('id',$lokasi_id)->first();
            if (empty($lokasi)) {
                return Redirect::back()->withErrors(['error_msg'=> 'Lokasi tidak terdaftar']);
            }

            $kurir_id = $request->input('kurir_id');
            $kurir= DB::table('lokasi')->where('id',$kurir_id)->first();
            if (empty($lokasi)) {
                return Redirect::back()->withErrors(['error_msg'=> 'Kurir tidak terdaftar']);
            }

            $validasiLokasi = Pengiriman::where(
                [
                    'lokasi_id' => $lokasi_id,
                    'tanggal' => $request->input('tanggal'),
                ])->count();
            if ($validasiLokasi >= 5) {
                return Redirect::back()->withErrors(['error_msg'=> 'Lokasi sudah melakukan transaksi lebih dari 5 kali per hari']);
            }

            $pengiriman = new Pengiriman();
            $pengiriman->no_pengiriman = $request->input('no_pengiriman');
            $pengiriman->tanggal = $request->input('tanggal');
            $pengiriman->lokasi_id = $lokasi_id;
            $pengiriman->barang_id = $barang_id;
            $pengiriman->kurir_id = $kurir_id;
            $pengiriman->jumlah_barang = $request->input('jumlah_barang');
            $pengiriman->harga_barang = $request->input('harga_barang');
            $pengiriman->is_approved = 0;
            $pengiriman->save();
    
            return \redirect('pengiriman')->with('success', 'Tambah data berhasil');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Pengiriman::find($id);

        return view('pengiriman.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = Pengiriman::find($id);

        $kurirQuery = DB::table('kurir');
        $defaultKurirID = null;

        if (Auth::user()->level == 2) {
            $userKurirId = DB::table('kurir')->where('email', Auth::user()->email)->value('id');
            $kurirQuery->where('id', $userKurirId);
            $defaultKurirID = $userKurirId;
        }
        
        $kurir = $kurirQuery->pluck('name', 'id');
        $barang = DB::table('barang')->pluck('nama_barang','id');
        $lokasi = DB::table('lokasi')->pluck('nama_lokasi','id'); 
        
        return view('pengiriman.edit', compact('detail','barang', 'kurir', 'lokasi', 'defaultKurirID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $messages = [
                'no_pengiriman.required' => 'Silakan isi no pengiriman',
                'tanggal.required' => 'Silakan isi tanggal',
                'lokasi_id.required' => 'Silakan isi lokasi id',
                'lokasi_id.numeric' => 'Silakan isi lokasi id dengan angka',
                'barang_id.required' => 'Silakan isi barang id',
                'barang_id.numeric' => 'Silakan isi barang id dengan angka',
                'kurir_id.required' => 'Silakan isi kurir id',
                'kurir_id.numeric' => 'Silakan isi kurir id dengan angka',
                'jumlah_barang.required' => 'Silakan isi jumlah barang',
                'jumlah_barang.numeric' => 'Silakan isi jumlah barang dengan angka',
                'harga_barang.required' => 'Silakan isi harga barang',
                'harga_barang.numeric' => 'Silakan isi harga barang dengan angka'
            ];
            $validator = Validator::make($request->all(), [
                'no_pengiriman'=> 'required',
                'tanggal'=> 'required',
                'lokasi_id'=> 'required|numeric',
                'barang_id'=> 'required|numeric',
                'kurir_id'=> 'required|numeric',
                'jumlah_barang'=> 'required|numeric',
                'harga_barang'=>'required|numeric'
            ], $messages);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput($request->all());
           }

            $barang_id = $request->input('barang_id');
            $barang = DB::table('barang')->where('id',$barang_id)->first();
            if (empty($barang)) {
                return Redirect::back()->withErrors(['error_msg'=> 'Barang tidak terdaftar']);
            }

            $lokasi_id = $request->input('lokasi_id');
            $lokasi= DB::table('lokasi')->where('id',$lokasi_id)->first();
            if (empty($lokasi)) {
                return Redirect::back()->withErrors(['error_msg'=> 'Lokasi tidak terdaftar']);
            }

            $kurir_id = $request->input('kurir_id');
            $kurir= DB::table('lokasi')->where('id',$kurir_id)->first();
            if (empty($lokasi)) {
                return Redirect::back()->withErrors(['error_msg'=> 'Kurir tidak terdaftar']);
            }

            $validasiLokasi = Pengiriman::where(
                [
                    'lokasi_id' => $lokasi_id,
                    'tanggal' => $request->input('tanggal'),
                ])->count();
            if ($validasiLokasi >= 5) {
                return Redirect::back()->withErrors(['error_msg'=> 'Lokasi sudah melakukan transaksi lebih dari 5 kali per hari']);
            }

            $pengiriman = Pengiriman::find($id);
            $pengiriman->no_pengiriman = $request->input('no_pengiriman');
            $pengiriman->tanggal = $request->input('tanggal');
            $pengiriman->lokasi_id = $lokasi_id;
            $pengiriman->barang_id = $barang_id;
            $pengiriman->kurir_id = $kurir_id;
            $pengiriman->jumlah_barang = $request->input('jumlah_barang');
            $pengiriman->harga_barang = $request->input('harga_barang');
            $pengiriman->is_approved = 0;
            
            $pengiriman->save();
    
            return \redirect('pengiriman')->with('success', 'Tambah data berhasil');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['error_msg'=>$th]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            DB::table('pengiriman')->where('id', $id)->delete();
            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th, 'message' => 'failed'], 422);
        }
    }

    public function approve($id)
    {
        try {
            $user = auth()->user();

            $detail = DB::table('pengiriman')->where('id', $id)->first();
            if (boolval($detail->is_approved)){
                return response()->json(['message' => 'pengiriman sudah di approve'], 400);
            }

            if ($user->id == $detail->kurir_id){
                return response()->json(['message' => 'pengiriman hanya bisa di approve oleh user lain'], 401);
            }
            DB::table('pengiriman')->where('id',$id)->update([
                'is_approved'=>  1
            ]);

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th, 'message' => 'failed'], 422);
        }
    }
}
