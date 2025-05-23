<x-head></x-head>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <x-sidebar></x-sidebar>

      <!-- Layout container -->
      <div class="layout-page">
        <x-navbar></x-navbar>

        <!-- Content wrapper -->
       <x-header></x-header>
        
        {{ $slot }}

       <x-footer></x-footer>