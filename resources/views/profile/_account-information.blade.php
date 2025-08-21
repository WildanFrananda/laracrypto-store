<div class="space-y-12">
    {{-- Bagian Update Informasi Profil --}}
    <section>
        {{-- Teruskan variabel $user ke partial selanjutnya --}}
        @include('profile.partials.update-profile-information-form', ['user' => $user])
    </section>

    {{-- Bagian Update Password --}}
    <section>
        {{-- Teruskan variabel $user ke partial selanjutnya --}}
        @include('profile.partials.update-password-form', ['user' => $user])
    </section>
    {{-- Bagian Hapus Akun --}}
    <section>
        {{-- Teruskan variabel $user ke partial selanjutnya --}}
        @include('profile.partials.delete-user-form', ['user' => $user])
    </section>
</div>
