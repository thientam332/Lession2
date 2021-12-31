<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' type='text/css'>

    <h1>Thêm Danh Mục Mới</h1>
    <div class ="container">
        <div class = "row">
            <div class="col-sm-8 push-sm-2">
                    <form  class="p-5 border mb-5" method="POST" action="?controller=list&action=store">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text"  maxlength='100' required name ="name" id="Name" placeholder="Nhập tên danh mục">
                    
                </div>
                <div class="form-group">
                    <label for="Parent">Parent</label>
                    <input type="text" name ="parent" id="Parent" placeholder="Nhập lớp cha(Nếu có)">
                </div>
                <button type="submit" name="submit" type="button" class="btn btn-outline-primary">submit</button>
                <a href="?controller=list&action=splitpage"><button type="button" class="btn btn-outline-primary">Back</button></a>
            </form>
            </div>
        </div>
    </div>