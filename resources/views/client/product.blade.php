@extends('clientTemplate.app')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('client.home') }}">Home</a> <span class="mx-2 mb-0">/</span>
                <a href="{{ route('client.products') }}">Store</a> <span class="mx-2 mb-0">/</span> <strong
                    class="text-black">{{ $medicament ? $medicament->nom_med : 'Unknown Medication' }}</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            @if($medicament)
            <div class="col-md-5 mr-auto">
                <div class="border text-center">
                    <img src="{{Storage::url($medicament->photo_med) }}" alt="Image" class="img-fluid p-5">
                    <!-- Assurez-vous que le chemin de l'image est correct -->
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-black">{{ $medicament->nom_med }}</h2>
                <p>{{ $medicament->description_med }}</p>

                <div class="mt-5">
                    <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">informations de médicament</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Spécifications</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-desc-tab" data-toggle="pill" href="#pills-desc"
                              role="tab" aria-controls="pills-desc" aria-selected="false">Description</a>
                      </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <table class="table custom-table">
                                <thead>
                                    <th>Code Barre</th>
                                    <th>Catégorie</th>
                                    <th>Quantité</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $medicament->code_barre }}</th>
                                        <td>{{ $medicament->categorie }}</td>
                                        <td>{{ $medicament->quantite }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">

                            <table class="table custom-table">

                                <tbody>
                                    <tr>
                                        <td>Prix unitaire</td>
                                        <td class="bg-light">{{ $medicament->prix_unit*(1-$medicament->pourcentage/100) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Promotion</td>
                                        <td class="bg-light">{{ $medicament->pourcentage }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Marque</td>
                                        {{-- <td class="bg-light">{{ $medicament->marque ? $medicament->marque->nom_marque : 'Unknown' }}</td> --}}
                                        <td class="bg-light">{{ $marque->nom_marque }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        
                        <div class="tab-pane fade" id="pills-desc" role="tabpanel"
                        aria-labelledby="pills-desc-tab">
                           <p>{{ $medicament->description_med }}</p>
                        

                        </div>


                        
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p>Le médicament demandé n'a pas été trouvé.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
