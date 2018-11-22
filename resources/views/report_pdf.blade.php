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
    background: url(./public/images/flake.png);
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
     <h1><img src= "images/flake.png"   alt="" /><span>Convert heat into cold.</span></h1>
     <div class="top-banner-img">
       <img src="images/pdf-front-page.jpg"  alt="" />
      </div>
      <h2>Report</h2>
  </div>
</section>
<section class="project-data">
 <div class="container">
   <div class="project-data-edtails">
     <h6>Project Data</h6>
     <ul class="project-data-list">
       <li>Project Name</li> 
       <li>Propus</li>
       <li>Project Number</li>
       <li>Pro-11</li>
       <li>Project-address </li>
       <li> Noida</li>
       <li>Contact Person</li>
       <li> Santi</li>
     </ul>
   </div>
 </div>
</section>
<section class="contact-address">
 <div class="container">
   <h6>Contact us by:</h6>
    <img src= "images/logo.png"     alt="" />
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
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>1/11</li>
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
   <table class="table tablegi-one">
     <tr>
      <th>Project number</th>
      <td>New Project</td>
     </tr>
     <tr>
     <th>Project name</th>
     <td>Test Project</td>
     </tr>
     <tr>
     <th>Location</th>
     <td>Halle/Saale</td>
     </tr>
     <tr>
     <th>Customer</th> 
     <td>HabWarmWillKalt Gmbh </td>
     </tr>
     <tr>
     <th>Contact</th>
     <td>Mr. Inhaber</td>
     </tr>
      <tr>
     <th>Tel. Number</th>
     <td>0123 456</td>
     </tr>
      <tr>
     <th>Email</th>
     <td>inhaber@gmbh.de</td>
     </tr>
     
   </table>
   </div>
       <h6>Personal Data</h6>
          <div class=" table-responsive">
   <table class="table tablegi-two">
     <tr>
      <th>Editor</th>
      <td>HabWarmWillKalt Gmbh</td>
     </tr>
     <tr>
     <th>Company</th>
     <td>Gmbh</td>
     </tr>
     <tr>
     <th>Address</th>
     <td>Halle/Saale</td>
     </tr>
     <tr>
     <th>Tel. Number</th>
     <td>0123 456</td>
     </tr>
     <tr>
     <th>Mobile</th>
     <td>Mr. Inhaber</td>
     </tr>
      <tr>
     <th>Email</th>
     <td>inhaber@gmbh.de</td>
     </tr>
      
   </table>
   </div>
      </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>2/11</li>
 </ul>
</footer>
<hr>
<!-- page 2 end -->

<!-- page 3 start -->

<section class="required-cooling-capacity">
  <div class="container">
    <h1>Economic Data</h1>
   <h6>General</h6>
      <div class=" table-responsive">
   <table class="table tableed-one">
     <tr>
      <th>Electricity price</th>
      <td>0.180€/kWh</td>
     </tr>
     <tr>
     <th>Heat price</th>
     <td>0.000€/kWh</td>
     </tr>
     <tr>
     <th>Electricity price increase</th>
     <td>2.000%/a</td>
     </tr>
     <tr>
     <th>Calculated interest rate</th>
     <td>0.700%/a</td>
     </tr>
     <tr>
     <th>Inflation rate</th>
     <td>1.600%/a</td>
     </tr>
      
     
   </table>
   </div>
   <h6>CHP</h6>
      <div class=" table-responsive">
   <table class="table tableed-two">
     <tr>
      <th>Own usage of electricity</th>
      <td>100%</td>
     </tr>
     <tr>
     <th>KWK-subsidy for electricity</th>
     <td>2016</td>
     </tr>
     <tr>
     <th>Gas price</th>
     <td>0.03500€/kWh</td>
     </tr>
     <tr>
      <th colspan="2" class="for-experts">For Experts</th>
     </tr>
     <tr>
     <th>Electricity sales price</th>
     <td>0.03500€/kWh</td>
     </tr>
     <tr>
     <th>Energiesteuer Rückerstattung</th>
     <td>0.00550€/kWh</td>
     </tr>
     <tr>
     <th>EEG-Umlage-Anteil</th>
     <td>40%</td>
     </tr>
     <tr>
     <th>EEG-Umlage-Kosten</th>
     <td>0.06792€/kWh</td>
     </tr>
      
     
   </table>
   </div>
    <h6>Investment</h6>
      <div class=" table-responsive">
   <table class="table tableed-three">
     <tr>
      <th>CHP in the basement</th>
      <td>78,250€</td>
      <th>Discount</th>
      <td>0%</td>
     </tr>
     <tr>
      <th>Chiller 1</th>
      <td>16,251€</td>
      <th>Discount</th>
      <td>0%</td>
     </tr>
     <tr>
      <th>Radiant cooling office</th>
      <td>8,550€</td>
      <th>Discount</th>
      <td>0%</td>
     </tr>
     <tr>
      <th>eCoo 10X</th>
      <td>19,950€</td>
      <th>Discount</th>
      <td>5%</td>
     </tr>
     <tr>
      <th>Project planning</th>
      <td>3,000€</td>
      <th>Discount</th>
      <td>2%</td>
     </tr>
      
     
   </table>
   </div>
    <h6>Maintenance</h6>
      <div class=" table-responsive">
   <table class="table tableed-four">
     <tr>
      <th>CHP in the basement</th>
      <td>78,250€</td>
     </tr>
     <tr>
     <th>Chiller 1</th>
     <td>16,251€</td>
     </tr>
     <tr>
     <th>Radiant cooling office</th>
     <td>8,550€</td>
     </tr>
     <tr>
     <th>eCoo 10X</th>
     <td>19,950€</td>
     </tr>
     <tr>
     <th>Project planning</th>
     <td>3,000€</td>
     </tr>
     
      
     
   </table>
   </div>
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>3/11</li>
 </ul>
</footer>
<hr>

<!-- page 3 end -->

<!--- page 4 start-->
<section class="system-design">
 <div class="container">
    <h1>Options</h1>
    <h6>General</h6>
    <div class=" table-responsive">
   <table class="table tableo-one">
     <tr>
      <th>Language</th>
      <td><img src= "images/germany-flag.png" alt=""></td>
     </tr>
     <tr>
     <th>BAFA 2018</th>
     <td>calculate</td>
     </tr>
     <tr>
     <th>Re-cooling Method</th>
     <td>Dry</td>
     </tr>
     <tr>
     <th>Re-cooling Temperature</th>
     <td>25 °C</td>
     </tr>
     <tr>
     <th>Free Cooling</th>
     <td>Yes (chilled water temperature)</td>
     </tr>
       <tr>
     <th>Heat Sources</th>
     <td>Utilize also for heating load profile</td>
     </tr>
      <tr>
     <th>Heat Supply</th>
     <td>Priority for heating load profile</td>
     </tr>
      <tr>
     <th>Conventional heat source</th>
     <td>Boiler, 2x 100 kW</td>
     </tr>
      <tr>
     <th>Calculation method</th>
     <td>Chilled water inlet temperature </td>
     </tr>
      <tr>
     <th>Ambient temperature step</th>
     <td>constant</td>
     </tr>
      <tr>
     <th>Heating load profile</th>
     <td>1.0 K </td>
     </tr>
      <tr>
     <th>Cooling load profile</th>
     <td>Capacity [kW]</td>
     </tr>
     
   </table>
   </div>
     <h6>Project Specifiations</h6>
    <div class=" table-responsive">
   <table class="table tableo-two">
     <tr>
      <th>Bus system</th>
      <td>-</td>
     </tr>
     <tr>
     <th>Controller</th>
     <td>-</td>
     </tr>
     <tr>
     <th>Pressure drop in the piping</th>
     <td>-</td>
     </tr>
    
    </table>
   </div>

     
 </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>4/11</li>
 </ul>
</footer>
<hr>
<!-- page 4 end-->
<!-- page 5 start-->
<section class="system-simulation-cooling">
 <div class="container">

<h1>Heat Source</h1>

   
   <h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tablehs-one">
     <tr>
      <th>Name</th>
      <td>CHP in the basement</td>
     </tr>
     <tr>
     <th>Type of heat source</th>
     <td>CHP</td>
     </tr>
     <tr>
     <th>Drive temperature</th>
     <td>85°C</td>
     </tr>
     <tr>
     <th>Heat capacity</th>
     <td>36 kw</td>
     </tr>
     <tr>
     <th>Electric capacity</th>
     <td>18 kw</td>
     </tr>
       <tr>
     <th>Thermal efficiency</th>
     <td>54.8 %</td>
     </tr>
      <tr>
     <th>Electric efficiency</th>
     <td>34.5 %</td>
     </tr>
      <tr>
     <th>Manufacturer</th>
     <td>EC-Power</td>
     </tr>
      <tr>
     <th>Type</th>
     <td>XRGI 15</td>
     </tr>
      <tr>
     <th>Operation hours</th>
     <td>4.000 h/a</td>
     </tr>
      <tr>
     <th>New installation</th>
     <td>No</td>
     </tr>
     
   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablehs-two">
     <tr>
      <th>Investment costs</th>
      <td>€</td>
     </tr>
     <tr>
     <th>Discount</th>
     <td>%</td>
     </tr>
     <tr>
     <th>Maintenance costs</th>
     <td>€/kWh</td>
     </tr>
     </table>
   </div>
</div>
</section>

<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>5/11</li>
 </ul>
</footer>
<hr>

<!-- page 5 end-->
<!-- page 6 start-->

<section class="system-simulation-cooling">
 <div class="container">
<h1>Heating Load Profile</h1>
<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tablehlp-one">
     <tr>
      <th>Name</th>
      <td>Office South</td>
     </tr>
     <tr>
     <th>Profile Type</th>
     <td>Office Space</td>
     </tr>
     <tr>
     <th>Max. heating load</th>
     <td>52.2 kw at -15</td>
     </tr>
     <tr>
     <th>Base load</th>
     <td>8.0 kw from °C</td>
     </tr>
     <tr>
     <th>Zero load</th>
     <td>0.0 kw from 20 °C</td>
     </tr>
      
     
   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablehs-two">
     <tr>
      <th>Investment costs</th>
      <td>€</td>
     </tr>
     <tr>
     <th>Discount</th>
     <td>%</td>
     </tr>
     <tr>
     <th>Maintenance costs</th>
     <td>€/a</td>
     </tr>
     </table>
   </div>
     
</div>
</section>

<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>6/11</li>
 </ul>
</footer>
<hr>
<!-- page 6 end-->
<!-- page 7 start-->
<section class="feasibility-calculation">
  <div class="container">
   <h1>Compression Chillers</h1>
<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tablehcc-one">
     <tr>
      <th>Name</th>
      <td>Chiller 1</td>
     </tr>
     <tr>
     <th>Refrigerant</th>
     <td>R134a</td>
     </tr>
     <tr>
     <th>Manufacturer</th>
     <td>unknown</td>
     </tr>
     <tr>
     <th>Compressor type</th>
     <td>unknown</td>
     </tr>
     <tr>
     <th>Chilled water temperature</th>
     <td>6 °C</td>
     </tr>
      
     
   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablecc-two">
     <tr>
      <th>Investment costs</th>
      <td>€</td>
     </tr>
     <tr>
     <th>Discount</th>
     <td>%</td>
     </tr>
     <tr>
     <th>Maintenance costs</th>
     <td>€/a</td>
     </tr>
     </table>
   </div>
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>7/11</li>
 </ul>
</footer>
<hr>
<!--- page 7 end -->

<!-- page 8 start-->
<section class="feasibility-calculation">
  <div class="container">
    <h1>Cooling Load Profile</h1>
<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tablehclp-one">
     <tr>
      <th>Name</th>
      <td>Radiant cooling office</td>
     </tr>
     <tr>
     <th>Profile Type</th>
     <td>Office Space</td>
     </tr>
     <tr>
     <th>Chilled water temperature</th>
     <td>16°C</td>
     </tr>
     <tr>
     <th>Chilled water inlet temperature</th>
     <td>19°C</td>
     </tr>
     <tr>
     <th>Max. cooling load</th>
     <td>50.0 kW at 34°C</td>
     </tr>
     <tr>
     <th>Base load</th>
     <td>10.0 kW from 10°C</td>
     </tr>
     <tr>
     <th>Zero load</th>
     <td>0.0 kW at 10°C</td>
     </tr>
      <tr>
     <th>Cooling hours</th>
     <td>6,724 h</td>
     </tr>
     
   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tablehs-two">
     <tr>
      <th>Investment costs</th>
      <td>€</td>
     </tr>
     <tr>
     <th>Discount</th>
     <td>%</td>
     </tr>
     <tr>
     <th>Maintenance costs</th>
     <td>€/a</td>
     </tr>
     </table>
   </div>
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>8/11</li>
 </ul>
</footer>
<hr>
<!--- page 8 end -->


<!-- page 9 start-->
<section class="feasibility-calculation">
  <div class="container">
    <h1>Fahrenheit System</h1>
<h6> Chiller</h6>
    <div class=" table-responsive">
   <table class="table tablehcfs-one">
     <tr>
      <th>Adsorption chillers product group<br>
eCoo 20 ST<br>
eCoo 20 ST</th>
      <td>2.20<br> 2.20<br> 2.20</td>
     </tr>
     <tr>
     <th>Compression chiller product group
<br>
eWac 30</th>
     <td></td>
     </tr>
     <tr>
     <th>Re-cooler product group
<br>
eRec 20 | 58</th>
     <td></td>
     </tr>
     <tr>
     <th>Re-cooler product group
<br>
eRec 20 | 80

</th>
     <td></td>
     </tr>
     
   </table>
   </div>
      <h6>Re-cooling System</h6>
    <div class=" table-responsive">
    <table class="table tablehcfs-one">
     <tr>
      <th>Adsorption chillers product group<br>
eCoo 20 ST<br>
eCoo 20 ST</th>
      <td>2.20<br> 2.20<br> 2.20</td>
     </tr>
     <tr>
     <th>Compression chiller product group
<br>
eWac 30</th>
     <td></td>
     </tr>
     <tr>
     <th>Re-cooler product group
<br>
eRec 20 | 58</th>
     <td></td>
     </tr>
     <tr>
     <th>Re-cooler product group
<br>
eRec 20 | 80

</th>
     <td></td>
     </tr>
     
   </table>
   </div>
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>9/11</li>
 </ul>
</footer>
<hr>
<!--- page 9 end -->
<!-- page 10 start-->
<section class="feasibility-calculation">
  <div class="container">
    <h1>Add a Chiller</h1>
<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-one">
     <tr>
      <th>Chiller type</th>
      <td>Adsorption</td>
     </tr>
     <tr>
     <th>Adsorbent</th>
     <td>Silica gel</td>
     </tr>
     <tr>
     <th>Product</th>
     <td>eCoo 20 ST</td>
     </tr>
     <tr>
     <th>Number of chillers</th>
     <td>2 pieces</td>
     </tr>
     <tr>
     <th>Product interconnection</th>
     <td>2.00</td>
     </tr>
     <tr>
     <th>Group interconnection</th>
     <td>2.20</td>
     </tr>
     <tr>
     <th>Function</th>
     <td>Peak load cover</td>
     </tr>
      
     
   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-two">
     <tr>
      <th>Investment costs</th>
      <td>€</td>
     </tr>
     <tr>
     <th>Discount</th>
     <td>%</td>
     </tr>
     <tr>
     <th>Maintenance costs</th>
     <td>€/a</td>
     </tr>
     </table>
   </div>
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>10/11</li>
 </ul>
</footer>
<hr>
<!--- page 10 end -->
<!-- page 11 start-->
<section class="feasibility-calculation">
  <div class="container">
    <h1>Add a Re-cooling System</h1>
<h6>Technical Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-one">
     <tr>
      <th>Components</th>
      <td>Re-cooler</td>
     </tr>
     <tr>
     <th>Re-cooling method</th>
     <td>Dry</td>
     </tr>
     <tr>
     <th>Product</th>
     <td>eRec 20 | 58</td>
     </tr>
     <tr>
     <th>Number of units</th>
     <td>1 piece</td>
     </tr>
     <tr>
     <th>Name</th>
     <td></td>
     </tr>
     <tr>
     <th>Re-cooling capacity</th>
     <td>58 kW</td>
     </tr>
     <tr>
     <th>Temperature difference</th>
     <td>2k</td>
     </tr>
       <tr>
     <th>Primary volume flow rate</th>
     <td></td>
     </tr>
      <tr>
     <th>Secondary volume flow rate</th>
     <td></td>
     </tr>
      <tr>
     <th>Electrical power consumption</th>
     <td></td>
     </tr>
      <tr>
     <th>Available/provided by customer</th>
     <td>No</td>
     </tr>
     
   </table>
   </div>
      <h6>Calculation Data</h6>
    <div class=" table-responsive">
   <table class="table tableaac-two">
     <tr>
      <th>Investment costs</th>
      <td></td>
     </tr>
     <tr>
     <th>Discount</th>
     <td></td>
     </tr>
     <tr>
     <th>Maintenance costs</th>
     <td></td>
     </tr>
     </table>
   </div>
  </div>
</section>
<footer>
 <ul class="list-inline">
  <li>3/13/2018 | 11:39AM</li>
  <li>Version 1.21.63</li>
  <li>11/11</li>
 </ul>
</footer>
<hr>
<!--- page 11 end -->

</body>
</html>
