
    <div class="sidebar" data-color="gold" data-background-color="white">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="{{ url('/') }}" class="simple-text logo-normal">
          <img src="{{ asset('admin_theme_assets/img/logov2.png') }}" height="60px" />
        </a>
        </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item dashboard1">
            <a class="nav-link" href="{{ url('admin') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item user1">
            <a class="nav-link" href="{{ url('admin/users') }}">
              <i class="material-icons">person</i>
              @if (session('pendingusers')=='0')
                <p>Users</p>
              @else
                <p class="title-notification">Users</p><span class="notification" title="Pending Users" rel="tooltip">{{ session('pendingusers') }}</span>
              @endif
            </a>
          </li>
          <li class="nav-item catalog1">
            <a class="nav-link catalog11" data-toggle="collapse" href="#formsExamples" aria-expanded="">
              <i class="material-icons">content_paste</i>
              <p> Catalog
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse catalog-collapse" id="formsExamples" style="">
              <ul class="nav">
                <li class="nav-item category1">
                  <a class="nav-link" href="{{ url('admin/category') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">Category</span>
                  </a>
                </li>
                <li class="nav-item product1">
                  <a class="nav-link" href="{{ url('admin/product') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">Product</span>
                  </a>
                </li>
                <li class="nav-item subproduct1">
                  <a class="nav-link" href="{{ url('admin/subproduct') }}">
                    <span class="sidebar-mini"><i class="material-icons">categry</i></span>
                    <span class="sidebar-normal">Sub Product</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item product2">
            <a class="nav-link" href="{{ url('admin/admin-product') }}">
              <i class="material-icons">dock</i>
              @if (session('pendingproduct')=='0')
                <p>Products</p>
              @else
                <p class="title-notification">Products</p><span class="notification" title="Pending Product Approvals" rel="tooltip">{{ session('pendingproduct') }}</span>
              @endif
            </a>
          </li>
          <li class="nav-item offer1">
            <a class="nav-link" href="{{ url('admin/admin-offer-view') }}">
              <i class="material-icons">local_offer</i>
              <p>Offer (Sale)</p>
            </a>
          </li>
          <li class="nav-item enquiry1">
            <a class="nav-link" href="{{ url('admin/admin-enquiry-view') }}">
              <i class="material-icons">call</i>
              <p>Enquiry (Buy)</p>
            </a>
          </li>
          <!-- <li class="nav-item bid1">
            <a class="nav-link" href="{{ url('admin/admin-bidacceptance-view') }}">
              <i class="material-icons">sports_handball</i>
              <p>Bid/Acceptance</p>
            </a>
          </li> -->
          <li class="nav-item bid2">
            <a class="nav-link" href="{{ url('admin/admin-bidaccepted-view') }}">
              <i class="material-icons">sports_handball</i>
              <p>Accepted Bid</p>
            </a>
          </li>
          <li class="nav-item report-master">
            <a class="nav-link web-master-link" data-toggle="collapse" href="#reports" aria-expanded="">
              <i class="material-icons">content_paste</i>
              <p> Reports
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse report-collapse" id="reports" style="">
              <ul class="nav">
                <li class="nav-item news3">
                  <a class="nav-link" href="{{ url('admin/top-buyers') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Top Buyers</span>
                  </a>
                </li>
                <li class="nav-item event3">
                  <a class="nav-link" href="{{ url('admin/top-sellers') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Top Sellers</span>
                  </a>
                </li>
                <li class="nav-item blog3">
                  <a class="nav-link" href="{{ url('admin/daily-sales') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Daily Sales</span>
                  </a>
                </li>
                <li class="nav-item informationpage3">
                  <a class="nav-link" href="{{ url('admin/amount-wise-turnover') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Amount wise turnover</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
           <li class="nav-item web-master">
            <a class="nav-link web-master-link" data-toggle="collapse" href="#webmaster" aria-expanded="">
              <i class="material-icons">content_paste</i>
              <p> Web Master
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse web-master-collapse" id="webmaster" style="">
              <ul class="nav">
                <li class="nav-item news">
                  <a class="nav-link" href="{{ url('admin/add-news') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">News</span>
                  </a>
                </li>
                <li class="nav-item event">
                  <a class="nav-link" href="{{ url('admin/add-event') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Event</span>
                  </a>
                </li>
                <li class="nav-item blog">
                  <a class="nav-link" href="{{ url('admin/add-blog') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Blog</span>
                  </a>
                </li>
                <li class="nav-item informationpage">
                  <a class="nav-link" href="{{ url('admin/informationpage') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Information Pages</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item master">
            <a class="nav-link master-link" data-toggle="collapse" href="#master" aria-expanded="">
              <i class="material-icons">content_paste</i>
              <p> Masters
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse master-collapse" id="master" style="">
              <ul class="nav">
                <li class="nav-item currency">
                  <a class="nav-link" href="{{ url('admin/currency') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Currency</span>
                  </a>
                </li>
                <li class="nav-item country">
                  <a class="nav-link" href="{{ url('admin/country') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Country</span>
                  </a>
                </li>
                <li class="nav-item state">
                  <a class="nav-link" href="{{ url('admin/state') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">State</span>
                  </a>
                </li>
                <li class="nav-item businesstype">
                  <a class="nav-link" href="{{ url('admin/businesstype') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Business Type</span>
                  </a>
                </li>
                <li class="nav-item unit">
                  <a class="nav-link" href="{{ url('admin/unit') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Unit</span>
                  </a>
                </li>
                <li class="nav-item unit">
                  <a class="nav-link" href="{{ url('admin/taxclass') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Taxclass</span>
                  </a>
                </li>
                <li class="nav-item unit">
                  <a class="nav-link" href="{{ url('admin/role') }}">
                    <span class="sidebar-mini"><i class="material-icons">currency</i></span>
                    <span class="sidebar-normal">Role</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>