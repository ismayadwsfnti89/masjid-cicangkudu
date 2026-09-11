<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\MasjidContent;
use App\Models\User;
use App\Notifications\DonationProofSubmitted;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\PaymentSetting;

class DonationController extends Controller
{
    public function index()
    {
        $programs = MasjidContent::where('type', 'donasi')->whereIn('status', ['published', 'active'])->get();
        $paymentSetting = PaymentSetting::first();
        return view('warga.donasi', compact('programs', 'paymentSetting'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'masjid_content_id' => ['nullable', Rule::exists('masjid_contents', 'id')->where('type', 'donasi')],
            'amount' => ['required', 'numeric', 'min:1000'],
            'payment_method' => ['required', 'in:cash,qris,transfer_bank'],
            'proof' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048', 'required_unless:payment_method,cash'],
        ]);

        $data['user_id'] = $request->user()->id;
        $data['proof_path'] = $request->hasFile('proof') ? $request->file('proof')->store('donation-proofs', 'public') : null;
        $data['status'] = 'pending';
        unset($data['proof']);

        $donation = Donation::create($data);
        $donation->load('user');
        User::where('role', 'admin')->get()->each->notify(new DonationProofSubmitted($donation));

        return back()->with('success', 'Bukti transfer berhasil dikirim. Admin akan memverifikasinya.');
    }
}
