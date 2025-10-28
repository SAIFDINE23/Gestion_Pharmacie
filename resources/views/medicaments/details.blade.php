@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Détails </h2>

        <div class="demo-inline-spacing mb-4">
            <a
            
                class="btn btn-lg btn-primary"
                href="{{ route('medicament.info') }}"
            >
                <span class="tf-icons bx bx-back"></span>&nbsp;Retour
            </a>
        </div>
    

        <!-- Striped Rows -->



            <div class="card my-5 mb-4">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                    @isset($medicament)
                    <tbody class="table-border-bottom-0">
                        
                        <tr>
                        <td colspan="2" style="text-align : center;"><img src="{{Storage::url($medicament->photo_med) }}" width="300px" 
                             style="border-radius: 10px;
                                    border : 1px solid black;
                                    align-self: center;
                                    margin : 3em;
                             ">
                        </td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Code Barre :</td>   
                            <td>{{ $medicament->code_barre }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Nom de médicament :</td>   
                            <td>{{ $medicament->nom_med }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Marque :</td>   
                            <td>{{ $marque->nom_marque }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Catégorie :</td>   
                            <td>{{ $medicament->categorie }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Description :</td>   
                            <td>{{ $medicament->description_med }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Prix unitaire :</td>   
                            <td>{{ $medicament->prix_unit }}</td>
                        </tr> 
                        <tr>
                            <td class="fw-bolder">Quantité :</td>   
                            <td>{{ $medicament->quantite }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Promotion :</td> 
                            @if($promotion)  
                                <td>{{ $promotion->libelle ." (". $promotion->pourcentage ."%)" }}</td>
                            @else
                                <td>None</td>
                            @endif
                        </tr>
                    </tbody>
                    @endisset
                    </table>
                </div>
            </div>
    </div>            

    <hr class="my-5" />


@endsection