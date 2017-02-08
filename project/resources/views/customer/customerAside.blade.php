<aside class="dashboard-menu">
      <ul>
        <li class="{{ ((strpos($_SERVER['REQUEST_URI'],'customer/dashboard') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/all-projects') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/view-order') != false))?'active':'' }}">
          <a href="{{ url('customer/all-projects') }}" title="Projects"><i class="fa fa-book" aria-hidden="true"></i> Projects</a>
        </li>
        <li class="has-child {{ ((strpos($_SERVER['REQUEST_URI'],'customer/assets/glossaries') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/assets/styles') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/assets/briefs') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/single-asset') != false))?'active':'' }}">
          <a href="javascript::void(0)" title="Translation Assets"><i class="fa fa-files-o" aria-hidden="true"></i> Translation Assets</a>
          <ul class="sub-child">
            <li class="{{ ((strpos($_SERVER['REQUEST_URI'],'customer/assets/glossaries') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/single-asset/gloosaries') != false))?'active':'' }}"><a href="{{ url('customer/assets/glossaries') }}" title="Glossaries">Glossaries</a></li>
            <li class="{{ ((strpos($_SERVER['REQUEST_URI'],'customer/assets/styles') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/single-asset/styles') != false))?'active':'' }}"><a href="{{ url('customer/assets/styles') }}" title="Style Guides">Style Guides</a></li>
            <li class="{{ ((strpos($_SERVER['REQUEST_URI'],'customer/assets/briefs') != false) || (strpos($_SERVER['REQUEST_URI'],'customer/single-asset/briefs') != false))?'active':'' }}"><a href="{{ url('customer/assets/briefs') }}" title="Other">Other</a></li>
          </ul>
        </li>
        <li>
          <a href="#" title="Translators"><i class="fa fa-refresh" aria-hidden="true"></i> Translators</a>
        </li>
      </ul>
    </aside>