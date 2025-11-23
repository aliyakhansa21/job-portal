<!DOCTYPE html>
<html>
    <body>
        <div>
            <div>                
                <h1>Selamat Datang di Dashboard!</h1>                
                <p>Halo, {{ Auth::user()->name }}!</p>
                <p>Ini adalah halaman rahasia yang hanya bisa kamu akses setelah berhasil login.</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>