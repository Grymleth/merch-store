    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Product Info</h1>
        <div class="text-center">
        <img class="mb-3 d-inline" src="https://gmedia.playstation.com/is/image/SIEPDC/ps4-slim-image-block-01-en-24jul20?$native--t$" style="width:10rem;" alt="">
        </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Image</span>
                </div>
                <input type="text" class="form-control" placeholder="Image Link" name="prodImg" required>
                <button class="btn btn-primary ml-4" type="editID">Edit</button>
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product ID</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="prodID" required>
                <button class="btn btn-primary ml-4" type="editID">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Name</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="prodName" required>
                <button class="btn btn-primary ml-4" type="editName">Edit</button>
            </div>           
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Description</span>
                </div>
                <select class="form-control" name="iSex">
                    <option value="0">Hats</option>
                    <option value="1">Hoodies</option>
                    <option value="1">Jackets</option>
                    <option value="1">Long Sleeves</option>
                    <option value="1">Shirts</option>
                    <option value="1">Miscellaneous</option>
                </select>
                <button class="btn btn-primary ml-4" type="editDesc">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Price</span>
                </div>
                <input type="text" class="form-control" placeholder="" name="prodPrice">
                <button class="btn btn-primary ml-4" type="editPrice">Edit</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Number of Stocks</span>
                </div>
                <input type="number" class="form-control" value="0" min="0" max="1000" step="1"/>
                <button class="btn btn-primary ml-4" type="editContactNo">Edit</button>
            </div>        
        </form>
    </div>
    <!-- /.container-fluid -->