<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
<p class="back_post"> <a href="?controller=list&action=splitpage">Back</a></p>
   <h1 class="text-center  my-5  py-3">Update </h1>
    <div class ="container">
        <div class = "row">
            <div class="col-8 mx-auto">
                    <form  class="p-5 border mb-5" method="POST" action="?controller=list&action=edit&id=<?php echo $id?>">
                <div class="form-group">
                <?php foreach($list as $row) {
                    $parent =$row['parent'];
                    $name = $row['name'];
                } ?>
                    <label for="Name">Name</label>
                    <input type="text" required name ="name" id="Name"  value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="Parent">Parent</label>
                    <input type="text" name="parent" id="Parent" value="<?php echo $parent?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">submit</button>
                    
            </form>
            </div>
        </div>
    </div>