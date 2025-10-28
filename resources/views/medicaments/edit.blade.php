@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Modifier un médicament</h2>

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif 

        <form action="{{ route('medicament.update', $medicament->code_barre) }}" method="post"enctype="multipart/form-data">   
            @csrf
            @method('put') 
            <div class="row d-flex justify-content-center">
                <div class="col-xl-8">
                <!-- HTML5 Inputs -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="html5-text-input" class="form-label">Code barre</label>
                                <div class="input-group">
                                    @isset($decodeResult)        
                                    <input class="form-control" type="text" name="code_barre" value="{{ $decodeResult }}" id="html5-text-input" />
                                    @else
                                    <input class="form-control" type="text" name="code_barre" value="{{ $medicament->code_barre }}" id="html5-text-input" />
                                    @endisset
                                    <button
                                        type="button"
                                        class="btn btn-outline-primary"
                                        data-bs-target="#modalToggle2"
                                        data-bs-toggle="modal"
                                        data-bs-dismiss="modal"
                                    >
                                        Scanner
                                    </button> 
                                </div>
                                @error('code_barre')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror    
                            </div>
                            <div class="mb-3">
                                <label for="html5-text-input" class="form-label">nom</label>
                                <input class="form-control" type="text" name="nom_med" id="html5-text-input" value="{{ $medicament->nom_med }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Catégorie</label>
                                <input class="form-control" type="text" name="categorie_med" id="html5-text-input" value="{{ $medicament->categorie }}"/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Marque</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="marque_med">
                                    <option hidden selected>Selectionnez une marque</option>
                                    @foreach ($marques as $mrq) 
                                        @if( $mrq->id_marque == $medicament->id_marque)
                                            <option value="{{ $mrq->id_marque }}" selected>{{ $mrq->nom_marque }}</option>
                                        @else
                                            <option value="{{ $mrq->id_marque }}">{{ $mrq->nom_marque }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">déscription</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="desc_med">{{ $medicament->description_med }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="html5-text-input" class="form-label">prix unitaire</label>
                                <input class="form-control" type="text" name="prix_unit" id="html5-text-input" value="{{ $medicament->prix_unit }}"/>
                            </div>
                            <div class="mb-3">
                                <label for="html5-number-input" class="form-label">quantité</label>
                                <input class="form-control" type="number" min="0" name="quantite_med" id="html5-number-input"  value="{{ $medicament->quantite }}"/>
                                @error('quantite_med')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">promotion</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="promo_med">
                                    <option hidden selected>Selectionnez une promotion</option>
                                    @foreach ($promotion as $promo) 
                                        @if( $promo->id_promo == $medicament->promo)
                                            <option value="{{ $promo->id_promo }}" selected>{{ $promo->libelle ." (".$promo->pourcentage ."%)" }}</option>
                                        @else
                                            <option value="{{ $promo->id_promo }}">{{ $promo->libelle ." (".$promo->pourcentage ."%)" }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" type="file" id="formFile" name="photo_med"/>
                                @error('photo_med')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex p-2 mt-4 justify-content-center">
                                <div class="col-sm-3 m-2">
                                    <input class="btn rounded-pill btn-primary w-100" type="submit" value="Modifier"/>
                                </div >
                                <div class="col-sm-3 m-2">
                                    <input class="btn rounded-pill btn-secondary w-100" type="reset" value="Supprimer"/>
                                </div>
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