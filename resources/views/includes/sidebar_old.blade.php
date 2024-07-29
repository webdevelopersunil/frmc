
@php
    $currentRoute = Route::currentRouteName();
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <ul class="nav">


    <!-- Nodal Users Sidebar Menus -->
    @if(auth()->user()->hasRole('user'))

      <li class="nav-item {{ $currentRoute == 'user.dashboard' ? 'active' : '' }}  ">
        <a class="nav-link {{ Request::routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ Request::routeIs('user.dashboard') ? 'white' : 'currentColor' }}" class="bi bi-house-fill" viewBox="0 0 16 16">
                <path d="M8.293 1.293a1 1 0 0 1 1.414 0l5 5a1 1 0 0 1 .293.707V14a1 1 0 0 1-1 1H12a1 1 0 0 1-1-1v-3H9v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7.707a1 1 0 0 1 .293-.707l5-5zM9 2.414V6a1 1 0 0 0 1 1h3.586L8 12.586 2.414 7H6a1 1 0 0 0 1-1V2.414l3-3z"/>
            </svg>
            <span class="menu-title">&nbsp User Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ $currentRoute == 'user.complaints' ? 'active' : '' }} 
        {{ $currentRoute == 'user.complaint.edit' ? 'active' : '' }}
        {{ $currentRoute == 'user.complaint.create' ? 'active' : '' }}
        {{ $currentRoute == 'user.complaint.view' ? 'active' : '' }} "
        >
        <a class="nav-link {{ Request::routeIs('user.complaints') ? 'active' : '' }}" href="{{ route('user.complaints') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ Request::routeIs('user.complaints') ? 'white' : 'currentColor' }}" class="bi bi-list" viewBox="0 0 16 16">
                <path d="M3.5 4.5A.5.5 0 0 1 4 4h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2zM4 5v1h8V5H4z"/>
                <path fill-rule="evenodd" d="M1 2.5A.5.5 0 0 1 1.5 2h13a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-11zM1.5 1A1.5 1.5 0 0 0 0 2.5v11A1.5 1.5 0 0 0 1.5 15h13a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 14.5 1h-13z"/>
            </svg>
            <span class="menu-title">&nbsp Complaints List</span>
        </a>

      </li>

    @endif

    

    <!-- Nodal Nodal Sidebar Menus -->
    @if(auth()->user()->hasRole('nodal'))

      <li class="nav-item  {{ $currentRoute == 'nodal.dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('nodal.dashboard') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ Request::routeIs('user.dashboard') ? 'white' : 'currentColor' }}" class="bi bi-house-fill" viewBox="0 0 16 16">
              <path d="M8.293 1.293a1 1 0 0 1 1.414 0l5 5a1 1 0 0 1 .293.707V14a1 1 0 0 1-1 1H12a1 1 0 0 1-1-1v-3H9v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7.707a1 1 0 0 1 .293-.707l5-5zM9 2.414V6a1 1 0 0 0 1 1h3.586L8 12.586 2.414 7H6a1 1 0 0 0 1-1V2.414l3-3z"/>
          </svg>
          <span class="menu-title">&nbsp Nodal Dashboard</span>
        </a>
      </li>

      <li class="nav-item  {{ $currentRoute == 'nodal.complaints' ? 'active' : '' }} {{ $currentRoute == 'nodal.complaint.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('nodal.complaints') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ Request::routeIs('user.complaints') ? 'white' : 'currentColor' }}" class="bi bi-list" viewBox="0 0 16 16">
                <path d="M3.5 4.5A.5.5 0 0 1 4 4h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2zM4 5v1h8V5H4z"/>
                <path fill-rule="evenodd" d="M1 2.5A.5.5 0 0 1 1.5 2h13a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-11zM1.5 1A1.5 1.5 0 0 0 0 2.5v11A1.5 1.5 0 0 0 1.5 15h13a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 14.5 1h-13z"/>
            </svg>
          <span class="menu-title">&nbsp Complaints List</span>
        </a>
      </li>

    @endif

    <!-- Nodal FCO Sidebar Menus -->
    @if(auth()->user()->hasRole('fco'))

      <li class="nav-item {{ $currentRoute == 'fco.dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('fco.dashboard') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ Request::routeIs('user.dashboard') ? 'white' : 'currentColor' }}" class="bi bi-house-fill" viewBox="0 0 16 16">
              <path d="M8.293 1.293a1 1 0 0 1 1.414 0l5 5a1 1 0 0 1 .293.707V14a1 1 0 0 1-1 1H12a1 1 0 0 1-1-1v-3H9v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7.707a1 1 0 0 1 .293-.707l5-5zM9 2.414V6a1 1 0 0 0 1 1h3.586L8 12.586 2.414 7H6a1 1 0 0 0 1-1V2.414l3-3z"/>
          </svg>
          <span class="menu-title">&nbsp FCO Dashboard</span>
        </a>
      </li>

      <li class="nav-item  {{ $currentRoute == 'fco.complaints' ? 'active' : '' }} {{ $currentRoute == 'fco.complaint.edit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('fco.complaints') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ Request::routeIs('user.complaints') ? 'white' : 'currentColor' }}" class="bi bi-list" viewBox="0 0 16 16">
                <path d="M3.5 4.5A.5.5 0 0 1 4 4h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2zM4 5v1h8V5H4z"/>
                <path fill-rule="evenodd" d="M1 2.5A.5.5 0 0 1 1.5 2h13a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-11zM1.5 1A1.5 1.5 0 0 0 0 2.5v11A1.5 1.5 0 0 0 1.5 15h13a1.5 1.5 0 0 0 1.5-1.5v-11A1.5 1.5 0 0 0 14.5 1h-13z"/>
            </svg>
          <span class="menu-title">&nbsp Complaints List</span>
        </a>
      </li>

    @endif

    <li class="nav-item {{ $currentRoute == 'profile.edit' ? 'active' : '' }}">
      <a class="nav-link {{ Request::routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ Request::routeIs('profile.edit') ? 'white' : 'currentColor' }}" class="bi bi-person" viewBox="0 0 16 16">
              <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm5-1a1 1 0 0 0-1 1v1a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8a1 1 0 0 0-2 0v1a6 6 0 0 0 6 6h2a6 6 0 0 0 6-6V8a1 1 0 0 0-1-1z"/>
          </svg>
          <span class="menu-title">&nbsp Profile</span>
      </a>
    </li>
    
  </ul>
</nav>