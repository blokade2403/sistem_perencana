
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Sistem Perencanaan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />

       <!-- Favicon -->
       <link rel="icon" type="image/x-icon" href="{{asset("assets/img/favicon/s.ico")}}" />

       <!-- Fonts -->
       <link rel="preconnect" href="https://fonts.googleapis.com" />
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
       <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
       
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/sweetalert2/sweetalert2.css")}}" />
   
       <!-- Icons -->
       <link rel="stylesheet" href="{{asset("assets/vendor/fonts/materialdesignicons.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/fonts/fontawesome.css")}}" />
   
       <!-- Core CSS -->
       <link rel="stylesheet" href="{{asset("assets/vendor/css/rtl/core.css")}}" class="template-customizer-core-css" />
       <link rel="stylesheet" href="{{asset("assets/vendor/css/rtl/theme-default.css")}}" class="template-customizer-theme-css" />
       <link rel="stylesheet" href="{{asset("assets/css/demo.css")}}" />
   
       <!-- Vendors CSS -->
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/node-waves/node-waves.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/typeahead-js/typeahead.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/apex-charts/apex-charts.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/swiper/swiper.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/select2/select2.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/tagify/tagify.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/formvalidation/dist/css/formValidation.min.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/flatpickr/flatpickr.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/bs-stepper/bs-stepper.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/jquery-timepicker/jquery-timepicker.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/pickr/pickr-themes.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/toastr/toastr.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/libs/animate-css/animate.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/css/pages/page-auth.css")}}" />
       {{-- <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
   
   
       <!-- Page CSS -->
       <link rel="stylesheet" href="{{asset("assets/vendor/css/pages/cards-statistics.css")}}" />
       <link rel="stylesheet" href="{{asset("assets/vendor/css/pages/cards-analytics.css")}}" />
       <!-- Helpers -->
       <script src="{{asset("assets/datatable/jQuery-3.7.0/jquery-3.7.0.js")}}"></script>
       <script src="{{asset("assets/datatable/DataTables-1.13.6/js/jquery.dataTables.min.js")}}"></script>
       <script src="{{asset("assets/vendor/js/helpers.js")}}"></script>
       <script src="{{asset("assets/vendor/js/template-customizer.js")}}"></script>
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
       <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
       <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
       <script src="{{asset("assets/js/config.js")}}"></script>
