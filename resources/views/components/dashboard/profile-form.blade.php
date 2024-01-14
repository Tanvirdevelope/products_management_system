    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input readonly type="email" class="form-control" id="email" placeholder="Enter your email">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="firstName" placeholder="Enter your firstname">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" placeholder="Enter your lastname">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="mobile" placeholder="Enter your phone number">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Enter your password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button onclick="onUpdate()" class="btn btn-primary">Updates</button>
                                            <a href="{{url('/dashboard')}}"><button type="button" class="btn btn-soft-secondary">Cancel</button></a>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>
            <!-- container-fluid -->

<script>
    getProfile();
    async function getProfile(){
        showLoader();
        let res=await axios.get("/user-profile")
        hideLoader();
        if(res.status===200 && res.data['status']==='success'){
            let data=res.data['data'];
            document.getElementById('email').value=data['email'];
            document.getElementById('firstName').value=data['firstName'];
            document.getElementById('lastName').value=data['lastName'];
            document.getElementById('mobile').value=data['mobile'];
            document.getElementById('password').value=data['password'];
        }
        else{
            errorToast(res.data['message'])
        }

    }

    async function onUpdate() {


        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if(firstName.length===0){
            errorToast('First Name is required')
        }
        else if(lastName.length===0){
            errorToast('Last Name is required')
        }
        else if(mobile.length===0){
            errorToast('Mobile is required')
        }
        else if(password.length===0){
            errorToast('Password is required')
        }
        else{
            showLoader();
            let res=await axios.post("/user-update",{
                firstName:firstName,
                lastName:lastName,
                mobile:mobile,
                password:password
            })
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
                successToast(res.data['message']);
                await getProfile();
            }
            else{
                errorToast(res.data['message'])
            }
        }
    }

</script>

