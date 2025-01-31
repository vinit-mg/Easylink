<x-admin.layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <section class="section dashboard">
        <div class="row">
  
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
  
              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                   <div class="align-items-center d-flex mt-3 pb-2">    
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-building"></i>
                      </div>
                      <h5 class="card-title ps-3">Customer</h5>
                    </div>
                    <div class="align-items-center">
                      <div class="">
                        <select class="form-select" aria-label="Default select example">
                          <option selected="">Select Customer</option>
                          <option value="1">Karmameju</option>
                          <option value="1">karmameju-skincare</option>
                        </select>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div><!-- End Sales Card -->
  
              <!-- Webshop Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                   <div class="align-items-center d-flex mt-3 pb-2">    
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-shop"></i>
                      </div>
                      <h5 class="card-title ps-3">Webshop</h5>
                    </div>
                    <div class="align-items-center">
                      <div class="">
                        <select class="form-select" aria-label="Default select example">
                          <option selected="">Select Webshop</option>
                          <option value="1">Karmameju</option>
                          <option value="1">karmameju-skincare</option>
                        </select>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div>
              <!-- End Webshop Card -->
  
              <!-- periods Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                  <div class="card-body">
                   <div class="align-items-center d-flex mt-3 pb-2">    
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-clock"></i>
                      </div>
                      <h5 class="card-title ps-3">Period</h5>
                    </div>
                    <div class="align-items-center">
                      <div class="">
                        <select class="form-select" aria-label="Default select example">
                          <option selected="">Select Period</option>
                          <option value="1">Karmameju</option>
                          <option value="1">karmameju-skincare</option>
                        </select>
  
                      </div>
                    </div>
                  </div>
  
                </div>
              </div>
              <!-- End periods Card -->
  
              <!-- Reports -->
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="chart-overview info-card d-md-flex m-0">
                      <h5 class="card-title p-0 m-0">Orders :</h5>  
                      <div class="ps-3 text-center border-left-2 pt-0">
                        <h5 class="fw-semibold">150</h5>
                         <span class="text-muted small pt-2 ps-1">Quantity</span>
                      </div>
                      <div class="ps-3 text-center border-left-2 pt-0">
                        <h5 class="fw-semibold">15.845</h5>
                         <span class="text-muted small pt-2 ps-1">Total revenue</span>
                      </div>
                      <div class="ps-3 text-center border-left-2 pt-0">
                        <h5 class="fw-semibold">415</h5>
                         <span class="text-muted small pt-2 ps-1">Average value</span>
                      </div>
                    </div>
  
  
                    <!-- Line Chart -->
                    <div id="reportsChart"></div>
  
                     <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#reportsChart"), {
                          series: [{
                            name: 'Orders',
                            data: [50, 65, 48, 71, 62, 82, 90],
                          }, {
                            name: 'Completed',
                            data: [21, 32, 25, 45, 36, 70, 45]
                          },{
                            name: 'Pending',
                            data: [11, 25, 15, 32, 30, 52, 41]
                          },{
                            name: 'Failed',
                            data: [2, 11, 12, 18, 9, 15,20]
                          }],
                          chart: {
                            height: 507,
                            type: 'area',
                            toolbar: {
                              show: false
                            },
                          },
                          markers: {
                            size: 4
                          },
                          colors: ['#4154f1', '#3eb453', '#ffcb62', '#f44336'],
                          fill: {
                            type: "gradient",
                            gradient: {
                              shadeIntensity: 1,
                              opacityFrom: 0.3,
                              opacityTo: 0.4,
                              stops: [0, 90, 100]
                            }
                          },
                          dataLabels: {
                            enabled: false
                          },
                          stroke: {
                            curve: 'smooth',
                            width: 2
                          },
                          xaxis: {
                            type: 'datetime',
                            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                          },
                          tooltip: {
                            x: {
                              format: 'dd/MM/yy HH:mm'
                            },
                          }
                        }).render();
                      });
                    </script>
                    <!-- End Line Chart -->
  
                  </div>
  
                </div>
              </div><!-- End Reports -->
  
            </div>
          </div><!-- End Left side columns -->
  
          <!-- Right side columns -->
          <div class="col-lg-4">
  
            <!-- Latest Sync -->
            <div class="card">
              <div class="card-body  pb-0">
                <h5 class="card-title pb-0 Latest-box">Latest Sync:</h5>
                 <!-- Small tables -->
                <table class="table table-sm table-borderless latest-table">
                  <tbody>
                    <tr>
                      <th scope="row">Orders</th>
                      <td>Nov. 23-2024</td>
                    </tr>
                    <tr>
                      <th scope="row">Customers</th>
                      <td>Nov. 21-2024</td>
                    </tr>
                    <tr>
                      <th scope="row">Products</th>
                      <td>Nov. 20-2024</td>
                    </tr>
  
                  </tbody>
                </table>
                <!-- End small tables -->
  
              </div>
            </div>
            <!-- End Latest Sync -->
              
            <!-- Recent Activity -->
            <div class="card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
  
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
  
              <div class="card-body">
                <h5 class="card-title">Recent Activity <span>| Today</span></h5>
  
                <div class="activity">
  
                  <div class="activity-item d-flex">
                    <div class="activite-label">32 min</div>
                    <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                    <div class="activity-content">
                      Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                    </div>
                  </div><!-- End activity item-->
  
                  <div class="activity-item d-flex">
                    <div class="activite-label">2 days</div>
                    <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                    <div class="activity-content">
                      Est sit eum reiciendis exercitationem
                    </div>
                  </div><!-- End activity item-->
  
                  <div class="activity-item d-flex">
                    <div class="activite-label">4 weeks</div>
                    <i class="bi bi-circle-fill activity-badge text-muted align-self-start"></i>
                    <div class="activity-content">
                      Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                    </div>
                  </div><!-- End activity item-->
  
                </div>
  
              </div>
            </div><!-- End Recent Activity -->  
              
            <!-- Website Traffic -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Fulfillment</h5>
                <!-- Doughnut Chart -->
                <canvas id="doughnutChart" style="max-height: 260px;"></canvas>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#doughnutChart'), {
                      type: 'doughnut',
                      data: {
                        labels: [
                          'Completed',
                          'Pending',
                          'Failed'
                        ],
                        datasets: [{
                          data: [85, 13, 2],
                          backgroundColor: [
                            '#3eb453',  
                            'rgb(255, 205, 86)',
                            'rgb(255, 99, 132)'
                          ],
                          hoverOffset: 4
                        }]
                      }
                    });
                  });
                </script>
                <!-- End Doughnut CHart -->
  
                <div class="d-flex justify-content-center">
                  <button type="button" class="btn update-btn btn-primary rounded-pill mt-3" fdprocessedid="tuoo0e">Refresh</button>
                </div>
  
              </div>
            </div><!-- End Website Traffic -->
  
          </div><!-- End Right side columns -->
  
        </div>
    </section>
    
</x-admin.layout>
