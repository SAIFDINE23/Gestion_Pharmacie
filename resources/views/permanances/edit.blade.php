@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Modifier une permanance</h2>

        <div class="demo-inline-spacing mb-4">
            <a
            
                class="btn btn-lg btn-primary"
                href="{{ route('permanance.info') }}"
            >
                <span class="tf-icons bx bx-back"></span>&nbsp;Retour
            </a>
        </div>

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif 

        <form action="{{ route('permanance.update', $permanance->id_phar) }}" method="post">   
            @csrf
            @method('put') 
            <div class="row d-flex justify-content-center">
                <div class="col-xl-8">
                <!-- HTML5 Inputs -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="html5-text-input" class="form-label">Pharmacie</label>
                                <input class="form-control" type="text" name="nom_phar" id="html5-text-input" value="{{ $permanance->nom_phar }}"/>
                                @error('nom_phar')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="html5-text-input" class="form-label">Contact</label>
                                <input class="form-control" type="text" id="formFile" name="contact_phar" value="{{ $permanance->contact_phar }}"/>
                                @error('contact_phar')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Adresse</label>
                                <input class="form-control" type="text" id="formFile" name="adresse_phar" value="{{ $permanance->adresse_phar }}"/>
                                @error('adresse_phar')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex p-2 mt-4 justify-content-center">
                                <div class="col-sm-3 m-2">
                                    <input class="btn rounded-pill btn-primary w-100" type="submit" value="Ajouter"/>
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