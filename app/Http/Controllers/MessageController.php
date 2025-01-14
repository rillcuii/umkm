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
    public function index()
    {
        $user = Auth::guard('umkm')->user();
        $id_umkm = $user->id_umkm;

        $messages = Messages::where(function ($query) use ($id_umkm) {
            $query->where('from_umkm_id', $id_umkm)
                ->orWhere('to_umkm_id', $id_umkm);
        })
            ->whereNotNull('from_user_id') 
            ->where(function ($query) use ($id_umkm) {
                // Filter pesan yang melibatkan UMKM
                $query->where('from_umkm_id', $id_umkm)
                    ->orWhere('to_umkm_id', $id_umkm);
            })
            ->orderBy('created_at', 'desc') 
            ->get();

        $uniqueMessages = $messages->groupBy('from_user_id')->map(function ($messageGroup) {
            return $messageGroup->first();
        });

        $userIds = $uniqueMessages->pluck('from_user_id')->merge($uniqueMessages->pluck('to_user_id'))->unique();

        $userIds = $userIds->filter(function ($id) {
            return !is_null($id); 
        });

        $userNames = User::whereIn('id_user', $userIds)->pluck('nama_lengkap', 'id_user');

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
        $messages = Messages::where('from_user_id', $id_user)
            ->orWhere('to_user_id', $id_user)
            ->orderBy('created_at', 'desc')
            ->get();

        $userIds = $messages->pluck('from_user_id')->merge($messages->pluck('to_user_id'))->unique();
        $userNames = User::whereIn('id_user', $userIds)->pluck('nama_lengkap', 'id_user');

        $umkms = PemilikUmkm::whereIn('id_umkm', $messages->pluck('from_umkm_id')->merge($messages->pluck('to_umkm_id'))->unique())->get();

        return view('dashboard.pelanggan.messages.index', compact('messages', 'userNames', 'umkms', 'id_user'));
    }


    public function showForPelanggan($id_user, $id_umkm)
    {        $messages = Messages::where(function ($query) use ($id_user, $id_umkm) {
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
