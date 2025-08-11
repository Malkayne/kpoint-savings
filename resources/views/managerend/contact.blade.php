@extends('managerend.layout')

@section('pageContent')

<!-- <div class="row">
<div class="col-md-6">

  <div class="card   border-bottom-success ">
     <div class="card-body">
         <h4 class="card-title">De USA</h4>


     De USA(the universal success academy) is a school for growing students from zero to hero and keeping the high flyers flying high

     </div>

 </div>

</div>

<div class="col-md-6">
</div>

<br/><br/>
</div> -->



<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Contact Datatable</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Emails</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact ->name }}</td>
                                                <td>{{ $contact->phone_number}}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->subject }}</td>
                                                <td>{{ $contact->message }}</td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>Name</th>
                                              <th>Phone Number</th>
                                              <th>Emails</th>
                                              <th>Subject</th>
                                              <th>Message</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>


@endsection
