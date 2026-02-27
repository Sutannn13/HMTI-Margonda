<?php

namespace App\Http\Controllers;

use App\Mail\CollaborationRequestMail;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    /**
     * Public landing page.
     */
    public function home()
    {
        return view('guest.home');
    }

    /**
     * Public organization structure page.
     */
    public function structure()
    {
        $kwsb = OrganizationMember::where('division', 'kwsb')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $kominfo = OrganizationMember::where('division', 'kominfo')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $litbang = OrganizationMember::where('division', 'litbang')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $psdm = OrganizationMember::where('division', 'psdm')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        return view('guest.structure', compact('kwsb', 'kominfo', 'litbang', 'psdm'));
    }

    /**
     * Handle collaboration form submission.
     */
    public function collab(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:150',
            'email'   => 'required|email|max:150',
            'phone'   => 'nullable|string|max:20',
            'type'    => 'required|string|max:100',
            'message' => 'required|string|max:3000',
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'type.required'    => 'Jenis kolaborasi wajib dipilih.',
            'message.required' => 'Deskripsi kolaborasi wajib diisi.',
        ]);

        Mail::to('hmti.ubsi.margonda@gmail.com')
            ->send(new CollaborationRequestMail(
                senderName:    $data['name'],
                senderEmail:   $data['email'],
                senderPhone:   $data['phone'] ?? '',
                collabType:    $data['type'],
                collabMessage: $data['message'],
            ));

        return redirect()->route('home', ['#kolaborasi'])
            ->with('collab_success', true);
    }
}
