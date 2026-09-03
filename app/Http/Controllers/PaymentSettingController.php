<?php

namespace App\Http\Controllers;

use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentSettingController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate(['bank_name' => 'required|string|max:100', 'account_number' => 'required|string|max:100', 'account_name' => 'required|string|max:255', 'qris' => 'nullable|image|max:2048']);
        $setting = PaymentSetting::firstOrNew();
        if ($request->hasFile('qris')) {
            Storage::disk('public')->delete($setting->qris_path);
            $data['qris_path'] = $request->file('qris')->store('payment', 'public');
        }
        unset($data['qris']);
        $setting->fill($data)->save();
        return back()->with('success', 'Pengaturan pembayaran berhasil diperbarui.');
    }
}
