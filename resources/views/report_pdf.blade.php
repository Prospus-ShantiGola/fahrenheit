<!doctype html>
<html>

<head>
    <meta charset="utf-8">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <!--  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <!-- Bootstrap CSS -->
   <!--  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/pdf-css.css"> -->

  <!-- <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/css/pdf-css.css') }}" rel="stylesheet"> -->







<title>Pdf</title>

    <style type="text/css"  media="all">


/* min css*/

:root {
    --blue:#007bff;--indigo:#6610f2;--purple:#6f42c1;--pink:#e83e8c;--red:#dc3545;--orange:#fd7e14;--yellow:#ffc107;--green:#28a745;--teal:#20c997;--cyan:#17a2b8;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#007bff;--secondary:#6c757d;--success:#28a745;--info:#17a2b8;--warning:#ffc107;--danger:#dc3545;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}

*,::after,::before {
    box-sizing: border-box
}

html {
    font-family: sans-serif;
    line-height: 1.15;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    -ms-overflow-style: scrollbar;
    -webkit-tap-highlight-color: transparent
}
article,aside,figcaption,figure,footer,header,hgroup,main,nav,section {
    display: block
}


body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff
}
.container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto
}
@media (min-width: 576px) {
    .container {
        max-width:540px
    }
}

@media (min-width: 768px) {
    .container {
        max-width:720px
    }
}

@media (min-width: 992px) {
    .container {
        max-width:960px
    }
}

@media (min-width: 1200px) {
    .container {
        max-width:1140px
    }
}

h1,h2,h3,h4,h5,h6 {
    margin-top: 0;
    margin-bottom: .5rem
}
.h1,h1 {
    font-size: 2.5rem
}
.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6 {
    margin-bottom: .5rem;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;
    color: inherit
}
img {
    vertical-align: middle;
    border-style: none
}
.h2,h2 {
    font-size: 2rem
}


@charset "utf-8";
/* CSS Document */

@import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700');
body {padding:0; margin:0; font-family: 'Roboto', sans-serif !important;}
img {max-width:100%;}
*{margin:0; padding:0;}
section.report {
    padding: 100px 0 50px;
}
.report h1 span {
    float: right;
    display: inline-block;
    color: #11708c;
}
.report h1 {
    margin: 0 0 3px;
    font-size: 33px; background-image:none; padding-left:0;
}
.report h2 {
    text-align: right;
    font-size: 33px;
    color: #11708c;
    /* font-weight: 400; */
}
.project-data h6 {
    font-size: 20px;
    color: #e52c2a;
    font-weight: 400;
}
ul.project-data-list {
    padding: 0;
    list-style: none;
    display: block;
    /* margin: 0; */
    width: 100%;
    float: left;
}
.project-data-list li:nth-child(2n) {
    font-weight: 300;     width: 80%;
}
.project-data-list li:nth-child(2n+1) {
    width: 20%;
}
.project-data-list li {

    float: left;
    padding: 2px 0;
    color: #066899;
    font-weight: 400;
    font-size: 15px;
}
section.contact-address {
    clear: both;
    padding-top: 95px;
}
.contact-address h6 {
    font-size: 20px;
    color: #e52c2a;
    font-weight: 400; margin:0 0 20px;
}

.contact-address img {
    margin: 20px 0;
}
.contact-address p {
    margin: 0;
    color: #066899;
    font-size: 15px;
}
footer {
    padding: 100px 0;
}
footer li {
    float: left;
    width: 33.3%;
    text-align: center;
    color: #066899;
}
 h1 {
    font-weight: 500;
    color: #00618c;
    font-size: 35px;


    @if($print_type =='html')
    background: url({{ asset('public/images/flake.png') }} );
       @else
        background: url(./public/images/flake.png)    @endif;
    background-repeat: no-repeat;
    background-position: top left;
    padding-left: 41px;
    padding-top: 11px;
    margin-bottom: 50px; margin-top: 50px;
}

h6 {
    font-size: 20px;
    color: #e52c2a;
    font-weight: 400;
    margin-top: 50px;
    margin-bottom: 15px;
}

.table {
    table-layout: fixed;
}
.table td {
    padding: 3px 10px;
    border-top: none;
    border-bottom: 1px solid #066899;
    color: #066899;
    font-size: 14px;
    font-weight: 300;
}


.table th {
    padding: 3px 8px 3px 0;
    border-top: none;
    border-bottom: 1px solid #066899;
    color: #066899;
    font-size: 14px;
    font-weight: 500;     white-space: nowrap;
}

.table th span { color:#e52c2a; }
.table td span { color:#e52c2a; }
.notice-area textarea {
    width: 100%;
    border: 1px solid #066899;
    color: #066899;
    padding: 11px;
    height: 200px;
    resize: none;
}
.notice-area textarea::-placeholder {  color: #066899;}

.table thead th:first-child { text-align:left;}

.table thead th {
    font-size: 20px;
    color: #e52c2a;
    font-weight: 400;
    padding-top: 50px;
    padding-bottom: 15px;
    border: none!important;
    text-align: center;
}
.table-twelve .progress {
    height: 1.5rem;
    background-color: #fff;
    border-radius: 0;
}


.table-twelve .progress-bar {
    color: #066899;
    background-color: #7bb1cb;
}
.table-twelve tr:last-child .progress-bar {
    color: #066899;
    background-color: #f19d9b;
}

.only-absorption {
    width: 60%;
    margin: 0 auto;
    overflow: hidden;
    padding-top: 25px;
}
.left-graph-div {
    float: left;
    width: 30%;
}
.right-figure-div {
    float: right;
    width: 67%;
    padding-top: 20px;
}


.left-head {
    float: left;
    width: 50%;
}
.right-head {
    float: right;
    width: 50%;
    text-align: right;
    padding-top: 35px;
}
.system-simulation-cooling h6 {clear:both;}
.system-simulation-cooling .right-head span {
    border: 1px solid #066899;
    display: inline-block;
    padding: 12px 10px;
    text-align: center;
    border-radius: 8px;
    color: #a82223;
    font-size: 17px;
    height: 73px;
    width: 71px;
}
.right-head span {
    border: 1px solid #066899;
    display: inline-block;
    padding: 5px;
    text-align: center;
    border-radius: 8px;
    color: #a82223;
    font-size: 14px;
}

.table-five tr:nth-child(5) th {
    font-weight: 300;
    padding-left: 49px;
}
.table-five tr:nth-child(7) th {
    font-weight: 300;
    padding-left: 49px;
}

.table-six tr td:nth-child(2) {
    background:#f1f1f1;
}

.table-six tr td:last-child {
    background:#f1f1f1;
}

.table-seven tr td:last-child {
    background:#f1f1f1; text-align:right;
}

.table-seven tr td:nth-child(2) {
    background:#f1f1f1; text-align:right;
}

.table-twelve tr:last-child th {
    text-align: left;
    padding-left: 40px; font-weight:300;
}
.table-eight tr:nth-child(3) th {
    font-weight: 300;
    padding-left: 49px;
}
.table-eight tr:nth-child(5) th {
    font-weight: 300;
    padding-left: 49px;
}

.table-nine tr td:nth-child(2) {
    background: #f1f1f1;
    text-align: left;
}
.table-twelve.gama tr:last-child th {
    text-align: left;
    padding-left: 0px;
    font-weight: 500;
}
.table-fivteeen.oper tr:last-child td:nth-child(3) {
    text-align: right;
    color: red;
}
.table-nine tr td:last-child {
    background:#f1f1f1; text-align:left;
}

.table-ten tr td:last-child {
    background:#f1f1f1; text-align:right;
}

.table-ten tr td:nth-child(2) {
    background:#f1f1f1; text-align:right;
}

.table-eleven tr td:first-child {
    padding-left: 40px;
}

.table-eleven tr td:nth-child(2) {
   background:#f1f1f1; text-align:right;
}

  .table-eleven tr td:last-child {
   background:#f1f1f1; text-align:right;
  }

.table-eleven tr:first-child td:last-child {
   background:#fff;
}

.table-eleven tr:nth-child(2) td:last-child {
   background:#fff; }



.table-eleven tr:nth-child(3) td {
    padding-top: 24px;
    border: none;
    padding-bottom: 9px;
    text-align: center;
}

.table-twelve tr td {
    text-align: right;
    padding-right: 100px;
}
.table-twelve td:first-child {
    text-align: left;
    padding-left: 40px;
}

.graph-table tr:nth-child(2) td {
    color: #c74159;
}

.graph-table tr:nth-child(3) td {
    color: #069d58;
}


.graph-table tr:nth-child(4) td {
    color: #aaaaaa;
}


.graph-table2 tr:nth-child(4) td {
    color: #aaaaaa;
}

.graph-table2 tr:nth-child(2) td {
    color: #c74159;
}

.graph-table2 tr:nth-child(3) td {
    color: #069d58;
}

.graph-table5 tr:first-child td {
    color: #c74159;
}

.graph-table5 tr:last-child td {
    color: #069d58;
}


.graph-table4 tr:first-child td {
    color: #c74159;
}

.graph-table4 tr:nth-child(3) td {
    color: #146d71;
}
.graph-table4 tr:last-child td {
    color: #b0b0b0;
}

.table-fourteen tr td:nth-child(2) { background:#f1f1f1;}

.table-fourteen tr td:last-child { background:#f1f1f1;}


.table-fivteeen tr td:nth-child(2) { background:#f1f1f1; text-align:right;}

.table-fivteeen tr td:last-child { background:#f1f1f1; text-align:right;}

.table-fivteeen tr td:nth-child(3) {  text-align:right;}

footer li:first-child {
    text-align: left;
    padding-left: 65px;
}
.table-two tr:nth-child(2) th {
    font-weight: 300;
    padding-left: 49px;
}

@media (max-width:767px) {
  .project-data-list li:nth-child(2n+1) {
    width: 40%;
}
footer li:first-child {
    text-align: center;
    padding-left: 0px;
}
.project-data-list li:nth-child(2n) {
    width: 60%;
}
  .table {
    table-layout: auto;
}

  h1 {
    font-size: 28px;}


  .table th {
    white-space: nowrap;
}

  .table td {
    white-space: nowrap;
}
  .only-absorption {
    width: 100%;}


  .left-graph-div {
    width: 100%;
}
.right-figure-div {
    width: 100%;
}
  }

</style>
    <style>
  hr {
    border: 0;
    border-top: 1px solid #00618C;
    width: 90%;
    margin: 0 auto 4em;
}
  </style>
</head>
<body>

<!--page 1 start -->
<section class="report">
  <div class="container">
     <h1>@if($print_type =='html')

      <img src="{{ asset('public/images/flake.png') }}"    alt="" />
     @else
    <img src="public/images/flake.png"    alt="" />
    @endif<span>Convert heat into cold.</span></h1>
     <div class="top-banner-img">

      @if($print_type =='html')

      <img src="{{ asset('public/images/pdf-front-page.jpg') }}"    alt="" />
     @else
    <img src="public/images/pdf-front-page.jpg"    alt="" />
    @endif


      </div>
      <h2></h2>
  </div>
</section>
<section class="project-data">
 <div class="container">
   <div class="project-data-edtails">
     <h6>Project Data</h6>
     <ul class="project-data-list">
       <li>Project Name</li>
       <li > {{ optional($general_info)->project_name}}</li>
       <li>Project Number</li>
       <li>{{ optional($general_info)->project_number}}</li>
       <li>Project-address </li>
       <li> {{ optional($general_info)->location}}</li>
       <li>Contact Person</li>
       <li>{{ optional($general_info)->contact}}</li>
     </ul>
   </div>
 </div>
</section>
<section class="contact-address">
 <div class="container">
   <h6>Contact us by:</h6>
    @if($print_type =='html')

      <img src="{{ asset('public/images/logo.png') }}"    alt="" />
     @else
    <img src="public/images/logo.png"    alt="" />
    @endif

   <p> <b>FAHRENHEIT GmbH</b> <br>
Siegfriedstraße 19 <br>
80803 Munich <br>
Germany</p>

<p>Fon: +49 (0) 345 27 98 09-0</p>
<p>Web: fahrenheit.cool</p>
<p>Email: info@fahrenheit.cool</p>
 </div>
</section>
<footer>
 <ul class="list-inline">
  <li>{{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

  <!-- <li>1/11</li> -->
 </ul>
</footer>
<hr>
<!-- page 1 end-->
<!-- page2 start-->
<section class="design-condition">
 <div class="container">
   <h1>General Information</h1>
   <h6>Project Data</h6>
      <div class="table-responsive">
   <table class="table tablegi-one" >
     <tr>
      <th  align="left">Project number</th>
      <td >{{ optional($general_info)->project_number}}</td>
     </tr>
     <tr>
     <th  align="left">Project name</th>
     <td> {{ optional($general_info)->project_name}}</td>
     </tr>
     <tr>
     <th  align="left">Location</th>
     <td> {{ optional($general_info)->location}}</td>
     </tr>
     <tr>
     <th  align="left">Customer</th>
     <td> {{ optional($general_info)->customer}} </td>
     </tr>
     <tr>
     <th  align="left">Contact</th>
     <td> {{ optional($general_info)->contact}}</td>
     </tr>
      <tr>
     <th  align="left">Tel. Number</th>
     <td> {{ optional($general_info)->phone_number}}</td>
     </tr>
      <tr>
     <th align="left">Email</th>
     <td> {{ optional($general_info)->email_address}}</td>
     </tr>

   </table>
   </div>
       <h6>Personal Data</h6>
          <div class=" table-responsive">
   <table class="table tablegi-two">
     <tr>
      <th  align="left">Editor</th>
      <td>{{ optional($general_info)->editor}}</td>
     </tr>
     <tr>
     <th  align="left">Company</th>
     <td>{{ optional($general_info)->company}}</td>
     </tr>
     <tr>
     <th  align="left">Address</th>
     <td>{{ optional($general_info)->address}}</td>
     </tr>
     <tr>
     <th  align="left">Tel. Number</th>
     <td>{{ optional($general_info)->personal_phone_number}}</td>
     </tr>
     <tr>
     <th  align="left">Mobile</th>
     <td>{{ optional($general_info)->mobile_number}}</td>
     </tr>
      <tr>
     <th  align="left">Email</th>
     <td>{{ optional($general_info)->personal_email_address}}</td>
     </tr>

   </table>
   </div>
      </div>
</section>
<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

 <!--  <li>2/11</li> -->
 </ul>
</footer>
<hr>

<!-- page 2 end-->
<!-- page 3 start -->
 @if($economic_datas!=null)
<section class="required-cooling-capacity">
  <div class="container">
    <h1>Economic Data</h1>
   <h6>General</h6>
      <div class=" table-responsive">
   <table class="table tableed-one">
     <tr>
      <th  align="left">Electricity price</th>
      <td>{{ optional($economic_datas)->electric_price}}</td>
     </tr>
     <tr>
     <th  align="left">Heat price</th>
     <td>{{ optional($economic_datas)->heat_price}}</td>
     </tr>
     <tr>
     <th  align="left">Electricity price increase</th>
     <td>{{ optional($economic_datas)->electric_price_increased}} </td>
     </tr>
     <tr>
     <th  align="left">Calculated interest rate</th>
     <td> {{ optional($economic_datas)->calculated_interest_rate}}</td>
     </tr>
     <tr>
     <th  align="left">Inflation rate</th>
     <td>{{ optional($economic_datas)->inflation_rate}}</td>
     </tr>
      @if(!empty($ecc_additional_ary['general']))
       @foreach($ecc_additional_ary['general'] as $general_ecc)
          <tr>
     <th  align="left">{{ $general_ecc['additional_field_name'] }}</th>
     <td>{{$general_ecc['additional_field_value'] }}</td>
     </tr>
      @endforeach
       @endif
   </table>
   </div>
   <h6>CHP</h6>
      <div class=" table-responsive">
   <table class="table tableed-two">
     <tr>
      <th  align="left">Own usage of electricity</th>
      <td>{{ optional($economic_datas)->own_usage_of_electricity}}</td>
     </tr>
     <tr>
     <th  align="left">KWK-subsidy for electricity</th>
     <td>{{ optional($economic_datas)->subsidy_for_electricity}}</td>
     </tr>
     <tr>
     <th  align="left">Gas price</th>
     <td>{{ optional($economic_datas)->gas_price}}</td>
     </tr>
     <tr>
      <th colspan="2" class="for-experts">For Experts</th>

     </tr>
     <tr>
     <th  align="left">Electricity sales price</th>
     <td>{{ optional($economic_datas)->electricity_sales_price}}</td>
     </tr>
     <tr>
     <th  align="left">Energiesteuer Rückerstattung</th>
     <td>{{ optional($economic_datas)->energy_tax_refund}}</td>
     </tr>
     <tr>
     <th  align="left">EEG-Umlage-Anteil</th>
     <td>{{ optional($economic_datas)->eeg_allocation_portion}}</td>
     </tr>
     <tr>
     <th  align="left">EEG-Umlage-Kosten</th>
     <td>{{ optional($economic_datas)->eeg_apportion_costs}}</td>
     </tr>

      @if(!empty($ecc_additional_ary['chp']))
       @foreach($ecc_additional_ary['chp'] as $general_ecc)
          <tr>
     <th  align="left">{{ $general_ecc['additional_field_name'] }}</th>
     <td>{{$general_ecc['additional_field_value'] }}</td>
     </tr>
      @endforeach
       @endif


   </table>
   </div>
    <h6>Investment</h6>
      <div class=" table-responsive">
   <table class="table tableed-three">
     <tr>
      <th  align="left">CHP in the basement</th>
      <td>{{ optional($economic_datas)->chp_basement}}€</td>
      <th  align="left">Discount</th>
      <td>{{ optional($economic_datas)->discount_chp_basement}}%</td>
     </tr>
     <tr>
      <th  align="left">Chiller 1</th>
      <td>{{ optional($economic_datas)->chiller}}€</td>
      <th  align="left">Discount</th>
      <td>{{ optional($economic_datas)->chiller_discount}}%</td>
     </tr>
     <tr>
      <th  align="left">Radiant cooling office</th>
      <td>{{ optional($economic_datas)->radiant_cooling_office}}€</td>
      <th  align="left">Discount</th>
      <td>{{ optional($economic_datas)->radiant_discount}}%</td>
     </tr>
     <tr>
      <th  align="left">eCoo 10X</th>
      <td>{{ optional($economic_datas)->ecoo}}€</td>
      <th  align="left">Discount</th>
      <td>{{ optional($economic_datas)->ecoo_discount}}%</td>
     </tr>

       @if(!empty($ecc_additional_ary['investment']))
       @foreach($ecc_additional_ary['investment'] as $general_ecc)
          <tr>
     <th  align="left">{{ $general_ecc['additional_field_name'] }}</th>
     <td>{{$general_ecc['additional_field_value'] }}</td>
      <th  align="left">Discount</th>
        <td>{{$general_ecc['additional_field_discount'] }}%</td>
     </tr>
      @endforeach
       @endif

   </table>
   </div>
    <h6>Maintenance</h6>
      <div class=" table-responsive">
   <table class="table tableed-four">
     <tr>
      <th  align="left">CHP in the basement</th>
      <td>{{ optional($economic_datas)->chp_basement_maintenence}}€</td>
     </tr>
     <tr>
     <th  align="left">Chiller 1</th>
     <td>{{ optional($economic_datas)->chiller_maintenence}}€</td>
     </tr>
     <tr>
     <th  align="left">Radiant cooling office</th>
     <td>{{ optional($economic_datas)->radiant_maintenence}}€</td>
     </tr>
     <tr>
     <th  align="left">eCoo 10X</th>
     <td>{{ optional($economic_datas)->ecoo_maintenence}}€</td>
     </tr>
     <tr>
     <th  align="left">Project planning</th>
     <td>€</td>
     </tr>
     @if(!empty($ecc_additional_ary['maintenence']))
       @foreach($ecc_additional_ary['maintenence'] as $general_ecc)
          <tr>
     <th  align="left">{{ $general_ecc['additional_field_name'] }}</th>
     <td>{{$general_ecc['additional_field_value'] }}</td>

     </tr>
      @endforeach
       @endif



   </table>
   </div>
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

<!--   <li>3/11</li> -->
 </ul>
</footer>
<hr>
@endif

<!-- page 3 end -->
 @if($options_datas!=null)
<!--- page 4 start-->
<section class="system-design">
 <div class="container">
    <h1>Options</h1>
    <h6>General</h6>
    <div class=" table-responsive">
   <table class="table tableo-one">
     <tr>
      <th  align="left">Language</th>
      <td>
           @if($print_type =='html')

      <img src="{{ asset('public/images/germany-flag.png') }}"    alt="" />
     @else
    <img src="public/images/germany-flag.png"    alt="" />
    @endif

  </td>
     </tr>
     <tr>
     <th  align="left">BAFA 2018</th>
     <td>{{ optional($options_datas)->profile_bafa}}</td>
     </tr>
     <tr>
     <th  align="left">Re-cooling Method</th>
     <td>{{ optional($options_datas)->profile_recooling}}</td>
     </tr>
     <tr>
     <th  align="left">Re-cooling Temperature</th>
     <td>{{ optional($options_datas)->profile_recooling_temp}}</td>
     </tr>
     <tr>
     <th  align="left">Free Cooling</th>
     <td>{{ optional($options_datas)->free_recooling}}</td>
     </tr>
       <tr>
     <th  align="left">Heat Sources</th>
     <td>{{ optional($options_datas)->profile_heat_source}}</td>
     </tr>
      <tr>
     <th  align="left">Heat Supply</th>
     <td>{{ optional($options_datas)->profile_heat_supply}}</td>
     </tr>
      <tr>
     <th  align="left">Conventional heat source</th>
     <td>{{ optional($options_datas)->profile_conventional_heat}}</td>
     </tr>
      <tr>
     <th  align="left">Calculation method</th>
     <td>{{ optional($options_datas)->profile_calculation_method}} </td>
     </tr>
      <tr>
     <th  align="left">Ambient temperature step</th>
     <td>{{ optional($options_datas)->profile_amb_tem}}</td>
     </tr>
      <tr>
     <th  align="left">Heating load profile</th>
     <td>{{ optional($options_datas)->profile_heating_load}}</td>
     </tr>
      <tr>
     <th  align="left">Cooling load profile</th>
     <td>{{ optional($options_datas)->profile_cooling_load}}</td>
     </tr>

   </table>
   </div>
     <h6>Project Specifiations</h6>
    <div class=" table-responsive">
   <table class="table tableo-two">
     <tr>
      <th  align="left">Bus system</th>
      <td>{{ optional($options_datas)->bus_system}}</td>
     </tr>
     <tr>
     <th  align="left">Controller</th>
     <td>{{ optional($options_datas)->profile_controller}}</td>
     </tr>
     <tr>
     <th  align="left">Pressure drop in the piping</th>
     <td>{{ optional($options_datas)->pressure_drop}}</td>
     </tr>

    </table>
   </div>


 </div>
</section>
<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

  <!-- <li>4/11</li> -->
 </ul>
</footer>
<hr>
@endif
<!-- page 4 end-->

 @if(!($heat_sources->isEmpty()))
<!-- page 5 start-->
<section class="system-simulation-cooling">
 <div class="container">

<h1>Heat Source</h1>
 @foreach($heat_sources as $heat_sourcesary)

   <h6>Technical Data</h6>

    <div class=" table-responsive">
   <table class="table tablehs-one">

     <tr>
      <th  align="left">Name</th>
      <td>{{ optional($heat_sourcesary)->heat_name}}</td>
     </tr>
     <tr>
     <th  align="left">Type of heat source</th>
     <td>{{ optional($heat_sourcesary)->heat_type}}</td>
     </tr>
     <tr>
     <th  align="left">Drive temperature</th>
     <td>{{ optional($heat_sourcesary)->drive_temp}}</td>
     </tr>
     <tr>
     <th  align="left">Heat capacity</th>
     <td>{{ optional($heat_sourcesary)->heat_capacity}}</td>
     </tr>
     <tr>
     <th  align="left">Electric capacity</th>
     <td>{{ optional($heat_sourcesary)->electricity_capacity}}</td>
     </tr>
       <tr>
     <th  align="left">Thermal efficiency</th>
     <td>{{ optional($heat_sourcesary)->thermal_efficienty}}</td>
     </tr>
      <tr>
     <th  align="left">Electric efficiency</th>
     <td>{{ optional($heat_sourcesary)->electricity_efficienty}}</td>
     </tr>
      <tr>
     <th  align="left">Manufacturer</th>
     <td>{{ optional($heat_sourcesary)->heat_type}}</td>
     </tr>
      <tr>
     <th  align="left">Type</th>
     <td>{{ optional($heat_sourcesary)->heat_type}}</td>
     </tr>
      <tr>
     <th  align="left">Operation hours</th>
     <td>{{ optional($heat_sourcesary)->heat_type}}</td>
     </tr>
      <tr>
     <th  align="left">New installation</th>
     <td>{{ optional($heat_sourcesary)->new_installation}}</td>
     </tr>

   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablehs-two">
     <tr>
      <th  align="left">Investment costs</th>
      <td>{{ optional($heat_sourcesary)-> heat_investment_cost}}</td>
     </tr>
     <tr>
     <th  align="left">Discount</th>
     <td>{{ optional($heat_sourcesary)->heat_investment_discount}}</td>
     </tr>
     <tr>
     <th  align="left">Maintenance costs</th>
     <td>{{ optional($heat_sourcesary)->heat_maintenance_cost}}</td>
     </tr>
     </table>
   </div>
      @endforeach
</div>
</section>

<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

 <!--  <li>5/11</li> -->
 </ul>
</footer>
<hr>
@endif
<!-- page 5 end-->
<!-- page 6 start-->
 @if(!($heating_load_profiles->isEmpty()))

<section class="system-simulation-cooling">
 <div class="container">
<h1>Heating Load Profile</h1>
 @foreach($heating_load_profiles as $profile_ary)

<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tablehlp-one">
     <tr>
      <th  align="left">Name</th>
      <td>{{ optional($profile_ary)->profile_name}}</td>
     </tr>
     <tr>
     <th  align="left">Profile Type</th>
     <td>{{ optional($profile_ary)->profile_type}}</td>
     </tr>
     <tr>
     <th  align="left">Max. heating load</th>
     <td>{{ optional($profile_ary)->max_heat_load_power}} at {{ optional($profile_ary)->max_heat_load_temp}}</td>
     </tr>
     <tr>
     <th  align="left">Base load</th>
     <td>{{ optional($profile_ary)->base_load_power}} from {{ optional($profile_ary)->base_load_temp}} </td>
     </tr>
     <tr>
     <th  align="left">Zero load</th>
     <td>{{ optional($profile_ary)->zero_load_power}} from {{ optional($profile_ary)->zero_load_temp}} </td>
     </tr>


   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablehs-two">
     <tr>
      <th  align="left">Investment costs</th>
      <td>{{ optional($profile_ary)->hp_investment_cost}}</td>
     </tr>
     <tr>
     <th  align="left">Discount</th>
     <td>{{ optional($profile_ary)->hp_discount}}</td>
     </tr>
     <tr>
     <th  align="left">Maintenance costs</th>
     <td>{{ optional($profile_ary)->maintenance_cost}}</td>
     </tr>
     </table>
   </div>
      @endforeach
</div>
</section>

<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

 <!--  <li>6/11</li> -->
 </ul>
</footer>
<hr>
<!-- page 6 end-->
@endif
 @if(!($compression_chillers->isEmpty()))

<!-- page 7 start-->
<section class="feasibility-calculation">
  <div class="container">
   <h1>Compression Chillers</h1>
    @foreach($compression_chillers as $chiller_ary)
<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tablehcc-one">
     <tr>
      <th  align="left">Name</th>
      <td>{{ optional($chiller_ary)->chillername}}</td>
     </tr>
     <tr>
     <th  align="left">Refrigerant</th>
     <td>{{ optional($chiller_ary)->refrigerant}}</td>
     </tr>
     <tr>
     <th  align="left">Manufacturer</th>
     <td>{{ optional($chiller_ary)->manufacturer}}</td>
     </tr>
     <tr>
     <th  align="left">Compressor type</th>
     <td>{{ optional($chiller_ary)->compressor}}</td>
     </tr>
     <tr>
     <th  align="left">Chilled water temperature</th>
     <td>{{ optional($chiller_ary)->temperature}}</td>
     </tr>


   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablecc-two">
     <tr>
      <th  align="left">Investment costs</th>
      <td>{{ optional($chiller_ary)->investment_cost}}</td>
     </tr>
     <tr>
     <th  align="left">Discount</th>
     <td>{{ optional($chiller_ary)->discount}}</td>
     </tr>
     <tr>
     <th  align="left">Maintenance costs</th>
     <td>{{ optional($chiller_ary)->maintenence_costs}}</td>
     </tr>
     </table>
   </div>
 @endforeach

  </div>
</section>
<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

  <!-- <li>7/11</li> -->
 </ul>
</footer>
<hr>
@endif
<!--- page 7 end -->
 @if(!($cooling_load_profiles->isEmpty()))

<!-- page 8 start-->
<section class="feasibility-calculation">
  <div class="container">
    <h1>Cooling Load Profile</h1>
      @foreach($cooling_load_profiles as $cooling_ary)
<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tablehclp-one">
     <tr>
      <th  align="left">Name</th>
      <td>{{ optional($cooling_ary)->cooling_radiant_cooling_office}}</td>
     </tr>
     <tr>
     <th  align="left">Profile Type</th>
     <td>{{ optional($cooling_ary)->cooling_profile_type}}</td>
     </tr>
     <tr>
     <th  align="left">Chilled water temperature</th>
     <td>{{ optional($cooling_ary)->cooling_radiant_cooling_office}}</td>
     </tr>
     <tr>
     <th  align="left">Chilled water inlet temperature</th>
     <td>{{ optional($cooling_ary)->cooling_radiant_cooling_office}}</td>
     </tr>
     <tr>
     <th  align="left">Max. cooling load</th>
     <td>{{ optional($cooling_ary)->cooling_max_cooling_load}} at   {{ optional($cooling_ary)->cooling_max_cooling_load_at}}  </td>
     </tr>
     <tr>
     <th  align="left">Base load</th>
     <td>{{ optional($cooling_ary)->  cooling_base_load_to}} from   {{ optional($cooling_ary)-> cooling_base_load_from}} </td>
     </tr>
     <tr>
     <th  align="left">Zero load</th>
     <td>{{ optional($cooling_ary)->  cooling_zero_load_from}} from   {{ optional($cooling_ary)-> cooling_zero_load_to}}</td>
     </tr>
      <tr>
     <th  align="left">Cooling hours</th>
     <td>{{ optional($cooling_ary)->cooling_cooling_hours}} </td>
     </tr>

   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablehs-two">
     <tr>
      <th  align="left">Investment costs</th>
      <td>{{ optional($cooling_ary)->cooling_investment_cost}}</td>
     </tr>
     <tr>
     <th  align="left">Discount</th>
     <td>{{ optional($cooling_ary)->cooling_investment_discount}}</td>
     </tr>
     <tr>
     <th  align="left">Maintenance costs</th>
     <td>{{ optional($cooling_ary)->cooling_maintenance_cost}}</td>
     </tr>
     </table>
   </div>
   @endforeach
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

 <!--  <li>8/11</li> -->
 </ul>
</footer>
<hr>
<!--- page 8 end -->
@endif


  @if(!($fahrenheit_chiller->isEmpty()))
<!-- page 9 start-->
<section class="feasibility-calculation">
  <div class="container">
    <h1>Fahrenheit System</h1>
   @foreach($fahrenheit_chiller as $chiller)
    <h6> Chiller</h6>
    <h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-one">
     <tr>
      <th  align="left">Chiller type</th>
      <td>{{ optional($chiller)->chiller_chiller_type}}</td>
     </tr>
     <tr>
     <th  align="left">Adsorbent</th>
     <td>{{ optional($chiller)->chiller_adsorbent}}</td>
     </tr>
     <tr>
     <th  align="left">Product</th>
     <td>{{ optional($chiller)->chiller_product}}</td>
     </tr>
     <tr>
     <th  align="left">Number of chillers</th>
     <td>{{ optional($chiller)->chiller_no_chiller}}</td>
     </tr>
     <tr>
     <th  align="left">Product interconnection</th>
     <td>{{ optional($chiller)->chiller_product_inter}}</td>
     </tr>
     <tr>
     <th  align="left">Group interconnection</th>
     <td>{{ optional($chiller)->chiller_group_inter}}</td>
     </tr>
     <tr>
     <th  align="left">Function</th>
     <td></td>
     </tr>


   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-two">
     <tr>
      <th  align="left">Investment costs</th>
      <td>{{ optional($chiller)->addchiller_investment_cost}}</td>
     </tr>
     <tr>
     <th  align="left">Discount</th>
     <td>{{ optional($chiller)->addchiller_discount}}</td>
     </tr>
     <tr>
     <th  align="left">Maintenance costs</th>
     <td>{{ optional($chiller)->addchiller_maintenence}}</td>
     </tr>
     </table>
   </div>
 @endforeach

      <h6>Re-cooling System</h6>
       @foreach($fahrenheit_recool as $recooling)
    <h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-one">
     <tr>
      <th  align="left">Components</th>
      <td>{{ optional($recooling)->recooler_component}}</td>
     </tr>
     <tr>
     <th  align="left">Re-cooling method</th>
     <td>{{ optional($recooling)->recooler_method}}</td>
     </tr>
     <tr>
     <th  align="left">Product</th>
     <td>{{ optional($recooling)->recooler_product}}</td>
     </tr>
     <tr>
     <th  align="left">Number of units</th>
     <td>{{ optional($recooling)->recooler_units}}</td>
     </tr>
     <tr>
     <th  align="left">Name</th>
     <td>{{ optional($recooling)->recooler_name}}</td>
     </tr>
     <tr>
     <th  align="left">Re-cooling capacity</th>
     <td>{{ optional($recooling)->recooler_capacity}}</td>
     </tr>
     <tr>
     <th  align="left">Temperature difference</th>
     <td>{{ optional($recooling)->recooler_temp_diff}}</td>
     </tr>
       <tr>
     <th  align="left">Primary volume flow rate</th>
     <td></td>
     </tr>
      <tr>
     <th  align="left">Secondary volume flow rate</th>
     <td>{{ optional($recooling)->recooler_sec_volume}}</td>
     </tr>
      <tr>
     <th  align="left">Electrical power consumption</th>
     <td>{{ optional($recooling)->recooler_elec_consumption}}</td>
     </tr>
      <tr>
     <th  align="left">Available/provided by customer</th>
     <td>{{ optional($recooling)->recooler_available}}</td>
     </tr>

   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-two">
     <tr>
      <th  align="left">Investment costs</th>
      <td>{{ optional($recooling)->recooler_inv_cost}}</td>
     </tr>
     <tr>
     <th  align="left">Discount</th>
     <td>{{ optional($recooling)->recooler_discount}}</td>
     </tr>
     <tr>
     <th  align="left">Maintenance costs</th>
     <td>{{ optional($recooling)->recooler_maint_cost}}</td>
     </tr>
     </table>
   </div>
    @endforeach
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li> {{ @date('m/d/Y') }} | {{ @date('h:i A') }}</li>

 <!--  <li>9/11</li> -->
 </ul>
</footer>
<hr>
@endif
<!--- page 9 end -->
</body>
</html>
