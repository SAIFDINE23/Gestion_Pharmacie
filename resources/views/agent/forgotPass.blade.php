@extends('../templates/app2')

@section('page-content')

    <form id="formAuthentication" class="mb-3" action="{{ route('send_reset_link_email') }}" method="POST">
        @csrf
        @method('post')
        <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
            type="text"
            class="form-control"
            id="email"
            name="email"
            placeholder="Entrer votre email"
            autofocus
        />
        @if (session()->has('error'))
            <div class="text text-danger">
                {{ session()->get('error') }}
            </div>
        @else
            <div class="text text-danger">
                {{ session()->get('success') }}
            </div>
        @endif
        </div>
        <button class="btn btn-primary d-grid w-100 mt-5">Envoyer le lien de récupération</button>
    </form>
    <div class="text-center">
        <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
        revenir à la page de connexion
        </a>
    </div>

@endsection