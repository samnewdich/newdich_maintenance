<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="/admin">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Admin Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/dashboard">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">User Dashboard</span>
              </a>
            </li>
            <li class="nav-item nav-category">Services</li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-phone-in-talk"></i>
                <span class="menu-title">Airtime</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-airtime-plans">Airtime Plans</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="menu-icon mdi mdi-web"></i>
                <span class="menu-title">Data</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="/admin-data-types">Data Types</a></li>
                  <li class="nav-item"><a class="nav-link" href="/admin-data-plans">Data Plans</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="menu-icon mdi mdi-television-classic"></i>
                <span class="menu-title">Cable/TV</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/charts/chartjs.html">Cable/TV Types</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/charts/chartjs.html">Cable/TV Plans</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="menu-icon mdi mdi-lightbulb-on"></i>
                <span class="menu-title">Electricity</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/tables/basic-table.html">Electricity Plans</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="menu-icon mdi mdi-layers-outline"></i>
                <span class="menu-title">Results</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/icons/font-awesome.html">Result Plans</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-message-text-outline"></i>
                <span class="menu-title">SMS</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/samples/blank-page.html"> SMS Plans</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#authusers" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="authusers">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-all-users"> All Users</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#authwallet" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-wallet"></i>
                <span class="menu-title">Wallet</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="authwallet">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-manual-payment">Manual Payments</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-pending-payment">Pending Manual Payments</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-wallet-balance">Wallet Balance</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-credit-debit-user">Credit/Debit User</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#authgateway" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-credit-card"></i>
                <span class="menu-title">Gateways</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="authgateway">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-gateways"> All Gateways</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#authprovider" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-database"></i>
                <span class="menu-title">API Providers</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="authprovider">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-api-providers"> All API Providers</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#authhistory" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-history"></i>
                <span class="menu-title">History</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="authhistory">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="/admin-history-all"> All</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-airtime"> Airtime</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-data">Data</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-cable">Cable/TV</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-electricity">Electricity</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-result">Result</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-sms">SMS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-deposit">Deposit</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-credit">Credit</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-debit">Debit</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-history-payment">Payments</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#authsettings" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-settings-box"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="authsettings">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/samples/blank-page.html"> App Settings</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/ui-features/dropdowns.html">Notification</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/ui-features/typography.html">Mailing</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#authadmin" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-key"></i>
                <span class="menu-title">Admin</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="authadmin">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/samples/blank-page.html"> Manage Admin</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/ui-features/dropdowns.html">Add New Admin</a></li>
                  <li class="nav-item"> <a class="nav-link" href="/admin-gui/ui/pages/ui-features/typography.html">Set Roles</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->