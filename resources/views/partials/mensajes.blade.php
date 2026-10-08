@if (session('success'))
    <div
        class="alert alert-success"
        role="status"
        data-autohide
    >
        {{ session('success') }}
    </div>
@endif


@if (session('error'))
    <div
        class="alert alert-error"
        role="alert"
    >
        {{ session('error') }}
    </div>
@endif


@if ($errors->any())
    <div
        class="alert alert-error"
        role="alert"
    >
        <strong>
            Revisa los siguientes datos:
        </strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif