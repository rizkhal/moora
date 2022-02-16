<h1>Pengumuman untuk penerimaan <strong>{{ $reqruitment->name }}</strong></h1>

<p>
    Hai <strong>{{ $user->name }}</strong>, anda menerima email ini karena email ini digunakan untuk mendaftar sebagai peserta pada
    <strong>{{ $reqruitment->name }}</strong> disitus <a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a>

    <br />
    <br />

    {!! $announcement->content !!}
</p>
