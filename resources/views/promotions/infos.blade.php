@extends('../templates/app')

@section('page-content')
    
<div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Promotions</h2>

    <div class="demo-inline-spacing mb-4">
        <button
        type="button"
        class="btn btn-lg btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalToggle"
      >
         <span class="tf-icons bx bx-plus"></span>&nbsp;Nouvelle promotion
      </button>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif 
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif 


    <!-- Striped Rows -->
    <div class="card my-5">
      <h5 class="card-header">Liste des promotions</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>libelle</th>
              <th>pourcentage</th>
              <th>Date de début</th>
              <th>Date de fin</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($promotion as $promo)
              <tr>
                <td class=""><strong>{{ $promo->libelle }}</strong></td> 

                <td>{{ $promo->pourcentage }} %</td>
                <td>{{ $promo->debut_promo }}</td>
                <td>{{ $promo->fin_promo }}</td>

                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item"  href="{{ route('promotion.edit', $promo->id_promo) }}"
                        ><i class="bx bx-edit-alt me-1"></i> Modifier</a
                      >
                      <a class="dropdown-item" href="{{ route('promotion.delete', $promo->id_promo) }}"
                        ><i class="bx bx-trash me-1"></i> Supprimer</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" align="center"> aucune promotion 🤷‍♂️</td> 
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Striped Rows -->

    <div class="pagination">
      <div class="handler">
        {{ $promotion->links() }}
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
                                    
                    <h2 class="fw-bolder mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Ajouter une promotion</h2>

                    <form action="{{ route('promotion.add') }}" method="post">    
                      @csrf
                      @method('post')
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">Libelle</label>
                            <input class="form-control" type="text" name="libelle" id="html5-text-input" />
                            @error('libelle')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">pourcentage</label>
                            <input class="form-control" type="number" min="0" max="100" id="formFile" name="pourcentage"/>
                            @error('pourcentage')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Date de début</label>
                            <input class="form-control" type="date" id="formFile" name="debut_promo"/>
                            @error('debut_promo')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Date de fin</label>
                            <input class="form-control" type="date" id="formFile" name="fin_promo"/>
                            @error('fin_promo')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if (session()->has('date_error'))
                            <div class="text text-danger">
                                {{ session()->get('date_error') }}
                            </div>
                            @endif 
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