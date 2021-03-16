    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Add Product</h1>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Image</span>
                </div>
                <input type="text" class="form-control" placeholder="Image Link" name="prodImg" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product ID</span>
                </div>
                <input type="text" class="form-control" placeholder="Unique ID" name="prodID" required>           
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Name</span>
                </div>
                <input type="text" class="form-control" placeholder="Name" name="prodName" required>
            </div>           
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Category</span>
                </div>
                <select class="form-control" name="iSex">
                    <option value="0">Hats</option>
                    <option value="1">Hoodies</option>
                    <option value="1">Jackets</option>
                    <option value="1">Long Sleeves</option>
                    <option value="1">Shirts</option>
                    <option value="1">Miscellaneous</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Description</span>
                </div>
                <input type="text" class="form-control" placeholder="Description of Product" name="prodDescription" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Product Price</span>
                </div>
                <input type="text" class="form-control" placeholder="Price in Peso" name="prodPrice">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Number of Stocks</span>
                </div>
                <input type="number" class="form-control" placeholder="&infin;" min="0" max="1000" step="1"/>
            </div>  
            <div class="input-group mb-3">
            <div class="container text-center">
                <button type="submit" name="reg_button_submit" class="btn btn-primary btn-md">Add Product</button>
            </div>    
            </div>                 
        </form>
    </div>
    <!-- /.container-fluid -->