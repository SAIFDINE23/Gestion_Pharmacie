@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Nouveau compte</h2>


        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif 

        <form action="{{ route('create.profil') }}" method="post">   
            @csrf
            @method('post') 
            <div class="row d-flex justify-content-center">
                <div class="col-xl-8">
                <!-- HTML5 Inputs -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="html5-text-input" class="form-label">Nom</label>
                                <input class="form-control" type="text" name="nom" id="html5-text-input"/>
                                @error('nom')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="html5-text-input" class="form-label">Email</label>
                                <input class="form-control" type="text" name="email">
                                @error('email')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="mb-3 form-password-toggle">
                                    <label for="html5-text-input" class="form-label">Mot de passe</label>
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
                                    <label for="html5-text-input" class="form-label">Confirmez le mot de passe</label>
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
                            <div class="d-flex p-2 mt-4 justify-content-center">
                                <div class="col-sm-3 m-2">
                                    <input class="btn rounded-pill btn-primary w-100" type="submit" value="Créer compte"/>
                                </div >

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> 
        </form>
    </div>

    <div
            class="modal fade"
            id="modalToggle2"
            aria-hidden="true"
            aria-labelledby="modalToggleLabel2"
            tabindex="-1"
        >
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                    <h1>Scan QR Codes</h1>
                    <div class="section">
                        <div id="my-qr-reader">
                        </div>
                    </div>
                    </div>
                    <script src="https://unpkg.com/html5-qrcode"></script>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                </div>
            </div>
            </div>
    </div>

@endsection