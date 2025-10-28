@extends('../templates/app')

@section('page-content')
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bolder py-3 mb-4 ">{{-- <span class="text-muted fw-light">Tables /</span> --}} Détails </h2>

        <div class="demo-inline-spacing mb-4">
            <a
            
                class="btn btn-lg btn-primary"
                href="{{ route('publication.info') }}"
            >
                <span class="tf-icons bx bx-back"></span>&nbsp;Retour
            </a>
        </div>
    

        <!-- Striped Rows -->



            <div class="card my-5 mb-4">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                    @isset($publication)
                    <tbody class="table-border-bottom-0">
                        
                        <tr>
                            <td colspan="2" style="text-align : center;"><img src="{{Storage::url($publication->photo_pub) }} " class="w-25" 
                                 style="border-radius: 10px;
                                        border : 1px solid black;
                                        align-self: center;
                                        margin : 3em;
                                 ">
                            </td>
                        <tr>
                            <td class="fw-bolder">Titre :</td>   
                            <td>{{ $publication->titre_pub }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Déscription :</td>   
                            <td>{{ $publication->description_pub }}</td>
                        </tr>             
                    </tbody>
                    @endisset
                    </table>
                </div>
            </div>
    </div>            

    <hr class="my-5" />


@endsection