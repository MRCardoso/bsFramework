<p>
    <strong>{{ \Illuminate\Support\Facades\Lang::get('passwords.passwordLink') }}:</strong>
    <a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>
</p>