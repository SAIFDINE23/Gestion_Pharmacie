@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Détails </h2>

        <div class="demo-inline-spacing mb-4">
            <a
            
                class="btn btn-lg btn-primary"
                href="{{ route('permanance.info') }}"
            >
                <span class="tf-icons bx bx-back"></span>&nbsp;Retour
            </a>
        </div>
    

        <!-- Striped Rows -->



            <div class="card my-5 mb-4">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                    @isset($permanance)
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td class="fw-bolder">Pharmacie :</td>   
                            <td>{{ $permanance->nom_phar }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Contact :</td>   
                            <td>{{ $permanance->contact_phar }}</td>
                        </tr>             
                        <tr>
                            <td class="fw-bolder">Adresse :</td>   
                            <td>{{ $permanance->adresse_phar }}</td>
                        </tr>             
                    </tbody>
                    @endisset
                    </table>
                </div>
            </div>
    </div>            

    <hr class="my-5" />


@endsection