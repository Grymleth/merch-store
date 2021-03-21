    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Transaction Info</h1>
		<form action="" method="">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Transaction ID</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="strID" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="strName" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" placeholder="name@example.com" name="strEmail">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Category</span>
                </div>
                <select class="form-control" name="iCateg">
                    <option value="1">Hats</option>
                    <option value="2">Hoodies</option>
                    <option value="3">Jackets</option>
                    <option value="4">Long Sleeves</option>
                    <option value="5">Shirts</option>
                    <option value="6">Miscellaneous</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Transaction Date</span>
                </div>
                <input type="date" class="form-control" placeholder="Year" name="iDate"
                required  
                >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Quantity</span>
                </div>
                <input type="number" class="form-control" value="0" min="0" max="1000" step="1"/>
            </div>  
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Total Price</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="strPrice">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Delivery Status</span>
                </div>
                <select class="form-control" name="iSex">
                    <option value="1">Processing</option>
                    <option value="2">Packed</option>
                    <option value="3">Shipped</option>
                    <option value="4">Delivered</option>
                </select>
                <button class="btn btn-primary ml-4" type="editSex">Edit</button>
            </div>
  
        </form>
    </div>
    <!-- /.container-fluid -->