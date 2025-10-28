<!-- EXAMPLE OF CSS STYLE -->
<style>

    .second {
      border-collapse: collapse;
      width: 80%;
      font-size: 8px;
      margin: auto;
    }
    
    .second th, .second td {
      border: 1px solid #000;
    }
    
    .second th {
      font-weight: bold;
      text-align: left;
    }
    
    .second td {
      text-align: left;
    }
    
    .second tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    
    .second tr:hover {
      background-color: #ddd;
    }
    div{
      text-align: center;
    }
    
    p{
      font-size: 9px;
      font-family: 
    }
    p span{
      font-weight: bold;
    }


</style>
<u><h3 align="center" style="margin:50px">Reçu de l'ordonnance</h3></u>
<table style="width: 40%;">
  <tr>
    {{-- {{ dd($ord) }} --}}
    <td><p><span>N° d'ordonnance:</span></p></td>
    <td><p>{{ $ord[0]->id_ord }}</p></td>
  </tr>
  <tr>
    <td><p><span>Nom de patient:</span></p></td>
    <td><p>{{ $ord[0]->nom_patient }}</p></td>
  </tr>
  <tr>
    <td><p><span>Date :</span></p></td>
    <td><p>{{ $ord[0]->date_ord }}</p></td>
  </tr>
  {{-- <tr>
    <td><p><span>Date de fin:</span></p></td>
    <td><p>'. $date_f.'</p></td>
  </tr>   --}}
</table>

<p><span>Liste des médicaments achetés:</span></p>
  
<div>
  <table cellpadding="3" class="second">
    <tr>
      <th>Médicament</th>
      <th>Quantité</th>
      <th>Prix unitaire</th>
      <th>Promotion</th>
    </tr>
    {{-- {{ dd($nom_med) }} --}}
    @foreach ($ord as $o)
    <tr>
      <td>{{ $o->nom_med }}</td>
      <td>{{ $o->quantite }}</td>
      <td>{{ $o->prix_unit }}</td>
      <td>{{ $o->pourcentage }} %</td>
    </tr>
    @endforeach
  </table>
    <p><span>Prix total :</span> {{ $prix_total[0]->prix_total }} DH</p>
    <div class="container">
        <p><span><b>PharmaManage</b> vous souhaite un bon rétablissement </span></p>
    </div>

</div>
