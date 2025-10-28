@extends('../templates/app')

@section('page-content')
    
<div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Permanances</h2>

    <div class="demo-inline-spacing mb-4">
        <button
        type="button"
        class="btn btn-lg btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalToggle"
      >
         <span class="tf-icons bx bx-plus"></span>&nbsp;Nouveau permanance
      </button>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif 

    <form action="{{route('permanance.search')}}" method="GET">
      <div class="input-group mb-3">
          <input type="date" class="form-control" name="query">
          <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
      </div>
  </form>

    <!-- Striped Rows -->
    <div class="card my-5">
      <h5 class="card-header">Liste des permanances</h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>listes</th>
              <th>date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @forelse ($permanance as $per)
              <tr>
                <td class="w-25"><i class="fab fa-angular fa-lg text-danger me-3"></i> <a href="{{ route('permanance.details', $per->id_list) }}"
                >
                  <strong>{{ $per->id_list }}</strong>
                </a></td> 
                <td>
                <td class="">
                    {{ $per->date_permanance }}
                </td> 
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      {{-- <a class="dropdown-item"  href="{{ route('permanance.edit', $per->id_phar) }}"
                        ><i class="bx bx-edit-alt me-1"></i> Modifier</a
                      > --}}
                      <a class="dropdown-item" href="{{ route('permanance.delete', $per->id_list) }}"
                        ><i class="bx bx-trash me-1"></i> Supprimer</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" align="center"> aucune permanance 🤷‍♂️</td> 
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Striped Rows -->

    <div class="pagination">
      <div class="handler">
        {{ $permanance->links() }}
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
                                    
                    <h2 class="fw-bolder mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Ajouter une permanance</h2>

                    @if (session()->has('error'))
                      <div class="alert alert-danger">
                          {{ session()->get('error') }}
                      </div>
                      @endif

                    <form action="{{ route('permanance.add') }}" method="post" enctype="multipart/form-data">    
                      @csrf
                      @method('post')
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">Liste de permanances</label>
                            <input class="form-control" type="file" name="list" id="formFile" />
                            @error('list')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="html5-text-input" class="form-label">Date</label>
                            <input class="form-control" type="date" id="formFile" name="date_permanance"/>
                            @error('date_permanance')
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