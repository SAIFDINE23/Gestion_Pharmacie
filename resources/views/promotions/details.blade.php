@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Détails </h2>

        <div class="demo-inline-spacing mb-4">
            <a
            
                class="btn btn-lg btn-primary"
                href="{{ route('ordonnance.info') }}"
            >
                <span class="tf-icons bx bx-back"></span>&nbsp;Retour
            </a>
        </div>
    

        <!-- Striped Rows -->



            <div class="card my-5 mb-4">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                    @isset($ordonnance)
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td class="fw-bolder">Nom de patient </td>   
                                <td>{{ $ordonnance->nom_patient }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bolder"> Médecin</td>   
                                <td>{{ $ordonnance->medecin }}</td>
                            </tr>             
                            <tr>
                                <td class="fw-bolder"> Date de l'ordonnance</td>   
                                <td>{{ $ordonnance->date_ord }}</td>
                            </tr>             
                            <tr>
                                <td class="fw-bolder"> Médicaments</td>   
                                <td>
                                    @forelse($ligne_ord as $l)
                                        {{ $l->nom_med }} <br>
                                    @empty
                                    @endforelse
                                </td>
                            </tr> 
                            <tr>
                                <td class="fw-bolder"> Prix total </td>   
                                <td>{{ $prix_total[0]->prix_total }} DH</td>
                            </tr>            
                        </tbody>
                    @endisset
                    </table>
                </div>
            </div>

            <div class="title d-flex align-items-center flex-wrap">
                <a href="{{ route('generatePDF', $ordonnance->id_ord) }}" class="btn btn-lg btn-secondary">
                  <i class="lni lni-plus mr-5"></i> Imprimer le reçu </a
                >
              </div>
    </div>            

    <hr class="my-5" />


@endsection