@extends('../templates/app')

@section('page-content')
    
<div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Médicaments</h2>

    <div class="demo-inline-spacing mb-4">
        <button
        type="button"
        class="btn btn-lg btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalToggle"
      >
         <span class="tf-icons bx bx-plus"></span>&nbsp;Nouveau médicament
      </button>
    </div>
    

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif  

    <form action="{{route('medicament.search')}}" method="GET">
      <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Rechercher un médicament" name="query">
          <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
      </div>
  </form>

    <!-- Striped Rows -->
    <div class="card my-5 mb-4">
      <h5 class="card-header">Liste des médicaments</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($medicaments as $med)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <a href="{{ route('medicament.details', $med->code_barre) }}"
                >
                  <strong>{{ $med->nom_med }}</strong>
                </a></td> 
                @if ($med->quantite == 0)  
                  <td><span class="badge bg-label-danger me-1">Hors stock</span></td>
                @else
                  <td><span class="badge bg-label-success me-1">En stock</span></td>
                @endif
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item"  href="{{ route('medicament.edit', $med->code_barre) }}"
                        ><i class="bx bx-edit-alt me-1"></i> Modifier</a
                      >
                      <a class="dropdown-item" href="{{ route('medicament.delete', $med->code_barre) }}"
                        ><i class="bx bx-trash me-1"></i> Supprimer</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" align="center"> aucun médicament 🤷‍♂️</td> 
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="pagination">
      <div class="handler">
        {{ $medicaments->links() }}
      </div>
    </div>
    <!--/ Striped Rows -->

    <hr class="my-5" />


   <!-- Toggle Between Modals -->
   <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <!-- Modal 1-->
      <div
        class="modal fade"
        id="modalToggle"
        aria-labelledby="modalToggleLabel"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
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
                    <h2 class="fw-bolder mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Ajouter un médicaments</h2>

                    <form action="{{ route('medicament.add') }}" method="post" enctype="multipart/form-data">    
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">Code barre</label> 
                            <div class="input-group">
                                @isset($decodeResult)        
                                <input class="form-control" type="text" name="code_barre" value="{{ $decodeResult }}" id="html5-text-input" />
                                @else
                                <input class="form-control" type="text" name="code_barre" value="" id="html5-text-input" />
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
                            <input class="form-control" type="text" name="nom_med" id="html5-text-input" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Catégorie</label>
                            <input class="form-control" type="text" name="categorie_med" id="html5-text-input" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Marque</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="marque_med">
                              <option selected hidden>Sélectionnez une marque</option>
                                @foreach ($marques as $mrq)  
                                  <option value="{{ $mrq->id_marque }}">{{ $mrq->nom_marque }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">déscription</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="desc_med"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">prix unitaire</label>
                            <input class="form-control" type="text" name="prix_unit" id="html5-text-input" />
                        </div>
                        <div class="mb-3">
                            <label for="html5-number-input" class="form-label">quantité</label>
                            <input class="form-control" type="number" min="0" name="quantite_med" id="html5-number-input" />
                            @error('quantite_med')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlSelect1" class="form-label">Promotion</label>
                          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="promo_med">
                            <option selected value="NULL">Sélectionnez une promotion</option>
                              @foreach ($promotions as $promo)  
                                <option value="{{ $promo->id_promo }}">{{ $promo->libelle ."  (". $promo->pourcentage ."%)" }}</option>
                              @endforeach
                          </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="html5-number-input" class="form-label">promotion</label>
                            <input class="form-control" type="number" min="0" max="100" name="promo_med" id="html5-number-input" />
                            @error('promo_med')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
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
                                <input class="btn rounded-pill btn-primary w-100" type="submit" value="Ajouter"/>
                            </div >
                            <div class="col-sm-3 m-2">
                                <input class="btn rounded-pill btn-secondary w-100" type="reset" value="Supprimer"/>
                            </div>
                        </div>

                    </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal 2-->
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
              <h5 class="modal-title" id="modalToggleLabel2">Modal 2</h5>
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
              <button
                class="btn btn-primary"
                data-bs-target="#modalToggle"
                data-bs-toggle="modal"
                data-bs-dismiss="modal"
              >
                Back to first
              </button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  

@endsection