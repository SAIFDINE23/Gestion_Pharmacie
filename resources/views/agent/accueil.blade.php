@extends('../templates/app')

@section('page-content')
              <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
    
                <div class="container-xxl flex-grow-1 container-p-y">
                  <div class="row">

                        <div class="col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img
                                    src="../assets/img/icons/unicons/chart-success.png"
                                    alt="chart success"
                                    class="rounded"
                                  />
                                </div>
                                <div class="dropdown">
                                  <button
                                    class="btn p-0"
                                    type="button"
                                    id="cardOpt3"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                  >
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('medicament.info') }}">Voir plus</a>
                                  </div>
                                </div>
                              </div>
                              <span class="fw-semibold d-block mb-1">Médicaments</span>
                              <h3 class="card-title mb-2">{{ $total_med }}</h3>
                            </div>
                          </div>
                        </div>
                        <div class="col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img
                                    src="../assets/img/icons/unicons/wallet-info.png"
                                    alt="Credit Card"
                                    class="rounded"
                                  />
                                </div>
                              </div>
                              <span>Ordonnances</span>
                              <h3 class="card-title text-nowrap mb-1">{{ $total_ord }}</h3>
                            </div>
                          </div>
                        </div>
                     
                    
                        <div class="col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                                </div>
                                <div class="dropdown">
                                  <button
                                    class="btn p-0"
                                    type="button"
                                    id="cardOpt4"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                  >
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a class="dropdown-item" href="{{ route('marque.info') }}">Voir plus</a>
                                  </div>
                                </div>
                              </div>
                              <span class="d-block mb-1">Marques</span>
                              <h3 class="card-title text-nowrap mb-2">{{ $total_marque }}</h3>
                              {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                            </div>
                          </div>
                        </div>
                        <div class="col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                </div>
                                <div class="dropdown">
                                  <button
                                    class="btn p-0"
                                    type="button"
                                    id="cardOpt1"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                  >
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="{{ route('publication.info') }}">Voir plus</a>
                                  </div>
                                </div>
                              </div>
                              <span class="fw-semibold d-block mb-1">Publications</span>
                              <h3 class="card-title mb-2">{{ $total_pub }}</h3>
                              {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                            </div>
                          </div>
                        </div>       
                 </div>
                  <div class="row">
                    <!-- Order Statistics -->
                    <div class="  order-0 mb-4">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                          <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Statistiques des catégories</h5>
                            {{-- <small class="text-muted">42.82k Total Sales</small> --}}
                          </div>
                          <div class="dropdown">
                            <button
                              class="btn p-0"
                              type="button"
                              id="orederStatistics"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                            >
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                              <a class="dropdown-item" href="{{ route('accueil') }}">Refresh</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                              <h2 class="mb-2">{{ $total_cat }}</h2>
                              <span>Total des catégories</span>
                            </div>
                            <div id="orderStatisticsChart" data-orders="{{ json_encode($cat_val) }}"></div>
                          </div><br><br>
                          <ul class="p-0 m-0" type="disk">
                            @foreach ($cat_val as $val)
                              <li class="d-flex justify-content-center mb-4 pb-1">
                                <div class="d-flex w-75 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">{{ "+ " . $val->categorie }}</h6>
                                    {{-- <small class="text-muted">Mobile, Earbuds, TV</small> --}}
                                  </div>
                                  <div class="user-progress">
                                    <small class="fw-semibold">{{ $val->quantite }}</small>
                                  </div>
                                </div>
                              </li> 
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                    <!--/ Order Statistics -->
    
                    <!-- Expense Overview -->
                    {{-- <div class="col-md-6 col-lg-4 order-1 mb-4">
                      <div class="card h-100">
                        <div class="card-header">
                          <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                              <button
                                type="button"
                                class="nav-link active"
                                role="tab"
                                data-bs-toggle="tab"
                                data-bs-target="#navs-tabs-line-card-income"
                                aria-controls="navs-tabs-line-card-income"
                                aria-selected="true"
                              >
                                Income
                              </button>
                            </li>
                            <li class="nav-item">
                              <button type="button" class="nav-link" role="tab">Expenses</button>
                            </li>
                            <li class="nav-item">
                              <button type="button" class="nav-link" role="tab">Profit</button>
                            </li>
                          </ul>
                        </div>
                        <div class="card-body px-0">
                          <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                              <div class="d-flex p-4 pt-3">
                                <div class="avatar flex-shrink-0 me-3">
                                  <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                                </div>
                                <div>
                                  <small class="text-muted d-block">Total Balance</small>
                                  <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">$459.10</h6>
                                    <small class="text-success fw-semibold">
                                      <i class="bx bx-chevron-up"></i>
                                      42.9%
                                    </small>
                                  </div>
                                </div>
                              </div>
                              <div id="incomeChart"></div>
                              <div class="d-flex justify-content-center pt-4 gap-2">
                                <div class="flex-shrink-0">
                                  <div id="expensesOfWeek"></div>
                                </div>
                                <div>
                                  <p class="mb-n1 mt-1">Expenses This Week</p>
                                  <small class="text-muted">$39 less than last week</small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    <!--/ Expense Overview -->
    

                  </div>
                </div>
                <!-- / Content -->
    
    
@endsection