@extends('../templates/app')

@section('page-content')
    
<div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Ordonnances</h2>

    <div class="demo-inline-spacing mb-4">
        <button
        type="button"
        class="btn btn-lg btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalToggle"
      >
         <span class="tf-icons bx bx-plus"></span>&nbsp;Nouveau ordonnance
      </button>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif 


    <!-- Striped Rows -->
    <div class="card my-5">
      <h5 class="card-header">Liste des ordonnances</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Patient</th>
              <th>Date de l'ordonnance</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($ordonnance as $ord)
              <tr>
                <td class="w-75"><i class="fab fa-angular fa-lg text-danger me-3"></i> <a href="{{ route('ordonnance.details', $ord->id_ord) }}"
                >
                  <strong>{{ $ord->nom_patient }}</strong>
                </a></td> 

                <td>{{ $ord->date_ord }}</td>

                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item"  href="{{ route('ordonnance.edit', $ord->id_ord) }}"
                        ><i class="bx bx-edit-alt me-1"></i> Modifier</a
                      >
                      <a class="dropdown-item" href="{{ route('ordonnance.delete', $ord->id_ord) }}"
                        ><i class="bx bx-trash me-1"></i> Supprimer</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" align="center"> aucune ordonnance 🤷‍♂️</td> 
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Striped Rows -->

    <div class="pagination">
      <div class="handler">
        {{ $ordonnance->links() }}
      </div>
    </div>

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
                                    
                    <h2 class="fw-bolder mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Ajouter une ordonnance</h2>

                    <form action="{{ route('ordonnance.add') }}" method="post">    
                      @csrf
                      @method('post')
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">Nom de patient</label>
                            <input class="form-control" type="text" name="nom_patient" id="html5-text-input" />
                            @error('nom_patient')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">Médecin</label>
                            <input class="form-control" type="text" id="formFile" name="medecin"/>
                            @error('medecin')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlSelect1" class="form-label">Médicaments</label>
                          <select class="form-select js-example-basic-single" id="exampleFormControlSelect1" aria-label="Default select example" name="medicaments[]" multiple>
                            @foreach($medicament as $med)                
                                <option value="{{ $med->code_barre }}" data-quantite="{{ $med->quantite }}">{{ $med->nom_med }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('medicaments')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                        @enderror
                        <div class="mb-3">
                          <div id="quantiteFields">
                            
                            <!-- Les champs de saisie de quantité seront ajoutés ici dynamiquement -->
                          </div>
                        </div>
                        @error('quantite')
                            <div class="text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Date de l'ordonnance</label>
                            <input class="form-control" type="date" id="formFile" name="date_ord"/>
                            @error('date_ord')
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
    </div>
  </div>
  
  

@endsection