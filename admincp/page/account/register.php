    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Register User</h1>
		<form action="" method="">
            <!-- Feedback alert -->
            <div class="alert alert-success">Yay!</div>
            <div class="alert alert-danger">Oh no!</div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="Full Name" name="strName" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Address</span>
                </div>
                <input type="text" class="form-control" placeholder="Metro Manila, Philippines" name="strAddress" required>
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
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" placeholder="name@example.com" name="strEmail">
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
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Contact No.</span>
                </div>
                <input type="text" class="form-control" placeholder="09123456789" name="strContactNo">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Sex</span>
                </div>
                <select class="form-control" name="iSex">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
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
            </div>
            <div class="container text-center">
                <button type="button" class="btn btn-primary btn-md">Register</button>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->