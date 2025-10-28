@extends('clientTemplate.app')


@section('content')


  <section id="permanance" class="permanance section-bg">
    <div class="container">
      <div class="section-title">
        <h2>Consultez les permanances disponibles</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <form action="{{route('client.getPermanance')}}"  method="POST">
            @csrf
            <div class="form-group">
              <label for="query">Sélectionnez une date:</label>
              <input type="date" id="query" name="query" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #3fbbc0;border:none">Rechercher les permanances</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Afficher les permanances disponibles ici -->
  @isset($permanance)
  
  @if($permanance->count()>0)
  <section id="available-permanances" class="section-bg">
    <div class="container">
      <div class="section-title">
        <h2>Permanances disponibles</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <ul class="list-group">
            @foreach($permanance as $permanance)
            <li class="list-group-item"><embed src="{{ asset('storage/' . $permanance->list) }}" type="application/pdf" width="100%" height="600px" /></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>
  @else
  <section id="available-permanances" class="section-bg">
    <div class="container">
        <div class="section-title">
        <h1>No permanances dans cette date</h1>
    </div>
    </div>
</section>
  @endif
  @endisset  
@endsection




