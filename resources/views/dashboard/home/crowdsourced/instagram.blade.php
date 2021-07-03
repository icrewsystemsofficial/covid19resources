@extends('layouts.atlantis')
@section('title', 'Instagram Resources')
@section('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
var dataSet = [
    ["For Ahmedabad, Follow @ahmedabadcovid","<a type='button' class='btn btn-primary' href='https://instagram.com/ahmedabadcovid?igshid=3p48wkt4vbyn'>Vist site</a>"],
    ["For Nagpur, Follow @nagpur.covid.help","<a type='button' class='btn btn-primary' href='https://instagram.com/nagpur.covid.help?igshid=sgxmdt0mbhre'>Vist site</a>"],
    ["For Bangalore, Follow @covidbangalore.support","<a type='button' class='btn btn-primary' href='https://instagram.com/covidbangalore.support?igshid=1dp6sck0923hy'>Vist site</a>"],
    ["For Kolkata, Follow @kolkatafightscovid19","<a type='button' class='btn btn-primary' href='https://instagram.com/kolkatafightscovid19?igshid=1wm1pqotxzn1m'>Vist site</a>"],
    ["Citizens' Covid War-Room @covidwr" ,"<a type='button' class='btn btn-primary' href='https://instagram.com/covidwr?igshid=jkyfl2j5wkkj'>vist page</a>"],
    ["For Jharkhand, Follow @jharkhandcovidhelp","<a type='button' class='btn btn-primary' href='https://instagram.com/jharkhandcovidhelp?igshid=19yr8lnw2dygi'>Vist site</a>"],
    ["Covid Help India @covidhelp.in","<a type='button' class='btn btn-primary' href='https://instagram.com/covidhelp.in?igshid=1d30mw34lme0k'>Vist site</a>"],
    ["Backup page for covid related information @stvorg_backup","<a type='button' class='btn btn-primary' href='https://instagram.com/stvorg_backup?igshid=1bihxkrlbmvza'>Vist site</a>"],
    ["For Chattisgarh, Follow @chhattisgarhcovidhelp","<a type='button' class='btn btn-primary' href='https://instagram.com/chhattisgarhcovidhelp?igshid=oqveq3c0x2r0'>Vist site</a>"],
    ["Covid SOS India @covidsosindia","<a type='button' class='btn btn-primary' href='https://instagram.com/covidsosindia?igshid=5hl2qoxvasu6'>Vist site</a>"],
    ["For Chennai, Follow @chennaivolunteers","<a type='button' class='btn btn-primary' href='https://instagram.com/chennaivolunteers?igshid=du1xlxkl0c6f'>Vist site</a>"],
    ["For Chennai, Follow @covid19chennai","<a type='button' class='btn btn-primary' href='https://instagram.com/covid19chennai?igshid=1vzkh68y6szlk'>Vist site</a>"],
    ["For Delhi, Follow @delhi_covidaid","<a type='button' class='btn btn-primary' href='https://instagram.com/delhi_covidaid?igshid=d3ny166adb4o'>Vist site</a>"],
    ["Pan India Resources @covid.resources.india","<a type='button' class='btn btn-primary' href='https://instagram.com/covid.resources.india?igshid=1h5rskg4w1pan'>Vist site</a>"],
    ["Covid Help India @covidhelpindia","<a type='button' class='btn btn-primary' href='https://instagram.com/covidhelpindia?igshid=bwu492zi5fcu'>Vist site</a>"],
    ["For Chennai, Follow @covid.aid.chennai","<a type='button' class='btn btn-primary' href='https://instagram.com/covid.aid.chennai?igshid=1tthoq4v40x7j'>Vist site</a>"],
    ["Information Hub @cov19infohubindia","<a type='button' class='btn btn-primary' href='https://instagram.com/cov19infohubindia?igshid=19l9qssl29pt9'>Vist site</a>"],
    ["Covid India Resources Aid @covidaidresources","<a type='button' class='btn btn-primary' href='https://instagram.com/covidaidresources?igshid=1865hseonv528'>Vist site</a>"],
    ["Covid Resources Pan India @cs_covidresources","<a type='button' class='btn btn-primary' href='https://instagram.com/cs_covidresources?igshid=hy6gjg4yccdg'>Vist site</a>"],
    ["Covid Resources Info @covidresourceinfo","<a type='button' class='btn btn-primary' href='https://instagram.com/covidresourceinfo?igshid=1iv0sxlyrqmvv'>Vist site</a>"],
    ["For Delhi, Follow @covid.delhi","<a type='button' class='btn btn-primary' href='https://instagram.com/covid.delhi?igshid=17vyi2engi483'>Vist site</a>"],    
    ["Pan India Resources @covid_resources","<a type='button' class='btn btn-primary' href='https://instagram.com/covid_resources?igshid=1tzl6yjpkzuew'>Vist site</a>"],
    ["For Patna, Follow @patnacovid_resources","<a type='button' class='btn btn-primary' href='https://instagram.com/patnacovid_resources?igshid=ebddnkz8lrk3'>Vist site</a>"],
    ["Pan India Resources@covid_aidresources","<a type='button' class='btn btn-primary' href='https://instagram.com/covid_aidresources?igshid=14kghusovim9u'>Vist site</a>"],
    ["For Delhi-Rajasthan-UP, Follow @together_only_we_can","<a type='button' class='btn btn-primary' href='https://www.instagram.com/together_only_we_can/?igshid=1em02sbf32d1a'>Vist site</a>"],
    ["For Delhi-NCR, Follow @covidsupportdelhincr","<a type='button' class='btn btn-primary' href='https://www.instagram.com/covidsupportdelhincr/?igshid=134yrhcd9g6d2'>Vist site</a>"],
    ["For Delhi, Follow @delhi_covidaid","<a type='button' class='btn btn-primary' href='https://www.instagram.com/delhi_covidaid/?igshid=13fawmn983179'>Vist site</a>"],
    ["Pan India Resources @covid.aid.india","<a type='button' class='btn btn-primary' href='https://www.instagram.com/covid.aid.india/'>Vist site</a>"]



    


];

   $(document).ready(function() {
    $('#instagram').DataTable( {
        data: dataSet,
        columns: [
            { title: "Page" },
            { title: "Vist" }
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
				Instagram Crowdsourced Resources
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
                        <table class="table" id="instagram">
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
