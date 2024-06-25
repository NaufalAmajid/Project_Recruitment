<div class="card-header">
    <div class="d-flex align-items-center">
        <div>
            <h6 class="mb-0">Daftar User <?= strtoupper($_GET['menu']) ?></h6>
        </div>
        <div class="dropdown ms-auto">
            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table id="table-list-admin" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>