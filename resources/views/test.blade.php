<button onclick="
    event.preventDefault();
    document.getElementById('logout').submit()
">
    Logout
</button>

<form
    id="logout"
    action="{{ route('logout') }}"
    method="POST"
    style="display: none"
>
    @csrf
</form>
