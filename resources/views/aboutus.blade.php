@extends('layouts.atlantis')
@section('title', 'About Us')
@section('js')
    <script src="http://demo.themekita.com/atlantis/livepreview/examples/assets/js/plugin/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
      
@endsection
@section('content')
<br>
<diV>
    <div class="page-inner text-2xl">
        <div class="page-header mt-2">
        <h1 class="page-title ">ABOUT US</h1>
    </div>
    <div class="text-center">
        <h2 class="pb-2 fw-bold ">Are you official?</h2>
        <h2 >No.</h2>
    </div><br>
    <div class="text-center">
        <h2 class="pb-2 fw-bold">
            What are your sources? How is the data gathered for this project?
        </h2>
        <h2>
            We are using state bulletins and official handles to update our numbers.
            The data is validated by a group of volunteers and published into a
            Google sheet and an API.API is available for all at
            <a href="http://covid19.icrewsystems.com/" target="_blank">covid19.icrewsystems.com</a>. 
            We would love it if you can use this data in the fight against this virus. 
        </h2>
    </div><br>
    <div class="text-center">
        <h2 class="pb-2 fw-bold text-center">
            Why does covid19india.org have difference in numbers compared to MOHFW website?
        </h2>
        <h2 >
        MoHFW updates the data at a scheduled time. However, we update the
        m based on state press bulletins, official (CM, Health M) handles, PBI, Press Trust of India
        ,ANI reports. These are generally more recent.
        </h2>
    </div><br>
    <div class="text-center">
        <h2 class="pb-2 fw-bold">
        Where can I find the data for this?
        </h2>
        <h2>
            All the data is available through an API for further analysis and development here : 
            <a href="http://covid19.icrewsystems.com" target="_blank">covid19.icrewsystems.com</a>
        </h2>
    </div><br>
    <div class="text-center">
        <h2 class="pb-2 fw-bold">
            Who are you?
        </h2>
        <h2>
            We are a group of dedicated volunteers who curate and verify the
            data coming from several sources. We extract the details, like a patient's
            relationship with other patients to identify local and community transmissions,
            travel history and status. We never collect or expose any personally identifiable
            data regarding the patients.
        </h2>
    </div><br>
    <div class="text-center">
        <h2 class="pb-2 fw-bold ">
            Why are you guys putting in time and resources to do this while not gaining a single penny from it?
        </h2>
        <h2>
            Because it affects all of us. Today it's someone else who is getting infected; tomorrow 
            it could be us. We need to prevent the spread of this virus. We need to document the data 
            so that people with knowledge can use this data to make informed decisions.
        </h2>
    </div><br>
</div>

@endsection
