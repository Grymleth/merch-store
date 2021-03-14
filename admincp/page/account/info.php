    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">User Information</h1>
		<form action="" method="">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="Full Name" name="strName" required>
                <button class="btn btn-primary" type="editName">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Address</span>
                </div>
                <input type="text" class="form-control" placeholder="Metro Manila, Philippines" name="strAddress" required>
                <button class="btn btn-primary" type="editAddress">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Date of Birth</span>
                </div>
                <input type="number" class="form-control" placeholder="Year" name="iYear"
                required  
                >
                <input type="number" class="form-control" placeholder="Month" name="iMonth"
                required
                >
                <input type="number" class="form-control" placeholder="Day" name="iDay"
                required
                >
                <button class="btn btn-primary" type="editBday">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" placeholder="name@example.com" name="strEmail">
                <button class="btn btn-primary" type="editMail">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Password</span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="strPassword">
                <div class="input-group-prepend">
                    <span class="input-group-text">Confirm Password</span>
                </div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="strCPassword">
                <button class="btn btn-primary" type="editContactNo">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Contact No.</span>
                </div>
                <input type="text" class="form-control" placeholder="09123456789" name="strContactNo">
                <button class="btn btn-primary" type="editContactNo">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Sex</span>
                </div>
                <select class="form-control" name="iSex">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
                <button class="btn btn-primary" type="editSex">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Role</span>
                </div>
                <select class="form-control" name="iRole">
                    <option value="-1">BANNED</option>
                    <option value="0">NORMAL</option>
                    <option value="1">INVENTORY</option>
                    <option value="2">FINANCIAL</option>
                    <option value="3">ADMIN</option>
                </select>
                <button class="btn btn-primary" type="editRole">Edit</button>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->