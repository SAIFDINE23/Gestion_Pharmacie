@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Détails </h2>

        <div class="demo-inline-spacing mb-4">
            <a
            
                class="btn btn-lg btn-primary"
                href="{{ route('appointment.info') }}"
            >
                <span class="tf-icons bx bx-back"></span>&nbsp;Retour
            </a>
        </div>
    

        <!-- Striped Rows -->



            <div class="card my-5 mb-4">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                    @isset($appointment)
                    <tbody class="table-border-bottom-0">
                        
                        <tr>
                        
                        </tr>
                        <tr>
                            <td class="fw-bolder">Nom :</td>   
                            <td>{{ $appointment->name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Email :</td>   
                            <td>{{ $appointment->email }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Sujet :</td>   
                            <td>{{ $appointment->subject }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Message :</td>   
                            <td>{{ $appointment->message }}</td>
                        </tr>
                        
                    </tbody>
                    @endisset
                    </table>
                </div>
            </div>
            <a href="{{ route('appointment.delete', $appointment->id) }}" class="btn btn-lg btn-danger"> Supprimer </a>
    </div>            

    <hr class="my-5" />


@endsection