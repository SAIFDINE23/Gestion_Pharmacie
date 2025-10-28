@extends('clientTemplate.app')

@section('content')

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a style="text-decoration: none;color:#3fbbc0" href="{{route('client.home')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Store</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center"> <!-- Utiliser justify-content-center pour aligner au centre -->
            <form class="form-inline" action="{{route('client.products')}}">
                <div class="form-group mr-3">
                    <label for="min_price" class="text-muted">Prix minimum : </label>
                    <input type="number" class="form-control" name="min_price" id="min_price" value="{{ request()->get('min_price') }}" placeholder="Min">
                </div>
                <div class="form-group mr-3">
                    <label for="max_price" class="text-muted">Prix maximum : </label>
                    <input type="number" class="form-control" name="max_price" id="max_price" value="{{ request()->get('max_price') }}" placeholder="Max">
                </div>
                <div class="form-group mr-3">
                    <label for="brand" class="text-muted">Marque : </label>
                    <select class="custom-select" name="brand" id="brand">
                        <option value="" selected>Toutes les marques</option>
                        @foreach($marques as $marque)
                           <option value="{{ $marque->id_marque }}" >{{ $marque->nom_marque }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" style="color: white;background-color:#3fbbc0;border:none" class="btn btn-primary">rechercher</button> <!-- Renommer le bouton -->
            </form>
        </div>

        <div class="row mt-5">
            @forelse ($medicaments as $med)
                <div class="col-sm-6 col-lg-4 text-center item mb-4">
                    @if ($med->quantite > 0)
                        <span class="tag bg-green" style="background-color: rgb(77, 218, 77)">En stock</span>
                    @else
                        <span class="tag bg-red" style="background-color:red">Hors stock</span>
                    @endif
                    <a href="{{ route('client.product', $med->code_barre) }}"> <img src="{{Storage::url($med->photo_med) }}" width="70%" alt="Image"></a>
                    <h3 class="text-dark"><a href="{{ route('client.product', $med->code_barre) }}">{{ $med->nom_med }}</a></h3>
                    <p class="price"><del>{{ $med->prix_unit }} DH</del> &mdash; {{ $med->prix_unit*(1-$med->pourcentage/100) }} DH</p>
                </div>
            @empty
                <div class="col-sm-6 col-lg-4 text-center item mb-4">
                    <h2 colspan="3" align="center"> aucun médicament 🤷‍♂️</h2>
                </div>
            @endforelse
        </div>
        {{ $medicaments->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
