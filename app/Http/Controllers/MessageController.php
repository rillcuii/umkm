<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Messages;
use App\Models\PemilikUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Menampilkan daftar percakapan untuk UMKM
    public function index()
    {
        // Ambil ID UMKM yang sedang login
        $user = Auth::guard('umkm')->user();
        $id_umkm = $user->id_umkm;

        // Ambil percakapan berdasarkan UMKM, hanya dari pengguna yang mengirim ke UMKM atau sebaliknya
        $messages = Messages::where(function ($query) use ($id_umkm) {
            // Cari pesan yang dikirim dari pengguna ke UMKM atau sebaliknya
            $query->where('from_umkm_id', $id_umkm)
                ->orWhere('to_umkm_id', $id_umkm);
        })
            ->whereNotNull('from_user_id') // Filter hanya pesan yang melibatkan pengguna
            ->where(function ($query) use ($id_umkm) {
                // Filter pesan yang melibatkan UMKM
                $query->where('from_umkm_id', $id_umkm)
                    ->orWhere('to_umkm_id', $id_umkm);
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu pesan
            ->get();

        // Kelompokkan pesan berdasarkan from_user_id untuk mengambil percakapan terakhir dari setiap pengguna
        $uniqueMessages = $messages->groupBy('from_user_id')->map(function ($messageGroup) {
            // Ambil pesan terakhir dari setiap pengguna
            return $messageGroup->first();
        });

        // Ambil ID pengguna yang terlibat dalam percakapan
        $userIds = $uniqueMessages->pluck('from_user_id')->merge($uniqueMessages->pluck('to_user_id'))->unique();

        // Filter untuk menghapus ID yang bernilai null
        $userIds = $userIds->filter(function ($id) {
            return !is_null($id); // Menghapus ID yang null
        });

        // Ambil nama-nama pengguna yang terlibat dalam percakapan
        $userNames = User::whereIn('id_user', $userIds)->pluck('nama_lengkap', 'id_user');

        // Kirim data ke view
        return view('dashboard.umkm.messages.index', compact('uniqueMessages', 'userNames', 'id_umkm'));
    }



    public function show($id_umkm, $id_user)
    {
        $messages = Messages::where(function ($query) use ($id_user, $id_umkm) {
            $query->where(function ($subQuery) use ($id_user, $id_umkm) {
                $subQuery->where('from_user_id', $id_user)
                    ->where('to_umkm_id', $id_umkm);
            })
                ->orWhere(function ($subQuery) use ($id_user, $id_umkm) {
                    $subQuery->where('from_umkm_id', $id_umkm)
                        ->where('to_user_id', $id_user);
                });
        })
            ->leftJoin('user', 'user.id_user', '=', 'messages.from_user_id')
            ->leftJoin('pemilik_umkm', 'pemilik_umkm.id_umkm', '=', 'messages.from_umkm_id')
            ->select(
                'messages.*',
                'user.username as user_name',
                'pemilik_umkm.nama_umkm as umkm_name'
            )
            ->orderBy('messages.created_at', 'asc')
            ->get();

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

    public function send(Request $request, $id_umkm, $id_user)
    {
        $umkm = Auth::guard('umkm')->user();

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = new Messages();

        if ($umkm->id_umkm == $id_umkm) {
            $message->from_umkm_id = $umkm->id_umkm;
            $message->to_user_id = $id_user;
        } else {
            $message->from_user_id = $id_user;
            $message->to_umkm_id = $umkm->id_umkm;
        }

        $message->message = $request->message;

        $message->save();


        return redirect()->route('umkm.messages.show', ['id_umkm' => $id_umkm, 'id_user' => $id_user])
            ->with('success', 'Pesan berhasil dikirim!');
    }

    public function indexForPelanggan($id_user)
    {
        // Ambil percakapan berdasarkan ID pengguna dan UMKM
        $messages = Messages::where('from_user_id', $id_user)
            ->orWhere('to_user_id', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil nama-nama pengguna dan UMKM yang terlibat dalam percakapan
        $userIds = $messages->pluck('from_user_id')->merge($messages->pluck('to_user_id'))->unique();
        $userNames = User::whereIn('id_user', $userIds)->pluck('nama_lengkap', 'id_user');

        // Ambil daftar UMKM yang terlibat dalam percakapan (dengan ID UMKM)
        $umkms = PemilikUmkm::whereIn('id_umkm', $messages->pluck('from_umkm_id')->merge($messages->pluck('to_umkm_id'))->unique())->get();

        // Kirim data ke view
        return view('dashboard.pelanggan.messages.index', compact('messages', 'userNames', 'umkms', 'id_user'));
    }


    public function showForPelanggan($id_user, $id_umkm)
    {
        // Ambil pesan antara pelanggan dan UMKM
        $messages = Messages::where(function ($query) use ($id_user, $id_umkm) {
            $query->where('from_user_id', $id_user)
                ->where('to_umkm_id', $id_umkm);
        })
            ->orWhere(function ($query) use ($id_user, $id_umkm) {
                $query->where('from_umkm_id', $id_umkm)
                    ->where('to_user_id', $id_user);
            })
            ->leftJoin('user', 'user.id_user', '=', 'messages.from_user_id')
            ->leftJoin('pemilik_umkm', 'pemilik_umkm.id_umkm', '=', 'messages.from_umkm_id')
            ->select(
                'messages.*',
                'user.username as user_name',
                'pemilik_umkm.nama_umkm as umkm_name'
            )
            ->orderBy('messages.created_at', 'asc')
            ->get();

        $umkm = PemilikUmkm::find($id_umkm);
        $nama_umkm = $umkm ? $umkm->nama_umkm : 'Unknown UMKM';

        // Tambahkan nama pengirim jika tidak ada
        foreach ($messages as $message) {
            if (empty($message->user_name)) {
                $message->user_name = 'Unknown User';
            }
            if (empty($message->umkm_name)) {
                $message->umkm_name = 'Unknown UMKM';
            }
        }

        return view('dashboard.pelanggan.messages.show', compact('messages', 'id_umkm', 'id_user', 'nama_umkm'));
    }

    public function sendForPelanggan(Request $request, $id_user, $id_umkm)
    {
        // Validasi pesan yang dikirim
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = new Messages();
        $message->from_user_id = $id_user;
        $message->to_umkm_id = $id_umkm;
        $message->message = $request->message;
        $message->save();

        return redirect()->route('pelanggan.messages.show', ['id_user' => $id_user, 'id_umkm' => $id_umkm])
            ->with('success', 'Pesan berhasil dikirim!');
    }
}
