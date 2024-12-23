<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function setting()
    {
        return view('settings.index');
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Validasi untuk gambar
        ]);

        // Mengisi data user dari request
        $request->user()->fill($validatedData);

        // Cek apakah email diubah, jika ya maka reset email_verified_at
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Proses unggah foto profil jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto profil lama jika ada
            if ($request->user()->photo) {
                Storage::disk('public')->delete($request->user()->photo);
            }

            // Tentukan nama file berdasarkan nama pengguna
            $username = Str::slug($request->user()->name); // Slugify nama pengguna untuk nama file
            $extension = $request->file('photo')->getClientOriginalExtension(); // Ambil ekstensi file
            $filename = $username . '.' . $extension; // Gabungkan nama file dan ekstensi

            // Simpan foto baru ke folder `images/user`
            $path = $request->file('photo')->storeAs('images/user', $filename, 'public');

            // Perbarui atribut `photo`
            $request->user()->photo = $path;
        }

        // Simpan perubahan pada user
        $request->user()->save();

        // Redirect ke halaman profil dengan pesan sukses
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
