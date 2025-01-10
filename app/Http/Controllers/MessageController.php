<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Menampilkan daftar percakapan untuk UMKM
    public function index()
    {
        // Mendapatkan pengguna UMKM yang sedang login
        $user = Auth::guard('umkm')->user();

        // Mendapatkan id_umkm dari pengguna yang sedang login
        $id_umkm = $user->id_umkm;

        // Mengambil semua pesan yang ditujukan ke UMKM yang sedang login
        $messages = Messages::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id_umkm)  // Pesan dari user ke UMKM
                ->orWhereNull('to_user_id') // Menangani pesan dengan to_user_id null
                ->whereNull('from_umkm_id'); // Menangani pesan dengan from_umkm_id null
        })
            ->orderBy('created_at', 'desc')
            ->get();

        // Debugging: Pastikan pesan yang diterima
        // dd($messages);

        // Mengambil ID dari semua pengguna yang terlibat dalam percakapan
        $userIds = $messages->pluck('from_user_id')->merge($messages->pluck('to_user_id'))->unique();

        // Menyaring hanya user dengan id_user yang valid (tidak null)
        $userNames = User::whereIn('id_user', $userIds->filter(function ($id) {
            return $id !== null;  // Hanya ambil ID yang tidak null
        }))
            ->pluck('username', 'id_user');

        // Menyediakan nilai default untuk user yang tidak ditemukan
        foreach ($messages as $message) {
            if (empty($userNames[$message->from_user_id])) {
                $userNames[$message->from_user_id] = 'Unknown User';
            }
            if (empty($userNames[$message->to_user_id])) {
                $userNames[$message->to_user_id] = 'Unknown User';
            }
        }

        // Mengirim data ke view
        return view('dashboard.umkm.messages.index', compact('messages', 'userNames', 'id_umkm', 'user'));
    }







    public function show($id_umkm, $id_user)
    {
        // Mengambil pesan antara UMKM dan user tertentu
        $messages = Messages::where(function ($query) use ($id_user, $id_umkm) {
            // Menyaring pesan yang dikirim dari user ke UMKM dan sebaliknya
            $query->where('from_user_id', $id_user)
                ->where('to_umkm_id', $id_umkm)
                ->orWhere('from_umkm_id', $id_umkm)
                ->where('to_user_id', $id_user);
        })
            ->leftJoin('user', 'user.id_user', '=', 'messages.from_user_id')
            ->leftJoin('pemilik_umkm', 'pemilik_umkm.id_umkm', '=', 'messages.from_umkm_id')
            ->select('messages.*', 'user.username as user_name', 'pemilik_umkm.nama_umkm as umkm_name')
            ->orderBy('messages.created_at', 'asc')
            ->get();

        // Menambahkan nilai default jika ada nilai yang kosong
        foreach ($messages as $message) {
            if (empty($message->user_name)) {
                $message->user_name = 'Unknown User';
            }
            if (empty($message->umkm_name)) {
                $message->umkm_name = 'Unknown UMKM';
            }
        }

        return view('dashboard.umkm.messages.show', compact('messages', 'id_umkm', 'id_user'));
    }

    // Mengirim pesan dari UMKM ke User atau sebaliknya
    public function send(Request $request, $id_umkm, $id_user)
    {
        $umkm = Auth::guard('umkm')->user(); // Ambil data UMKM yang sedang login

        // Validasi input pesan
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Tentukan ID pengirim dan penerima
        $message = new Messages();

        // Jika UMKM yang membalas pesan
        if ($umkm->id_umkm == $id_umkm) {
            $message->from_umkm_id = $umkm->id_umkm;  // ID UMKM yang mengirim pesan
            $message->to_user_id = $id_user;  // ID user yang menerima pesan
        } else {
            // Jika User yang mengirim pesan
            $message->from_user_id = $id_user;  // ID user yang mengirim pesan
            $message->to_umkm_id = $umkm->id_umkm;  // ID UMKM yang menerima pesan
        }

        // Isi pesan
        $message->message = $request->message;

        // Simpan pesan ke database
        $message->save();


        // Redirect kembali ke halaman percakapan
        return redirect()->route('umkm.messages.show', ['id_umkm' => $id_umkm, 'id_user' => $id_user])
            ->with('success', 'Pesan berhasil dikirim!');
    }
}
