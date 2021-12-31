<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' type='text/css'>

    <title>Search</title>
</head>
<body>
    <?php
    if(ISSET($_REQUEST['ok'])){
        $keyword = addslashes($_POST['search']);
        if(empty($keyword)){
            echo '<h3><p class="text-center">Nhập dữ liệu vào chổ trống!</p></h3>';
        }
        else{
            $num=$key->rowCount();
            if($num>0 && $keyword!=""){
                echo "<h3><p class='text-center'>$num kết quả trả về với từ khóa <b>$keyword</b></p></h3>";
                $row=($key->fetchAll(PDO:: FETCH_ASSOC));
                $i=0;
                echo '<div style="width:60%; margin:auto">';
                echo '<table class="table table-hover">';
                echo '<tr>';
                echo '<td>Id</td>';
                echo '<td>Name</td>';
                echo '<td>Parent</td>';
                echo '</tr>';
                while ($i<$num) {
                    echo '<tr>';
                        echo "<td>{$row[$i]['id']}</td>";
                        echo "<td>{$row[$i]['name']}</td>";
                        echo "<td>{$row[$i]['parent']}</td>";
                        $i+=1;
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            }
            else{
                echo '<h3><p class="text-center">Không tìm thấy kết quả!</h3></p>';
            }
        }
    }
    ?>
</body>
</html>
