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
        $user = Auth::guard('umkm')->user();

        $id_umkm = $user->id_umkm;

        $messages = Messages::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id_umkm)
                ->orWhereNull('to_user_id')
                ->whereNull('from_umkm_id');
        })
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($messages);

        $userIds = $messages->pluck('from_user_id')->merge($messages->pluck('to_user_id'))->unique();

        $userNames = User::whereIn('id_user', $userIds->filter(function ($id) {
            return $id !== null;  
        }))
            ->pluck('username', 'id_user');

        foreach ($messages as $message) {
            if (empty($userNames[$message->from_user_id])) {
                $userNames[$message->from_user_id] = 'Unknown User';
            }
            if (empty($userNames[$message->to_user_id])) {
                $userNames[$message->to_user_id] = 'Unknown User';
            }
        }

        return view('dashboard.umkm.messages.index', compact('messages', 'userNames', 'id_umkm', 'user'));
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
}
