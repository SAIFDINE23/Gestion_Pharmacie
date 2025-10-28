  @extends('../templates/app')

  @section('page-content')
      
  <div class="container-xxl flex-grow-1 container-p-y">
      <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Marques</h2>

      <div class="demo-inline-spacing mb-4">
          <button
          type="button"
          class="btn btn-lg btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#modalCenter"
        >
          <span class="tf-icons bx bx-plus"></span>&nbsp;Nouveau marque
        </button>
      </div>

      @if (session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
      @endif


      <!-- Striped Rows -->
      <div class="card my-5">
        <h5 class="card-header">Liste des marques</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Propriétaire</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($marques as $mrq)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <a href="{{ route('marque.details', $mrq->id_marque) }}"
                  >
                    <strong>{{ $mrq->nom_marque }}</strong>
                  </a>
                  </td>                
                  <td>{{ $mrq->owner }}</td>
                  
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item"  href="{{ route('marque.edit', $mrq->id_marque) }}"
                          ><i class="bx bx-edit-alt me-1"></i> Modifier</a
                        >
                        <a class="dropdown-item" href="{{ route('marque.delete', $mrq->id_marque) }}"
                          ><i class="bx bx-trash me-1"></i> Supprimer</a
                        >
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" align="center"> aucune marque 🤷‍♂️</td> 
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="pagination">
        <div class="handler">
          {{ $marques->links() }}
        </div>
      </div>

      <!--/ Striped Rows -->

      <hr class="my-5" />

    
    <!-- Vertically Centered Modal -->
    <div class="col-lg-4 col-md-6">
      <div class="mt-3">
          <!-- Modal -->
          <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h2 class="fw-bolder mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Ajouter une marque</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('marque.add') }}" method="post" enctype="multipart/form-data">    
                          @csrf
                          @method('post')

                          <div class="mb-3">
                              <label for="html5-text-input" class="form-label">Nom de la marque</label>
                              <input class="form-control" type="text" name="nom_mrq" id="html5-text-input" />
                              @error('nom_mrq')
                                  <div class="text text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="html5-text-input" class="form-label">Propriétaire</label>
                              <input class="form-control" type="text" name="propr" id="html5-text-input" />
                              @error('propr')
                                  <div class="text text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="html5-text-input" class="form-label">Contact</label>
                              <input class="form-control" type="text" name="contact" id="html5-text-input" />
                              @error('contact')
                                  <div class="text text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="formFile" class="form-label">Photo</label>
                              <input class="form-control" type="file" id="formFile" name="photo_mrq"/>
                              @error('photo_mrq')
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
                      
                  </div>
              </div>
          </div>
      </div>
  </div>
    

  @endsection