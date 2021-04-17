@extends('website.templates.main')
@section('contents')
    <section class="other-banner">
        @include('website.templates.nav-bar')
        <div class="in-ban-oth">
            <h4>Profile</h4>
            <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
                <li class="pr-1">
                    <a href="{{url('/')}}">Home
                    </a>
                    /
                </li>
                <li class="pr-1">
                    <span>Account
                    </span>
                    /
                </li>
                <li>
                    <span>Profile
                    </span>
                </li>
            </ul>
        </div>
    </section>
    <section>
        <div class="profile-page">
            <div class="prof-box col-12 col-sm-10 col-md-9 col-lg-7 col-xl-5">
                <div class="row  det-enq-form">
                    <div class="col-12 pl-0">
                        <div class="d-flex justify-content-between">
                              <h4><span class="pl-1">Profile</span></h4>
                              <i data-toggle="modal"
                                  data-target="#userProfile"
                                  class="fas fa-pencil-alt edit-right"
                                  style="cursor: pointer;"></i>
                        </div>
                        <div class="input-group w-100">
                            <label for="User Name">User Name</label>
                            <h6 class="heading">{{ Auth::user()->name ?? '' }}</h6>
                        </div>
                        <div class="input-group">
                            <label for="User Mobile">Mobile No</label>
                            <h6>+91 {{ Auth::user()->mobile ?? '' }}</h6>
                        </div>
                        <div class="input-group mb-4">
                            <label for="User Email">E-Mail</label>
                            <h6 class="heading">{{ Auth::user()->email ?? '' }}</h6>
                        </div>
                        <div class="modal fade" style="height:480px" 
                             id="userProfile" tabindex="-1"
                             role="dialog" aria-labelledby="addressModalTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="profile-modal-header modal-header">
                                <h5 class="modal-title" id="addressModalTitle">Edit Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="modal-close">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <div class="form-group">
                                      <form method="post" class="mb-4"
                                            action="{{ route('user.edit.profile') }}"
                                            id="profile-edit-form">
                                          @csrf
                                          <input type="hidden" class="contact-enq"
                                                     placeholder="Name"
                                                     name="type"
                                                     id="edit_profile"
                                                     value="profile">
                                          <div class="input-group w-100">
                                              <label for="User Name">User Name</label>
                                              <input type="text" class="contact-enq"
                                                     placeholder="Name"
                                                     pattern="[a-zA-Z]+([\s][a-zA-Z]+)"
                                                     title="user name must be alphabets or space" 
                                                     value="{{ Auth::user()->name ?? '' }}" required>
                                          </div>
                                          <div class="input-group">
                                              <label for="User Email">E-Mail</label>
                                              <input type="email" class="contact-enq"
                                                     placeholder="Name"
                                                     name="email"
                                                     title="valid user email" 
                                                     value="{{ Auth::user()->email ?? '' }}"
                                                     required>
                                          </div>
                                          <div class="input-group text-center">
                                              <button class="submit-btn btn-primary" type="submit">Update</button>
                                          </div>
                                      </form>                                      
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        @foreach($addresses as $address)
                            <div class="d-flex justify-content-between address-div">
                                @if($loop->iteration == 1)
                                    <h4><span class="pl-1">Shipping address</span></h4>
                                    <div class="d-flex justify-content-between">
                                        <i data-toggle="modal"
                                                data-target="#address{{$address->id ?? ''}}"
                                                class="fas fa-pencil-alt edit-right"
                                                id="editAddress" style="cursor: pointer;"></i>
                                    </div>
                                @else
                                    <h4><span class="pl-1">Address-</span>{{ $loop->iteration-1 }}</h4>
                                    <div class="d-flex justify-content-between">
                                        <p>
                                            <a href="{{ route('user.address.delete', [$address->id]) }}">
                                              <i class="fa fa-times"
                                                id="trashAddress" style="cursor: pointer;"></i>
                                            </a>
                                        </p>
                                        <p class="ml-4">
                                            <i data-toggle="modal"
                                                data-target="#address{{$address->id ?? ''}}"
                                                class="fas fa-pencil-alt edit-right"
                                                style="cursor: pointer;"></i>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="input-group mt-2">
                                <p>{{ $address->door_number ?? '' }}, </p>
                                <p>{{ $address->street ?? '' }}, </p>
                                <p>{{ $address->area ?? '' }}, </p>
                                <p>{{ $address->city ?? '' }}, </p>
                                <p>{{ $address->state ?? '' }}, {{ $address->country ?? '' }} {{ $address->pin_code ?? '' }}</p>
                            </div>

                            <div class="modal fade" style="height:480px" 
                                 id="address{{$address->id ?? ''}}" tabindex="-1"
                                 role="dialog" aria-labelledby="addressModalTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="profile-modal-header modal-header">
                                    <h5 class="modal-title" id="addressModalTitle">Edit Address</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true" class="modal-close">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group" id="edit-address">
                                    
                                        {{-- Address Edit Form  --}}
                                      <form class="det-enq-form address-form"
                                              action="{{ route('user.edit.profile') }}"
                                              method="post">
                                          @csrf
                                          <div class="row">
                                              <div class="col-12 pl-0">
                                                  <div class="input-group  mt-2">
                                                      <label for="Address Flot">Plot/Door No</label>
                                                      <input type="hidden" class="contact-enq"
                                                             name="type"
                                                             value="address">
                                                      <input type="hidden"
                                                             name="address_id"
                                                             id="address-id"
                                                             value="{{ $address->id ?? '' }}">
                                                      <input type="text"
                                                             class="contact-enq"
                                                             name="door_number"
                                                             placeholder="Enter Plot/Door Number"
                                                             title="plot/door number"
                                                             value="{{ $address->door_number ?? '' }}" 
                                                             placeholder="Enter Door Number"
                                                             autocomplete="off" required>
                                                  </div>
                                                  <div class="input-group">
                                                      <label for="Address Street">Street</label>
                                                      <input type="text" class="contact-enq"
                                                             name="street"
                                                             value="{{ $address->street ?? '' }}"
                                                             title="address" 
                                                             placeholder="Enter Street"
                                                             autocomplete="off" required>
                                                  </div>
                                                  <div class="input-group">
                                                      <label for="Address Area">Area</label>
                                                      <input type="text" class="contact-enq"
                                                              value="{{ $address->area ?? '' }}" 
                                                              name="area" 
                                                              title="area" 
                                                              placeholder="Enter Area"
                                                              autocomplete="off" required>
                                                  </div>
                                                  <div class="input-group">
                                                      <label for="Address City">City</label>
                                                      <input type="text" class="contact-enq"
                                                             name="city"
                                                             value="{{ $address->city ?? '' }}"
                                                             placeholder="Enter City"
                                                             title="city" 
                                                              autocomplete="off" required>
                                                  </div>
                                                  <div class="input-group">
                                                      <label for="Address State">State</label>
                                                      <select name="state" id="edit_user_states">
                                                            <option value="{{ $address->state ?? '' }}" selected>
                                                              {{ $address->state ?? '' }}
                                                            </option>
                                                      </select>
                                                  </div>
                                                  <div class="input-group">
                                                      <label for="Address Country">Country</label>
                                                      <input type="text"
                                                             class="contact-enq"
                                                             name="country"
                                                             value="{{ $address->country ?? '' }}"  
                                                             placeholder="Enter Country"
                                                              autocomplete="off" readonly>
                                                  </div>
                                                  <div class="input-group">
                                                      <label for="Address PIN">PIN Code</label>
                                                      <input type="text"
                                                             class="contact-enq pin-code"
                                                             name="pin"
                                                             pattern="[1-9]{1}[0-9]{2}\s{1}[0-9]{3}"
                                                             title="pin code starts with 1 or other, and must be 6 digits along with space between 3 digits" 
                                                             value="{{ $address->pin_code ?? '' }}" 
                                                             placeholder="Enter PIN Code"
                                                             autocomplete="off" required>
                                                  </div>
                                                  <div class="input-group">
                                                      @if($loop->iteration != 1)
                                                      <div class="form-group col-md-11">
                                                          <label>Shipping</label>
                                                          <input id="primary" name="is_default" type="checkbox">
                                                      </div>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                              <div class="input-group text-center">
                                                  <button class="submit-btn btn-primary" type="submit">Update Address</button>
                                              </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="input-group mt-4">
                        <button class="btn btn-primary"
                                  data-toggle="modal"
                                  data-target="#newAddress" type="button">Add Address</button>
                    </div>

                  {{-- New Address Form --}}

                    <div class="modal fade" style="height:500px" 
                         id="newAddress" tabindex="-1"
                         role="dialog" aria-labelledby="addressModalTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="profile-modal-header modal-header">
                            <h5 class="modal-title" id="addressModalTitle">Add Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="modal-close">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group" id="new-address">
                            
                              <form class="det-enq-form address-form"
                                      action="{{ route('user.edit.profile') }}"
                                      method="post">
                                  @csrf
                                  <div class="row">
                                      <div class="col-12 pl-0">
                                          <div class="input-group mt-2">
                                              <label for="Address Flot">Plot/Door No</label>
                                              <input type="hidden" class="contact-enq"
                                                 placeholder="Enter plot/door number"
                                                 name="type"
                                                 id="new-add"
                                                 value="address">
                                              <input type="hidden" class="contact-enq"
                                                 name="address_id"
                                                 value="0">
                                              <input type="text"
                                                    class="contact-enq"
                                                      name="door_number"
                                                      id="door_number"
                                                      placeholder="Enter Plot/Door Number"
                                                      autocomplete="off"
                                                      title="door_number" required>
                                          </div>
                                          <div class="input-group">
                                              <label for="Address Street">Street</label>
                                              <input type="text" class="contact-enq"
                                                     name="street"
                                                      placeholder="Enter Street"
                                                      autocomplete="off"
                                                      title="street" required>
                                          </div>
                                          <div class="input-group">
                                              <label for="Address Area">Area</label>
                                              <input type="text" class="contact-enq"
                                                      name="area"
                                                      placeholder="Enter Area"
                                                      autocomplete="off"
                                                      title="area" required>
                                          </div>
                                          <div class="input-group">
                                              <label for="Address City">City</label>
                                              <input type="text" class="contact-enq"
                                                     name="city"
                                                     placeholder="Enter City"
                                                     autocomplete="off"
                                                     title="city" required>
                                          </div>
                                          <div class="input-group">
                                              <label for="Address State">State</label>
                                              <select name="state" id="user_states">
                                                <option disabled selected>----- Select State -----</option>
                                              </select>
                                          </div>
                                          <div class="input-group">
                                              <label for="Address Country">Country</label>
                                              <input type="text"
                                                     class="contact-enq"
                                                     name="country"
                                                     value="India"
                                                     autocomplete="off" readonly>
                                          </div>
                                          <div class="input-group">
                                              <label for="Address PIN">PIN Code</label>
                                              <input type="text"
                                                     class="contact-enq pin-code"
                                                     name="pin"
                                                     pattern="[1-9]{1}[0-9]{2}\s{1}[0-9]{3}"
                                                     title="pin code starts with 1 or other, and must be 6 digits along with space between 3 digits" 
                                                     placeholder="Enter PIN Code"
                                                     autocomplete="off" required>
                                          </div>
                                          <div class="input-group">
                                              <div class="form-group col-md-11">
                                                  <label>Shipping</label>
                                                  <input id="primary" name="is_default" type="checkbox">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                      <div class="input-group text-center">
                                          <button class="submit-btn btn-primary"
                                                  type="submit" id="address-btn">New Address</button>
                                      </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .address-div:nth-child(6){
            background: #a2e0a9;
        }
        .profile-modal-header{
            background: #e61e2e;
            color: white
        }
    </style> 

@endsection
@section('after_js')
    <script>
        jQuery("#address-btn").on("click", function(){
          jQuery("#edit_profile").val("address")
          jQuery("#address-id").val(0)
        });
        const url = "{{ url('json/states.json')}}";
        fetch(url).then(res => {
          return res.json()
        }).then(states =>{
          jQuery.each(states, function(key, state) {
              jQuery("#user_states, #edit_user_states").append('<option value="'+ state +'">'+ state +'</option>')
          });
        })

    </script>
    
@endsection