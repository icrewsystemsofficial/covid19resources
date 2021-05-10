@extends('layouts.atlantis')
@section('title', 'Helpline')
@section('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
var dataSet = [
    [ "Andaman & Nicobar","03192-232102"],
    [ "Andhra Pradesh","0866-2410978"],
   ["Arunachal Pradesh","9436055743"],
   ["Assam	","6913347770"],
   ["Bihar	","104"],
   ["Chandigarh	","9779558282"],
   ["Chhattisgarh	","104"],
   ["Dadra Nagar Haveli	","104"],
   ["Delhi	","011-22307145"],
   ["Goa	","104"],
   ["Gujarat	","104"],
   ["Haryana	","8558893911"],
   ["Himachal Pradesh	","104"],
   ["Jammu	","01912520982"],
   ["Jharkhand	","104"],
   ["Karnataka	","104"],
   ["Kashmir	","01942440283"],
   ["Kerala	","0471-2552056"],
   ["Ladakh	","01982256462"],
   ["Lakshadweep	","104"],
   ["Madhya Pradesh	","104"],
   ["Maharashtra	","020-26127394"],
   ["Manipur	","3852411668"],
   ["Meghalaya	","108"],
   ["Mizoram	","102"],
   ["Nagaland	","7005539653"],
   ["Odisha	","9439994859"],
   ["Puducherry	","104"],
   ["Punjab	","104"],
   ["Rajasthan	","0141-2225624"],
   ["Sikkim	","104"],
   ["Tamil Nadu	","044-29510500"],
   ["Telangana	","104"],
   ["Tripura	","0381-2315879"],
   ["Uttarakhand	","104"],
   ["Uttar Pradesh	","18001805145"],
   ["West Bengal	","1800313444222, 03323412600"],
   ["The central helpline number"," 011-23978046"]
];
   $(document).ready(function() {
    $('#helpline').DataTable( {
        data: dataSet,
        columns: [
            { title: "State" },
            { title: "ContactNumber" }
        ]
    } );

} );
</script>
@endsection
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>
    /* Your Custom Styles Here*/
</style>
@endsection
@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div class="col-md-12 text-center">
                <h1 class="text-white pb-2 h1 fw-bold">
                State Helpline Numbers
                </h1>
               
            </div>

        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="helpline">
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
