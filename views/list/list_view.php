<!DOCTYPE html>
<html lang="en">
    <head>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' type='text/javascript'></script>
    </head>
    <body>


    <div >
    <nav class="navbar navbar-light bg-light justify-content-right">
    <a class="navbar-brand">LAMPARK</a>
        <form method="POST" action="?controller=list&action=search" class="form-inline">
        <input class="form-control mr-sm-2" type="text" name="search">
        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="ok" value="Search"> 
        </form>
    </nav>
    <ul class="nav justify-content-end">
        <li class="nav-item" style="padding-right:15px">
            <button type="button" class="btn btn-outline-success my-2 my-sm-0"><a href="?controller=list&action=add" >Add</a></button>
        </li>
    </ul>
    <div >
    <?php
        function temp($row,$level,$i){
            for ($j = 0; $j < count($row); ++$j){
                if($GLOBALS['numlist']>9){
                    $GLOBALS['level']=$level;
                    break;
                }
                if((int)$row[$i]['id']==(int)$row[$j]['parent']){
                    echo "<tr><td>{$GLOBALS['num']}</td><td>";
                    $GLOBALS['num']+=1;
                    for($k=0;$k<$level;$k++){
                        echo "&emsp;";
                    }
                    echo "{$row[$j]['name']}</td>";
                    echo "<td><button data-id=".$row[$j]['id']." class='btn btn-primary btn-popup'>Details</button>";
                    ?>
                    <a class="btn btn-primary" href="?controller=list&action=update&id=<?php echo $row[$j]['id']?>" >Update</a>
                    <button class='btn btn-primary' onclick="myFunction('<?php echo $row[$j]['name']?>')">Copy text</button>
                    <?php
                    echo "</td></tr>";
                    $GLOBALS['numlist']+=1;
                    temp($row,$level+1,$j);
                }
            }
        }
            
        ?>
        
            <?php if (!empty($list)): ?>

                <?php
                $row=array();

                while ($line=mysqli_fetch_assoc($list)){
                    $row[]=$line;
                }
                $GLOBALS['num']=1;
                $GLOBALS['numlist']=0;
                $GLOBALS['level']=1;
                    echo '<div style="width:60%; margin:auto">'; 
                    echo '<table class="table table-hover">';
                    echo '<tr>';
                                echo "<td>#</td>";
                                echo "<td>List</td>";
                                echo "<td>Operations</td>";
                    echo '</tr>';
                    for ($i = 0; $i < count($row); ++$i){?>
                <p>
                    <?php
                    print_r((mysqli_fetch_assoc($list)));
                    if($level>1){
                        echo "<tr>";
                        echo "<td>{$GLOBALS['num']}</td>";
                        $GLOBALS['num']+=1;
                        echo "<td>";
                        for($k=0;$k<$level;$k++){
                            echo "&emsp;";
                        }
                        echo "{$row[$i]['name']}</td>";
                        echo "<td><button data-id=".$row[$i]['id']." class='btn btn-primary btn-popup'>Details</button>";
                        ?>
                        <a class="btn btn-primary" href="?controller=list&action=update&id=<?php echo $row[$i]['id']?>" >Update</a>
                        <button class='btn btn-primary' onclick="myFunction('<?php echo $row[$i]['name']?>')">Copy text</button>
                        <?php
                        echo "</td></tr>";
                        $GLOBALS['numlist']+=1;
                        temp($row,$level,$i);
                    }
                    if($row[$i]['parent']==""){
                        echo "<tr>";
                        echo "<td>{$GLOBALS['num']}</td>";
                        $GLOBALS['num']+=1;
                        echo "<td>{$row[$i]['name']}</td>";
                        echo "<td><button data-id=".$row[$i]['id']." class='btn btn-primary btn-popup'>Details</button>";
                        ?>
                        <a class="btn btn-primary" href="?controller=list&action=update&id=<?php echo $row[$i]['id']?>" >Update</a>
                        <button class='btn btn-primary' onclick="myFunction('<?php echo $row[$i]['name']?>')">Copy text</button>
                        <?php
                        echo "</td></tr>";
                        $level=1;
                        $GLOBALS['numlist']+=1;
                        if($GLOBALS['numlist']>9){
                            $GLOBALS['level']=2;
                            break;
                        }
                        temp($row,$level,$i);
                    }
                }
                    ?>
                </p>
                <?php ?>
            <?php 
            echo '</div>';
            endif;
            ?>
    </div>
    
    <ul class="nav justify-content-center">
           <?php 
            if ($current_page > 1 && $total_page > 1){ ?>
                <a style="margin:0 5px" href="?controller=list&action=splitpage&page=<?php echo $current_page-1?>&level=<?php echo $GLOBALS['level']?>">Prev</a>
            <?php 
            }
            for ($i = 1; $i <= $total_page; $i++){
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> ';
                }
                else{
                    ?>
                    <a style="margin:0 5px" href="?controller=list&action=splitpage&page=<?php echo $i?>&level=<?php echo $GLOBALS['level']?>"><?php echo $i?>
                    <?php
                }
            }
            if ($current_page < $total_page && $total_page > 1){
                ?>
                <a style="margin:0 5px" href="?controller=list&action=splitpage&page=<?php echo $current_page-1?>&level=<?php echo $GLOBALS['level']?>">Next</a>
                <?php
            }
           ?>
           </ul>
        
 
        <!-- Modal -->
    <div class="modal fade" id="custModal" role="dialog">
      <div class="modal-dialog">
 
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Customer Details</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
    
        $('.btn-popup').click(function () {
            var Id = $(this).data('id');
            
            $.ajax({
            url: '?controller=list&action=popup&id='+Id,
            type: 'get',
            data: { Id: Id},
            
            success: function (response) {
                $('.modal-body').html(response);
                $('#custModal').modal('show');
            }
            });
        });
    
        });
    </script>
    <script>
        function myFunction(copyText) {
            navigator.clipboard.writeText(copyText);
            alert("Tên thư mục đã copy: " + copyText);
        }
    </script>
    </body>
</html>