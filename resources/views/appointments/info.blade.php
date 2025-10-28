@extends('../templates/app')

@section('page-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="fw-bolder py-3 mb-4">Liste des rendez-vous</h2>


    @if (session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
      @endif

      
    <div class="card my-5">
        <h5 class="card-header">Rendez-vous</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        {{-- <th>Message</th> --}}
                        <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($appointments as $appointment)
                    <tr>
                        <td><a href="{{ route('appointment.details', $appointment->id) }}">
                            <strong>{{ $appointment->name }}</strong>
                            </a>  
                        </td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->subject }}</td>
                        {{-- <td>{{ $appointment->message }}</td> --}}
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                   
                                    <a class="dropdown-item" href="{{ route('appointment.delete', $appointment->id) }}">
                                        <i class="bx bx-trash me-1"></i> Supprimer
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" align="center">Aucun rendez-vous</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination">
        <div class="handler">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
