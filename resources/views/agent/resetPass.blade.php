@extends('../templates/app2')

@section('page-content')

    <form id="formAuthentication" class="mb-3" action="{{ route('register_new_password') }}" method="POST">
        @csrf
        @method('post')
        <div class="mb-3 form-password-toggle">
            <div class="input-group input-group-merge">
            <input
                type="password"
                id="password"
                class="form-control"
                name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            @if ($errors->has('password'))
                <div class="text text-danger">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="input-group input-group-merge">
            <input
                type="password"
                id="password"
                class="form-control"
                name="password_confirmation"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100 mt-5">Confirmer</button>
    </form>

@endsection